<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Product;
use App\Order;
use Tests\TestCase;

class BuyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWelcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testSelectProductGood()
    {
        $product = Product::orderBy('name')->first();
        
        $response = $this->get('/buy/'.$product->id);
        
        $response->assertStatus(200)->assertSee('Producto agregado al carro');
    }
    
    public function testSelectProductNotFound()
    {        
        $response = $this->get('/buy/100');
        
        $response->assertNotFound();
    }
    
    public function testCreateOrder()
    {
        $response = $this->get('/order/create');
        
        $response->assertStatus(200)->assertSee('Información del comprador');
    }
    
    
    public function testOrderResumeGood()
    {
        $product = Product::orderBy('name')->first();
        
        $response = $this->json('POST', '/order/resume', [
            '_token' => csrf_token(),
            'customer_name' => Str::random(10),
            'customer_email' => Str::random(10).'@gmail.com',
            'customer_mobile' => random_int(3000000000, 9999999999),
            'amount' => $product->price
        ]);
        
        $response->assertStatus(200);
    }
    
    public function testOrderResumeFailValidation()
    {
        $product = Product::orderBy('name')->first();
        
        $response = $this->json('POST', '/order/resume', [
            '_token' => csrf_token(),
            'customer_name' => Str::random(10),
            'customer_email' => Str::random(10),
            'customer_mobile' => random_int(30000, 99999),
            'amount' => $product->price
        ]);        
        
        $response->assertStatus(422);
    }
    
    public function testOrderBuy()
    {
        $product = Product::orderBy('name')->first();        
        Cache::put('products', array($product->id)); 
        
        $response = $this->from('/order/resume')->post('/order/pay', [
            '_token' => csrf_token(),
            'customer_name' => Str::random(10),
            'customer_email' => Str::random(10).'@gmail.com',
            'customer_mobile' => random_int(3000000000, 9999999999),
            'amount' => $product->price
        ]);
        
        $order = Order::orderBy('id', 'desc')->first();
        $url = $order->placetopay_url;
        
        $response->assertRedirect($url);
    }
    
    public function testResponse()
    {
        $order = Order::orderBy('id', 'desc')->first();
        $response = $this->json('GET', '/order/response?reference='.$order->id);
        
        $response->assertStatus(200);
    }
    
    public function testShowOrder()
    {
        $order = Order::orderBy('id', 'desc')->first();
        $response = $this->json('GET', '/order/'.$order->id);
        
        $response->assertStatus(200);
    }
    
    public function testListOrder(){
        $response = $this->json('GET', '/order/list');
        
        $response->assertStatus(200);
    }
}
