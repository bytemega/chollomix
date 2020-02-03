<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Stores\AmazonController;

use App\Import;
use App\Product;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct(){
        
    }
    
     public function index(){
         
        $category = Category::where('hash', $hash)->first();
        
        $products = Product::where('category_id',$category->id)->paginate(12);
        
        return view('web.categories.index')
            ->with('products',$products)
            ->with('categories',$categories);
        
        
    }
    
    public function view($hash){
        
        $category = Category::where('hash', $hash)->first();
        
        $products = Product::where('category_id',$category->id)->paginate(12);
        $categories = Category::get();
        
        return view('web.categories.view')
            ->with('products',$products)
            ->with('categories',$categories);
        
        
    }
    

}
