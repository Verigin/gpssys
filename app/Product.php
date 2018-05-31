<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Laravel\Scout\Searchable;

class Product extends Model
{
    //use Searchable;

    protected $fillable = [
        'title', 'description', 'price', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
