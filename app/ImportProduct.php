<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\ImportProduct;

class ImportProduct extends Model
{
    
    protected $table = 'imports_products';
    
    protected $fillable = [
        'import_id', 
        'category_id', 
        'sku', 
        'link', 
        'hash', 
        'active', 
        'deleted'
    ];
    
    
    
    public function create($query,$data){
        $importProduct = new ImportProduct();
        $importProduct = $data;
        $importproduct->save();
    }
    
    public function getBySKU($sku){
        $importProduct = ImportProduct::where('sku', $sku)->first();
        
        return $importProduct;
    }
    
        public function getByHash($hash){
        $importProduct = ImportProduct::where('hash', $hash)->first();
        
        return $importProduct;
    }
    
    public function desactivateByHash($hash){
        $importProduct = ImportProduct::getByHash($hash);
        $importProduct->active = 0;
        $importProduct->save();
    }
    
    public function activateByHash($hash){
        $importProduct = ImportProduct::getByHash($hash);
        $importProduct->active = 1;
        $importProduct->save();
    }
}
