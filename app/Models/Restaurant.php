<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('phone_owner','category_id', 'minimum_order', 'region_id', 'delivery_charge', 'phone', 'whats_app', 'image', 'name', 'email', 'password','pin_code');

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_restaurant');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'restaurant_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'restaurant_id');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer', 'restaurant_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\PaymentReceive', 'restaurant_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'restaurant_id');
    }
}
