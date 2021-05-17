<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Cache;
use App\Product;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Cache::has('products')){
            $products = Cache::get('products');            
        }else{
            $products = array();
        }
        
        foreach($products as &$product){
            $product = Product::find($product);
        }
        
        return view('createOrder', ['products' => $products]);
    }
    
    public function store(Request $request)
    { 
        Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required|integer|max:9999999999|min:1000000000'
        ], array(), [
            'customer_name' => 'nombres completos',
            'customer_email' => 'correo electronico',
            'customer_mobile' => 'número celular'
        ])->validate();
        
        Order::newOrder($request->all());
    }    
}
