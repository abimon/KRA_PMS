<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

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
            $band = $taxable_income;
            $payee = ($band * 0.1);
        }
        return $payee;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        //
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
}
