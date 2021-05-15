<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'customer_email', 'customer_mobile', 'status', 'amount', 'description'];
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'cars');
    }
}