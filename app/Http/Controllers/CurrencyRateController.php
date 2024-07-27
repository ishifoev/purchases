<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\CurrencyRate;

class CurrencyRateController extends Controller
{
    public function index()
    {
        return CurrencyRate::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:3',
            'rate' => 'required|numeric'
        ]);
        return CurrencyRate::create($request->all());
    }

    public function show(CurrencyRate $currencyRate)
    {
        return $currencyRate;
    }

    public function update(Request $request, CurrencyRate $currencyRate)
    {
        $request->validate([
            'currency' => 'required|string|max:3',
            'rate' => 'required|numeric'
        ]);
        $currencyRate->update($request->all());
        return $currencyRate;
    }

    public function destroy(CurrencyRate $currencyRate)
    {
        $currencyRate->delete();
        return response()->noContent();
    }
}
