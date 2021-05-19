<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Product;
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
    
    public function testBuyGood()
    {
        $product = Product::orderBy('name')->first();
        
        $response = $this->get('/buy/'.$product->id);
        
        $response->assertStatus(200);
    }
    
    public function testBuyNotFound()
    {        
        $response = $this->get('/buy/100');
        
        $response->assertNotFound();
    }
    
    public function testCreateOrder()
    {
        $response = $this->get('/order/create');
        
        $response->assertStatus(200);
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
            'customer_mobile' => random_int(300000000, 9999999999),
            'amount' => $product->price
        ]);
        
        $response->assertStatus(422);
    }
}
