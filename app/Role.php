<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';
    protected $primaryKey='id';
    public function users()
    {
        return $this->belongsToMany(Usuario::class)->withTimestamps();
    }

}
