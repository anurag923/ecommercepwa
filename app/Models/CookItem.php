<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookItem extends Model
{
    use HasFactory;
    
    function cook(){
        return $this->belongsTo(Cook::class);
    }

    function item(){
        return $this->belongsTo(Item::class);
    }
}
