<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $fillable = ['club_id', 'score'];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
