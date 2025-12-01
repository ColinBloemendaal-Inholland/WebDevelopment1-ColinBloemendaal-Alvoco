<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\leden;

class Bestuursleden extends Model {
    use SoftDeletes;
    protected $table = "Bestuursleden";
    protected $fillable = [
        'Leden_id',
        'role',
        'start_date',
        'end_date'];

    
    public function lid(): BelongsTo
    {
        return $this->belongsTo(Leden::class);
    }
}