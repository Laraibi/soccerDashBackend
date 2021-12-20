<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class filesData extends Model
{
    use HasFactory;
    protected $fillable=['fileName','user_id'];
    public function User(){
        return $this->belongsTo(User::class);
    }
}
