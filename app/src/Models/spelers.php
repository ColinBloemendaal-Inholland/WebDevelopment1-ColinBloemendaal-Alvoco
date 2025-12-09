<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Spelers extends Model {
    use SoftDeletes;
    protected $table = "Spelers";
    protected $with = [ 'lid' ];
    protected $fillable = [
        'Leden_id',
        'number',
        'position'];
    
    public function lid(): BelongsTo {
        return $this->belongsTo(Leden::class);
    }
    public function team(): BelongsTo { 
        return $this->belongsTo(Teams::class); 
    }

}