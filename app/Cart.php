<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'section_id', 'title', 'description', 'words', 'price', 'timeframe'];

    public function Section() {
        return $this->belongsTo('App\Section');
    }


}
