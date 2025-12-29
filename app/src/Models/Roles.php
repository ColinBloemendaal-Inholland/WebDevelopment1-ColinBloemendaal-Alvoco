<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'Roles';
    protected $fillable = ['name', 'power'];

    public function leden()
    {
        return $this->belongsToMany(Leden::class, 'leden_roles', 'role_id', 'leden_id');
    }
}
