<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dnetix\Redirection\PlacetoPay;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_email', 'customer_mobile', 'status', 'amount', 'description'];
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'cars');
    }
    
    public function newOrder($ip, $agent){
        $placetopay = new PlacetoPay([
            'login' => env('LOGIN_PLACETOPAY'),
            'tranKey' => env('TRANKEY_PLACETOPAY'),
            'url' => env('THE_BASE_URL_TO_POINT_AT_PLACETOPAY'),
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);        
        
        $payment = [
            'locale' => 'es_CO',
            'buyer' => [
                'name' => $this->customer_name,
                'email' => $this->customer_email,
                'mobile' => intval($this->customer_mobile)
            ],
            'payment' => [
                'reference' => $this->id,
                'description' => 'Nueva order para la referencia '.$this->id,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $this->amount,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => route('order.response', ['reference' => $this->id]), //'http://example.com/response?reference=' . $this->id,
            'ipAddress' => $ip,
            'userAgent' => $agent,
        ];
        
        $response = $placetopay->request($payment);        
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            $this->status = 'CREATED';
            $this->placetopay_id = $response->requestId();
            $this->placetopay_url = $response->processUrl();
            $this->save();
            //header('Location: ' . $response->processUrl());
            return ['status' => $response->status()->status(), 'message' => $response->status()->message()];
        } else {
            // There was some error so check the message and log it
            return ['status' => $response->status()->status(), 'message' => $response->status()->message()];
        }
    }
    
    public function getInformation(){
        $placetopay = new PlacetoPay([
            'login' => env('LOGIN_PLACETOPAY'),
            'tranKey' => env('TRANKEY_PLACETOPAY'),
            'url' => env('THE_BASE_URL_TO_POINT_AT_PLACETOPAY'),
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]); 
        
        $response = $placetopay->query($this->placetopay_id);

        if ($response->isSuccessful()) {
            // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
            $this->placetopay_status = $response->status()->status();
            if ($response->status()->isApproved()) {
                $this->status = 'PAYED';
            }elseif($response->status()->isRejected()){
                $this->status = 'REJECTED';
            }
            $this->save();
            
            return ['status' => $response->status()->status(), 'message' => $response->status()->message()];
        } else {
            // There was some error with the connection so check the message
            return ['status' => $response->status()->status(), 'message' => $response->status()->message()];
        }
    }
}