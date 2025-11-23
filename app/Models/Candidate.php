<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'class', 'vision', 'mission', 'photo', 'vote_count'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
