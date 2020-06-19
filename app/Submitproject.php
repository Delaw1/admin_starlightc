<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submitproject extends Model
{
    protected $fillable = ['order_id', 'filepath', 'approved', 'user_id'];

    public function Order() {
        return $this->belongsTo("App\Order");
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
