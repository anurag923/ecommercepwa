<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookCuisine extends Model
{
    use HasFactory;

    function cook(){
        return $this->belongsTo(Cook::class);
    }

    function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }
}
