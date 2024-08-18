<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id', 'notes', 'total_price', 'status', 'restaurant_id', 'delivery_charge', 'commission');

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant', 'restaurant_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_products')->withPivot('price','quantity','special');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'order_id');
    }

    public function getTotalInvoiceAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }
}
