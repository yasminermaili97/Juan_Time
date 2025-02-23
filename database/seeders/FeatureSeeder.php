<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feature = new Feature();
        $feature->name = 'Cronometro';
        $feature->watch_id = 1;
        $feature->save();

        $feature = new Feature();
        $feature->name = 'Cuenta pasos';
        $feature->watch_id = 1;
        $feature->save();

        $feature = new Feature();
        $feature->name = 'Alarma';
        $feature->watch_id = 1;
        $feature->save();
    }
}
