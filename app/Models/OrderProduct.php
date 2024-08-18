<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $table = 'order_products';
    public $timestamps = true;
    protected $fillable = array('order_id', 'product_id', 'price', 'quantity', 'special');

//    public function order()
//    {
//        return $this->belongsTo(' App\Models\Order', 'order_id');
//    }
//
//    public function product()
//    {
//        return $this->belongsTo(' App\Models\Product', 'product_id');
//    }

}
