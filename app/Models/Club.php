<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'city'];

    public function matchesAsClub1()
    {
        return $this->hasMany(Matches::class, 'club1_id');
    }

    public function esesAsClub2()
    {
        return $this->hasMany(Matches::class, 'club2_id');
    }
}
