<?php

namespace Database\Seeders;

use App\Models\Car_Maker;
use Illuminate\Database\Seeder;

class Car_MakerSeeder extends Seeder
{
    const CAR_MAKERS = [
        'Ford',
        'Mercedes',
        'Citroen',
        'BMW',
        'Skoda',
    ];

    public function run(): void
    {
       // County::truncate();
        foreach (self::CAR_MAKERS as $name) {
            Car_Maker::create([
                'name' => $name,
            ]);
        }
    }
}
