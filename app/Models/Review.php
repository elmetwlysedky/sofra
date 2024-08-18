<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('client_id', 'restaurant_id', 'stars', 'comment');

    public function client()
    {
        return $this->belongsTo(' App\Models\Client', 'client_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(' App\Models\Restaurant', 'restaurant_id');
    }

}