<?php

namespace App\Models;
use App\Models\Teams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seizoenen extends Model
{
    use SoftDeletes;
    protected $table = 'Seizoenen';
    protected $fillable = ['title', 'is_current'];

    public static function current(): ?self
    {
        return static::where('is_current', 1)->first();
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Teams::class, 'teams_seasons');
    }
}
