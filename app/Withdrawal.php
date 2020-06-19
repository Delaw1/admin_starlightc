<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['user_id', 'amount', 'completed'];

    public function User()
    {
        return $this->belongsTo("App\User");
    }
}
