<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function Cart() {
        return $this->hasMany("App\Cart");
    }

    public function Category() {
        return $this->belongsTo("App\Category");
    }    
}
