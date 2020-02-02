<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'sku', 
        'title', 
        'description', 
        'category_id', 
        'hash', 
        'active', 
        'deleted'
    ];
    
    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }
    
    public function prices()
    {
        return $this->hasMany('App\ProductPrice');
    }
    
        public function getBySKU($sku){
            
            $product = Product::where('sku', $sku)->first();
        
            return $product;
        }
}
