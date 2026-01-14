<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $table = 'Contact';
    protected $fillable = [
        'naam',
        'email',
        'bericht',
        'bestuurslid_id',
    ];

    public function bestuurslid()
    {
        return $this->belongsTo(Bestuursleden::class, 'bestuurslid_id');
    }
}
