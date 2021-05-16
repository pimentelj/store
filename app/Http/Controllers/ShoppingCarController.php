<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Product;

class ShoppingCarController extends Controller
{
    public function add($id)
    {
        $product = Product::findOrFail($id);
        
        if(Cache::has('products')){
            $products = Cache::get('products');
        }else{
            $products = array();
        }
        
        array_push($products, $id);
        
        Cache::put('products', $products);
        
        return view('buy', ['product' => $product, 'products' => $products]);
    }
}
