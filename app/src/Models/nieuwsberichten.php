<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bestuursleden;


class Nieuwsberichten extends Model {
    use SoftDeletes;
    protected $table = "Nieuwsberichten";

    protected $fillable = [
        "Title",
        "Message",
        "Bestuursleden_id",
    ];

    public function Authur(): BelongsTo
    {
        return $this->belongsTo(Bestuursleden::class, 'Bestuursleden_id');
    }
}