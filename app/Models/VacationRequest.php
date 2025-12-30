<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
class VacationRequest extends Model
{
        use Notifiable;
     protected $guarded = [
        'id','created_at','updated_at',
    ];
    //
        protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'doc_date'=> 'date',
    ];

     public function user(): BelongsTo
{
    return $this->belongsTo(User::class);

}
        public function vacation(): BelongsTo
{
    return $this->belongsTo(Vacation::class);

}
public function approver()
{
    return $this->belongsTo(User::class);
}




}