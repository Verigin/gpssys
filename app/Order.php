<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total', 'user_id', 'email',
    ];

    public function orderItems()
    {
        return $this->belongsToMany('App\Product')->withPivot('qty', 'total');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
