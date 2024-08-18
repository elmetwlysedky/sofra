<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'price', 'price_of_sale', 'preparation_time', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo(' App\Models\Restaurant', 'restaurant_id');
    }

    public function orders()
    {
        return $this->belongsToMany(' App\Models\Order', 'order_id')->withPivot('price','quantity','special');
    }

}
