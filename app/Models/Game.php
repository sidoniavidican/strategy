<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_a',
        'team_b',
        'score_a',
        'score_b',
    ];

    /**
     * @return BelongsTo
     */
    public function teamA():BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_a');
    }

    /**
     * @return BelongsTo
     */
    public function teamB():BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_b');
    }
}
