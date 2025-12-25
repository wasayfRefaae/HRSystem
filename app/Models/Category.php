<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
     protected $guarded = [
        'id','created_at','updated_at',
    ];

          protected $casts = [
 

          ];

    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }
    //
}