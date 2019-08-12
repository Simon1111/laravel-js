<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $fillable = [
        'name', 'price', 'price_lid', 'cost_email', 'cost_sends', 'approve', 'buyout', 'created_at', 'updated_ad'
    ];
}
