<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->isAdmin){
            $items = Pay::all();
        }
        else{
            $items = Pay::where('user_id', Auth::user()->id)->get();
        }
        $payee = [];
        foreach ($items as $item) {
            $tax = $this->payee($item->id);
            array_push($payee, $tax);
        }
        return view("records.index", compact("items","payee"));
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
        $basic = request('basic_salary');
        $allowances = request('allowances');
        $gross = $basic+$allowances;
        if($gross<=7000){
            $nssf = $gross*0.06;
        }
        elseif($gross>7000 && $basic<=36000){
            $nssf =420+($gross-7000)*0.06;
        }
        else{
            $nssf = 420 + (29000 * 0.06);
        }
        $nhif_c=$gross*0.0275;
        if($nhif_c<300){
            $nhif = 300;
        }
        else{
            $nhif = $nhif_c;
        }
        Pay::create([
            'user_id' => Auth::user()->id,
            'basic_salary' => $basic,
            'allowances' => $allowances,
            'pension' => $nssf,
            'insurance' => $nhif,
            'period' => 'Monthly'
        ]);
        return back()->with('success','Success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Pay::findOrFail($id);
        $paye = $this->payee($item->id);
        $pdf = Pdf::loadView('paye_slip', compact('item','paye'));
        $pdf->setPaper('B5', 'portrait');
        return $pdf->stream();
        // return view();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        $transactions = Pay::where([['user_id', Auth::user()->id],['created_at','<=',request('to')],['created_at','>=',request('from')]])->get();
        $payee = [];
        foreach($transactions as $transaction){
            $tax = $this->payee($transaction->id);
            array_push($payee, $tax);
        }
        $pdf = Pdf::loadView('report', compact('transactions', 'payee'));
        $pdf->setPaper('A4','Portrait');
        return $pdf->stream();
        // return view('report', compact('transactions','payee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay $pay)
    {
        //
    }

    public function payee($id)
    {
        // Gross income = Basic salary + Allowances
        // taxable income = gross income - deductions(e.g pension, insurance)
        // tax bands
        // Up to KES 24,000: 10%
        // KES 24,001 to KES 32,333: 15%
        // KES 32,334 to KES 42,267: 20%
        // KES 42,268 to KES 53,333: 25%
        // Over KES 53,334: 30%
        $in = Pay::findOrFail($id);
        $taxable_income = ($in->basic_salary + $in->allowances) - ($in->pension + $in->insurance);
        $payee = 0;
        if ($taxable_income > 53334) {
            $band = $taxable_income - 53333;
            $payee = ($band * 0.3) + ((53334 - 42267) * 0.25) + ((42268 - 32333) * 0.2) + ((32334 - 24000) * 0.15) + (24000 * 0.1);
        } elseif ($taxable_income > 42267) {
            $band = $taxable_income - 42267;
            $payee = ($band * 0.25) + ((42268 - 32333) * 0.2) + ((32334 - 24000) * 0.15) + (24000 * 0.1);
        } elseif ($taxable_income > 32334) {
            $band = $taxable_income - 32334;
            $payee = ($band * 0.2) + ((32334 - 24000) * 0.15) + (24000 * 0.1);
        } elseif ($taxable_income > 24000) {
            $band = $taxable_income - 24000;
            $payee = ($band * 0.15) + (24000 * 0.1);
        } else {
            $payee = 0;
        }
        $gross=$in->basic_salary + $in->allowances;
        $relief_c = $gross * 0.15;
        // if ($relief_c > 5000) {
        //     ($relief = 5000);
        // } else {
        //     $relief = $relief_c;
        // }
        $relief = 2400;
        $paye = $payee - $relief;
        return $paye;
    }
    function generate_token()
    {
        $consumer_key = 'jnOrXQoEp9v2nczb2tCQvi6hzulzdfxMqsb41d6unZwyVxzu';
        $consumer_secret = 'lZbyHMiXCo880XHcOUyQRpOeCUBGQVNPwtMakHRbFKlpHALhhW0G9fqkVzBjIv94';
        $data = json_encode([
            'username' => $consumer_key,
            'password' => $consumer_secret
        ]);
        $key = "ClLDVimTeiz8P0LKHWc5ZqNNapRrCblJOjBsvVV5VfPaV3Ez";
        $url = 'https://sandbox.developer.go.ke/oauth2/v1/generate?grant_type=client_credentials';
        $response = Http::withOptions(['verify' => false])->withBasicAuth($consumer_key, $consumer_secret)->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        $access_token = json_decode($response);
        return $access_token->access_token;
    }
    function verifyPIN($id)
    {
        $url = 'https://sandbox.developer.go.ke/v1/kra-pin/validate';
        $data = json_encode([
            'taxpayerID' => $id,
            'typeOfTaxpayer'=>'KE'
        ]);
        $response = Http::withOptions(['verify' => false])->withToken('Bearer '.$this->generate_token())->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        return response()->json($response);
    }
}
