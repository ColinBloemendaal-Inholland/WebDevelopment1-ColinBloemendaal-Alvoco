<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Trainers extends Model {
    use SoftDeletes;
    protected $table = "Trainers";
    protected $with = ['lid'];
    protected $fillable = [
        'Leden_id',
        'role',
        'start_date',
        'end_date',
        'team_id'];

    
    public function lid(): BelongsTo
    {
        return $this->belongsTo(Leden::class, 'Leden_id');
    }
    public function team(): BelongsTo { 
        return $this->belongsTo(Teams::class); 
    }
}