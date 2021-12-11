<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prono extends Model
{
    use HasFactory;
    protected $fillable=['user_id','match_id','mise',"prono","mise"];
    public function  user(){
        return $this->belongsTo(User::class);
    }
    public function  soccerMatch(){
        return $this->belongsTo(soccerMatch::class,"match_id");
    }
    
}
