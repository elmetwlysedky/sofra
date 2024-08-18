<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentReceive extends Model
{

    protected $table = 'payment_receives';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'amount');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant', 'restaurant_id');
    }

}
