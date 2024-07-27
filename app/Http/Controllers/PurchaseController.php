<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return Purchase::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
            'document_path' => 'nullable|file|mimes:pdf,jpg,jpeg'
        ]);

        if ($request->hasFile('document_path')) {
            $path = $request->file('document_path')->store('documents');
            $request->merge(['document_path' => $path]);
        }

        return Purchase::create($request->all());
    }

    public function show(Purchase $purchase)
    {
        return $purchase;
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
            'document_path' => 'nullable|file|mimes:pdf,jpg,jpeg'
        ]);

        if ($request->hasFile('document_path')) {
            $path = $request->file('document_path')->store('documents', 's3');
            $request->merge(['document_path' => $path]);
        }

        $purchase->update($request->all());
        return $purchase;
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return response()->noContent();
    }
}
