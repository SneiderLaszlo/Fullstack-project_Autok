<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car_Maker extends Model
{
    protected $fillable = ['name'];
    protected $table = 'car_makers';
    public $timestamps = false;


    public function car_models()
{
    return $this->hasMany(Car_Model::class, 'car_maker_id');
}

    
}
