<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workerstat extends Model
{
    protected $fillable = ['department_id', 'jobs', 'current', 'order_id', 'user_id', 'submitted'];

    public function Order()
    {
        return $this->belongsTo('App\Order');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Department()
    {
        return $this->belongsTo('App\Department');
    }
}
