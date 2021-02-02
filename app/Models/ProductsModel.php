<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsModel extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'subcategory_id',
        'price',
        'stock',
        'publication_date',
        'news'


        
        
   
        
    ];

    protected $dates = ['deleted_at'];

}