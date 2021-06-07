<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function cook(){
        return $this->belongsToMany(Cook::class,'cook_items');
    }

    public function cuisine(){
        return $this->belongsTo(Cuisine::class);
    }
}
