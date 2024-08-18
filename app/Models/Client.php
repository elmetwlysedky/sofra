<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'phone', 'region_id', 'password','pin_code'];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'client_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'client_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'client_id');
    }

    public function getClientNameAttribute()
    {
        return $this->client->name ?? 'No Client';
    }
    public function getClientEmailAttribute()
    {
        return $this->client->email ?? 'No Client';
    }
}
