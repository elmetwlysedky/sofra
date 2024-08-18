<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = ['client_id','token','platform'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id');

    }
}
