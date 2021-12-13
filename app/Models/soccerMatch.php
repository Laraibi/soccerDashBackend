<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\team;
use App\Models\competition;
use App\Models\prono;
use Illuminate\Support\Carbon;

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
    protected $dates = ['day'];
    protected $dateFormat = 'Y-m-d H:i';
    public function homeTeam()
    {
        return $this->belongsTo(team::class, "homeTeam_id");
    }
    public function awayTeam()
    {
        return $this->belongsTo(team::class, "awayTeam_id");
    }
    public function competition()
    {
        return $this->belongsTo(competition::class, "competetion_id");
    }
    public function pronos()
    {
        return $this->hasMany(prono::class, 'match_id');
    }
    public function getDateTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->day->format('Y-m-d') . (is_null($this->time) ? '00:00:00' :  $this->time))->format('Y-m-d H:i');
    }
}
