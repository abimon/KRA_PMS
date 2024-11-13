<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->isAdmin){
            $items = Pay::all();
            $payments = Payment::all();
        }
        else{
            $items = Pay::where('user_id', Auth::user()->id)->get();
            $payments = Payment::where('user_id', Auth::user()->id)->get();
        }
        $payee = [];
        foreach ($items as $item) {
            $tax = $this->payee($item->id);
            array_push($payee, $tax);
        }
        return view("home", compact("items","payee",'payments'));
    }
}
