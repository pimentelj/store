<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Cache;
use App\Product;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        
        return view('order.index', ['orders' => $orders]);
    }
    
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
        
        return view('order.create', ['products' => $products]);
    }
    
     public function resume(Request $request)
    {
        Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required|integer|min:3000000000|max:9999999999'
        ], array(), [
            'customer_name' => 'nombres completos',
            'customer_email' => 'correo electronico',
            'customer_mobile' => 'número celular'
        ])->validate();
         
        if(Cache::has('products')){
            $products = Cache::get('products');            
        }else{
            $products = array();
        }
        
        foreach($products as &$product){
            $product = Product::find($product);
        }
        
        return view('order.resume', ['products' => $products, 'order' => $request->all()]);
    }
    
    public function store(Request $request)
    {        
        if(Cache::has('products')){
            $products = Cache::get('products');            
        }else{
            $products = array();
        }
        
        $order = Order::create($request->all());
        $order->products()->sync($products);
        $response = $order->newOrder($request->ip(), $request->server('HTTP_USER_AGENT'));
        if($response['status'] == 'OK'){
            return redirect()->away($order->placetopay_url);
        }else{
            return back()->withErrors($response)->withInput();
        }
    }
    
    public function response(Request $request)
    {
        $order = Order::findOrFail($request->reference);
        $response = $order->getInformation();
        
        return view('order.response', ['order' => $order, 'response' => $response]);
    }
    
    public function payAgain(Request $request)
    { 
        $order = Order::findOrFail($request->order);
        $response = $order->newOrder($request->ip(), $request->server('HTTP_USER_AGENT'));
        if($response['status'] == 'OK'){
            return redirect()->away($order->placetopay_url);
        }else{
            return back()->withErrors($response)->withInput();
        }
    }
    
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->getInformation();
        
        return view('order.show', ['order' => $order]);
    }
}
