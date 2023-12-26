<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'city'];

    public function matchesAsClub()
    {
        return $this->hasMany(Matches::class, 'club_id');
    }
}
