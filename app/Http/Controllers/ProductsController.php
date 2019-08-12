<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Resources\Products as ProductsResource;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;

class ProductsController extends Controller
{    
    public function index()
    {
        $items = ProductsResource::collection(Products::orderByDesc('created_at')->paginate(20));
        return view('pages/user/products', compact('items'));
    }
    
    public function show(Products $product)
    {
        $item = new ProductsResource($product);
        return view('pages/user/products_cart',compact('item'));
    }

    // ((4200*0.45-70-350-50)*0.9-(30/39)*700)*0.002=
    public function calc(Products $product, Request $request)
    {
        $step_one = ( $request->check * $product->buyout/100 - $product->cost_sends - $product->cost_email - $product->price - $request->add ) * 0.9;
        $result = $step_one - $product->approve / $request->approve * $product->price_lid;
        $resultPercent = $result*0.2; 
        if ($resultPercent <= 0 ) return ['result' => 0];
        $itog = round($resultPercent,2);
        return ['result' => $itog, 'step_one' => $step_one ];
    }
}
