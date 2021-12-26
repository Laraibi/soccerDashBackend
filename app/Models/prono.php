<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class prono extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'match_id', "prono", "mise"];
    protected $appends=["Result"];
    public function  user()
    {
        return $this->belongsTo(User::class);
    }
    public function  soccerMatch()
    {
        return $this->belongsTo(soccerMatch::class, "match_id");
    }
    public function getResultAttribute()
    {
        if (Carbon::createFromFormat('Y-m-d H:i',$this->soccerMatch->DateTime)->gt(Carbon::now())) {
            return "notYet";
        }
        if ($this->soccerMatch->scoreHome || $this->soccerMatch->scoreAway) {
            $socoreHome = is_null($this->soccerMatch->scoreHome) ? 0 : $this->soccerMatch->scoreHome;
            $scoreAway = is_null($this->soccerMatch->scoreAway) ? 0 : $this->soccerMatch->scoreAway;
            $exactResult = $scoreAway == $socoreHome ? 'x' : ($scoreAway > $socoreHome  ? '2' : '1');
            return $exactResult == $this->prono;
        }
        return "waitingForResult";
    }
}
