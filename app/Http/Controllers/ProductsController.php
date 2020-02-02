<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Stores\AmazonController;

use App\Import;
use App\Product;

class ProductsController extends Controller
{
    public function __construct(){
        
    }
    
     public function index(){
        
        $products = Product::get();
        
        return view('web.products.index')
            ->with('products',$products);
        
        
    }
    
    public function view($hash){
        
        $product = Product::getByHash($hash);
        
        return view('web.products.view')
            ->with('product',$product);
        
        
    }
    

}
