<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use App\Models\Pay;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Mpesa::all();
        return view("mpesa.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $contact = request('contact');
        $amount = request('amount');
        $account = request('account');
        $response= $this->lipa($contact,$amount,$account);
        if(isset($response->ResponseCode) && $response->ResponseCode==0){
            return redirect('/')->with("success","A prompt has been sent. Enter pin to proceed.");
        }
        else{
            return back()->with("error","An error was found.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mpesa $mpesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mpesa $mpesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($account)
    {
        $res = request();
        Log::info(json_encode($res));
        $message = $res['Body']['stkCallback']['ResultDesc'];
        $amount = $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $TransactionId = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $phne = $res['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
        // Log::channel('mpesaSuccess')->info(json_encode(['whole' => $res['Body']]));
        Mpesa::create([
            'TransactionType' => 'Paybill',
            'Account_id' => $account,
            'TransAmount' => $amount,
            'MpesaReceiptNumber' => $TransactionId,
            'TransactionDate' => date('d-m-Y'),
            'PhoneNumber' => '+' . $phne,
            'response' => $message
        ]);
        $pay=Pay::findOrFail($account);
        $pay->status = true;
        $pay->update();
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mpesa $mpesa)
    {
        //
    }
    function generate_mpesa_token()
    {
        $consumer_key = env("MPESA_KEY");
        $consumer_secret = env("MPESA_SECRET");
        
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $response = Http::withOptions(['verify' => false])->withBasicAuth($consumer_key, $consumer_secret)->withHeaders(['Content-Type : application/json'])->get($url);
        $token = json_decode($response);
        return $token->access_token;
    }
    public function lipaNaMpesaPassword()
    {
        $passkey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_SHORT_CODE');
        $timestamp = date('YmdHis');
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }
    public function lipa($phone,$amount,$account){
        $data = [
            "BusinessShortCode"=> env('MPESA_SHORT_CODE'),    
            "Password"=>$this->lipaNaMpesaPassword(),    
            "Timestamp"=> date('YmdHis'),    
            "TransactionType"=> "CustomerPayBillOnline",    
            "Amount"=> $amount,    
            "PartyA"=>$phone,    
            "PartyB"=>"174379",    
            "PhoneNumber"=>$phone,    
            "CallBackURL"=> "https://krapms.apektechinc.com/api/payment/callback/".$account,    
            "AccountReference"=>"PAYE Remittance",    
            "TransactionDesc"=>"PAYE Remittance"
        ];
        $url ='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $response = Http::withOptions(['verify'=>false])->withBody(json_encode($data))->withHeader(
            'Authorization' ,'Bearer '.$this->generate_mpesa_token()
        )->post($url);
        return json_decode($response);
    }
    
}
