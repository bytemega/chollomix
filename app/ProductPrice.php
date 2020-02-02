<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'products_prices';
    
    protected $fillable = [
        'product_id', 
        'price', 
        'hash', 
        'active', 
        'deleted'
    ];
}
