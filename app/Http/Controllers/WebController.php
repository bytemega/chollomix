<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Stores\AmazonController;

use App\Product;
use App\Category;

class WebController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){
        
        $products = Product::paginate(12);
        $categories = Category::get();
        return view('welcome')
            ->with('products',$products)
            ->with('categories',$categories);
        
        
        //$hash = 'gg45g45gv54vb5';
        /*$import = new Import;
        $importData = $import->getByHash($hash);
        
        $products = new AmazonController;
        $products->getProducts($importData->node,$importData->page);
        
        $import = new Import;
        $import->updatePageByImportHash($importData->hash);*/
        
        /*$sku = 'B07HYNLTHS';
        $product = new AmazonController;
        $product->getProductDetails($sku);*/
        
        
    }
}
