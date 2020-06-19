<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    protected $fillable = ['user_id', 'section_id', 'title', 'description', 'words', 'price', 'timeframe', 'endtime', 'completed', 'paid', 'timeup', 'filename', 'filepath', 'writer_id'];

    public function Section() {
        return $this->belongsTo('App\Section');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }

    public function Writer() {
        return $this->belongsTo('App\User');
    }
}
