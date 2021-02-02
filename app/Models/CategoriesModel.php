<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriesModel extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'description',
        'prom'
        
   
        
    ];

    protected $dates = ['deleted_at'];

}