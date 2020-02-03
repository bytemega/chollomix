<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [
        'node', 
        'parent_category_id', 
        'title', 
        'description', 
        'hash', 
        'active', 
        'deleted'
    ];
}
