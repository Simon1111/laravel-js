<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Resources\Products as ProductsResource;
use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = ProductsResource::collection(Products::orderByDesc('created_at')->paginate(20));
        return view('pages/admin/items', compact('items'));
    }

    public function api()
    {
        return ProductsResource::collection(Products::orderByDesc('created_at')->paginate(20));
    }

    public function store(Products $items, StoreProduct $request)
    {
        $data = $request->validated();

        $result = $items->create($data)->save(); // создание новости

        return response()->json($result); // сохранение и вывод ответа клиенту
    }
    
 
    public function update(Products $item, StoreProduct $request)
    {
        $data = $request->validated();

        $result = $item->fill($data)->save(); // замена данных

        return response()->json($result);
    }

    public function show(Products $item)
    {
        $item = new ProductsResource($item);
        return view('pages/admin/items_cart',compact('item'));
    }
    
    public function destroy(Products $item)
    {
        $item->delete();

        return response()->json(['success' => true]);
    }
}
