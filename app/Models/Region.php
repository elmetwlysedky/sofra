<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client', 'region_id');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant', 'region_id');
    }

}
