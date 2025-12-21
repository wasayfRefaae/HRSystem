<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incident extends Model
{
     protected $guarded = [
        'id','created_at','updated_at',
    ];
         public function incidentRequest(): HasMany
    {
        return $this->hasMany(IncidentRequest::class);
    }
    //
}