<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car_Model extends Model
{
    protected $fillable = [
        'name',
        'year',
        'car_maker_id'
    ];
    protected $table = 'car_models';
    public $timestamps = false;

    /**
     * Egy város egy megyéhez tartozik.
     */
    public function car_maker()
    {
        return $this->belongsTo(Car_Maker::class);
    }
}
