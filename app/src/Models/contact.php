<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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
