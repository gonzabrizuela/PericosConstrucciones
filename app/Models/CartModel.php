<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartModel extends Model
{
    use SoftDeletes;
    protected $table = 'carrito';
    
    protected $fillable = [
        'user_id',
        'product_id',
        'status'
        
   
        
    ];

    protected $dates = ['deleted_at'];

}