<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Import;
use App\ImportProduct;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $products = Product::paginate(10);
        $imports = Import::paginate(10);
        $importsProducts = ImportProduct::orderBy('id','DESC')->where('active',1)->paginate(10);
        return view('home')
            ->with('products', $products)
            ->with('imports',$imports)
            ->with('importsProducts',$importsProducts);
    }
    
}
