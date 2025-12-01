<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use App\Models\leden;

class Teams extends Model {
    use SoftDeletes;
    protected $table = "Teams";
    protected $fillable = [
        "name",
        "class",
        "Category",];

    public function spelers(): HasMany { 
        return $this->hasMany(Spelers::class); 
    }
    public function coaches(): HasMany { 
        return $this->hasMany(Coaches::class, 'team_coach'); 
    }
    public function trainers(): HasMany { 
        return $this->hasMany(Trainers::class, 'team_trainer'); 
    }
    public function wedstrijden(): HasMany { 
        return $this->hasMany(Wedstrijden::class, 'team_id'); 
    }

}