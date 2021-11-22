<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soccerMatch extends Model
{
    use HasFactory;
    protected $table = "matches";
    protected $fillable = [
        "day",
        "homeTeam_id",
        "awayTeam_id",
        "competetion_id",
        "time",
        "scoreHome",
        "scoreAway",
    ];
}
