<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    //
    protected $fillable = ['user_id', 'target', 'category_id' ,'goal'];
}
