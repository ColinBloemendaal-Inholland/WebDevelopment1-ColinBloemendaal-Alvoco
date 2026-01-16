<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teams extends Model
{
    use SoftDeletes;
    protected $table = "Teams";

    protected $fillable = [
        "name",
        "class",
        "category",
        "picture",
        "seizoen_id"
    ];

    public function seizoenen(): BelongsTo
    {
        return $this->belongsTo(Seizoenen::class,'seizoen_id');
    }

    public function spelers(): BelongsToMany
    {
        return $this->belongsToMany(
            Spelers::class,
            'spelers_teams',
            'team_id',
            'speler_id')
            ->orderBy('number', 'asc');
    }
    public function coaches(): HasMany
    {
        return $this->hasMany(Coaches::class, 'team_id');
    }
    public function trainers(): HasMany
    {
        return $this->hasMany(Trainers::class, 'team_id');
    }
    public function wedstrijdenHome(): HasMany
    {
        return $this->hasMany(Wedstrijden::class, 'team_home');
    }
    public function wedstrijdenAway(): HasMany
    {
        return $this->hasMany(Wedstrijden::class, 'team_away');
    }

    public function getWedstrijdenAttribute()
    {
        return $this->wedstrijdenHome()->get()->merge(
            $this->wedstrijdenAway()->get()
        )->sortBy('date');
    }

}
