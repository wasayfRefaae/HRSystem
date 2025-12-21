<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentRequest extends Model
{
        protected $guarded = [
        'id','created_at','updated_at',
    ];

        protected $casts = [
        'hire_date' => 'date',
        'doc_date' => 'date',
        'salary' => 'decimal:2',
       
    ];
     public function user(): BelongsTo
{
    return $this->belongsTo(User::class);

}
            public function incident(): BelongsTo
{
    return $this->belongsTo(Incident::class);

}

            public function department(): BelongsTo
{
    return $this->belongsTo(Department::class);

}
              public function ministry(): BelongsTo
{
    return $this->belongsTo(Ministry::class);

}
 public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);

}
 public function position(): BelongsTo
{
    return $this->belongsTo(Position::class);

}
  

    
    //
}