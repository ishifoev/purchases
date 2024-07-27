<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        return Shop::all();
    }

    public function show(Shop $shop)
    {
        return $shop->load('purchases');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        return Shop::create($request->all());
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $shop->update($request->all());
        return $shop;
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return response()->noContent();
    }
}
