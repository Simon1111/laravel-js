<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $fillable = [
        'comment_id', 'text', 'url', 'created_at', 'updated_ad'
    ];
}
