<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wedstrijden extends Model
{
    use SoftDeletes;
    protected $table = "Wedstrijden";
    protected $fillable = [
        "team_home",
        "team_away",
        "date",
        "time",
        "location",
        "score_home",
        "score_away",
        "status",
        "referee"
    ];

    public function hometeam(): BelongsTo
    {
        return $this->belongsTo(Teams::class, 'team_home');
    }
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Teams::class, 'team_away');
    }

    public function getScoreAttribute()
    {
        if ($this->score_home !== null && $this->score_away !== null) {
            return $this->score_home . ' - ' . $this->score_away;
        }
        return 'N/A';
    }
}
