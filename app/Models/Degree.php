<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Degree extends Model
{
        use HasFactory, Notifiable;
     protected $guarded = [
        'id','created_at','updated_at',
    ];



             public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }
    //
}