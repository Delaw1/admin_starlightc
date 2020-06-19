<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Section() {
        return $this->hasMany("App\Section");
    }

    public function Department() {
        return $this->belongsTo("App\Department");
    }
}
