<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageModel extends Model
{
    use SoftDeletes;
    protected $table = 'images';
    
    protected $fillable = [
        'image',
        'product_id'

        
        
   
        
    ];

    protected $dates = ['deleted_at'];

}