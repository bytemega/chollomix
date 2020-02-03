<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Stores\AmazonController;

use App\Import;
use App\Product;
use App\Category;

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
        
        $product = Product::where('hash', $hash)->first();
        $categories = Category::get();
        $similarProducts = Product::where('category_id',$product->category_id)->paginate(6);
        
        return view('web.products.view')
            ->with('product',$product)
            ->with('categories',$categories)
            ->with('similarProducts',$similarProducts);
        
        
    }
    

}
