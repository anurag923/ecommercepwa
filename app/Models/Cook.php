<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cook extends Authenticatable
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'image'
    ];

    public function item(){
        return $this->belongsToMany(Item::class,'cook_items');
    }

    public function cuisine(){
        return $this->belongsToMany(Cuisine::class,'cook_cuisines');
    }

    public function cookcuisine(){
        return $this->hasOne(cookcuisine::class);
    }
}
