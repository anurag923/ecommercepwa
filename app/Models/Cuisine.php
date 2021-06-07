<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'place'
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function cooks(){
        return $this->belongsToMany(Cook::class,'cook_cuisines');
    }

    public function cookcuisine(){
        return $this->hasOne(cookcuisine::class);
    }

}
