<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Recipe extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function steps(){
        return $this->hasMany(Steps::class);
    }
    public function ingredients(){
        return $this->hasMany(Ingredients::class);
    }
    protected $fillable = ['name', 'description', 'image', 'user_id'];

}
