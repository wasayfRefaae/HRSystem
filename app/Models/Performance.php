<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'user_id', 'reviewer_id', 'review_period', 'quality_of_work', 
        'productivity', 'communication', 'teamwork', 'leadership', 
        'overall_rating', 'strengths', 'areas_for_improvement', 'goals', 'comments'
    ];

    protected $casts = [
        'overall_rating' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}