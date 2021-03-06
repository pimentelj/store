<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image'];
    
    public function orders()
    {
        return $this->belongsToMany('App\Order', 'cars');
    }
}
