<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teams extends Model {
    use SoftDeletes;
    protected $table = "Teams";

    protected $with = ['spelers', 'coaches', 'trainers', 'wedstrijden'];
    protected $fillable = [
        "name",
        "class",
        "Category",];

    public function spelers(): HasMany { 
        return $this->hasMany(Spelers::class, 'team_id'); 
    }
    public function coaches(): HasMany { 
        return $this->hasMany(Coaches::class, 'team_id'); 
    }
    public function trainers(): HasMany { 
        return $this->hasMany(Trainers::class, 'team_id'); 
    }
    public function wedstrijden(): HasMany { 
        return $this->hasMany(Wedstrijden::class, 'team_home'); 
    }

}