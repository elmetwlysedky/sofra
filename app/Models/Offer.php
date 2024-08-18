<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'name', 'description', 'image', 'start_from', 'end_to');
//    protected $visible = array('end_to');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant', 'restaurant_id');
    }

}
