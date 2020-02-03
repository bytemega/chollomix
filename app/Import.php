<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Import extends Model
{
    protected $table = 'imports';
    
    protected $fillable = [
        'name', 
        'import_type_id', 
        'category_id', 
        'page', 
        'hash', 
        'active', 
        'deleted'
    ];
    
    public function products()
    {
        return $this->hasMany('App\ImportProduct');
    }
    
    public function getByHash($hash){
        $import = Import::where('imports.hash', $hash)
                ->join('categories', 'categories.id', '=', 'imports.category_id')
                ->select('imports.*', 'categories.node')
                ->first();
        
        return $import;
    }
    
    public function updatePageByImportHash($importHash){
        $import = Import::where('hash', $importHash)->first();
        
        DB::table('imports')
            ->where('hash', $import->hash)
            ->update(['page' => $import->page+1]);
    }
}
