<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'client_id', 'restaurant_id', 'order_id');

    public function client()
    {
        return $this->hasMany('App\Models\Client', 'client_id');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant', 'restaurant_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
