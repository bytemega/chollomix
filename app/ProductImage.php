<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_images';
    
    protected $fillable = [
        'link', 
        'title', 
        'product_id', 
        'hash', 
        'active', 
        'deleted'
    ];
}
