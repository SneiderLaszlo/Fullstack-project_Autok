<?php

namespace Database\Seeders;

use App\Models\Car_Maker;
use App\Models\Car_Model;
use Illuminate\Database\Seeder;

class Car_ModelSeeder extends Seeder
{
    /** gyártó => [modell => évjárat] */
    const MODELS = [
        'Ford' => ['Fiesta' => '2017', 'Focus' => '2018', 'Kuga' => '2020', 'Mustang' => '2015'],
        'Mercedes' => ['A-osztály' => '2018', 'C-osztály' => '2021', 'E-osztály' => '2023', 'GLC' => '2022'],
        'Citroen' => ['C3' => '2016', 'C4' => '2020', 'Berlingo' => '2018', 'C5 Aircross' => '2019'],
        'BMW' => ['3-as sorozat' => '2019', '5-ös sorozat' => '2023', 'X5' => '2018', 'i4' => '2021'],
        'Skoda' => ['Fabia' => '2021', 'Octavia' => '2020', 'Superb' => '2024', 'Kodiaq' => '2017'],
    ];

    public function run(): void
    {
        foreach (self::MODELS as $maker => $models) {
            $car_maker = Car_Maker::where('name', $maker)->first();
            if (! $car_maker) {
                continue;
            }
            foreach ($models as $name => $year) {
                Car_Model::create([
                    'name' => $name,
                    'year' => $year,
                    'car_maker_id' => $car_maker->id,
                ]);
            }
        }
    }
}
