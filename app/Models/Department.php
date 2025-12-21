<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ministry;

class Department extends Model
{
    protected $guarded = [
        'id','created_at','updated_at',
    ];
    //
      public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
       public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }
    
          public function incidentRequests(): HasMany
    {
        return $this->hasMany(IncidentRequest::class);
    }

      
          public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }
}