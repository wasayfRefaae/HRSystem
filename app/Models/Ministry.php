<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ministry extends Model
{
     protected $guarded = [
        'id','created_at','updated_at',
    ];
    //
       public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

          public function incidentRequests(): HasMany
    {
        return $this->hasMany(IncidentRequest::class);
    }
    
}