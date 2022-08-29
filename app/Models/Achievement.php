<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function users(){
        return $this->belongsToMany(User::class, 'achievement_id');
    }
}
