<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //url Mutators
    public function getImageUrlAttribute()
    {
        //return ('/storage/'.$this->image);
        return Storage::disk('public')->url($this->attributes['image']);
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
}
