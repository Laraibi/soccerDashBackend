<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\soccerMatch;
class competition extends Model
{
    use HasFactory;
    protected $fillable = ["name","country_id"];
    public function matchs(){
        return $this->hasMany(soccerMatch::class,"competetion_id","id");  
    }
}
