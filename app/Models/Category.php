<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name');

    public function restaurants()
    {
        return $this->belongsToMany(' App\Models\Restaurant');
    }

}
