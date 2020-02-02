<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportResponse extends Model
{
    protected $table = 'imports_responses';
    
    protected $fillable = [
        'import_id', 
        'response', 
        'status', 
        'hash', 
        'active', 
        'deleted'
    ];
}
