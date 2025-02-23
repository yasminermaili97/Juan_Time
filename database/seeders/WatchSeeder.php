<?php

namespace Database\Seeders;

use App\Models\Watch;
use Database\Factories\UserFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $watch = new Watch();
        $watch->model = "watchs3";
        $watch->brand = "casio";
        $watch->type_id = 1;
        $watch->strap_id = 1;
        $watch->year_edition = 2020;
        $watch->ean = '193456789';
        $watch->price = 29.99;
        $watch->save();

        Watch::create([
            'model' => 'watchs4',
            'brand' => 'casio',
            'type_id' => 2,
            'strap_id' => 2,
            'year_edition' => 2021,
            'ean' => '923456789',
            'price' => 39.00
        ]);

        /*Watch::factory(6)->create();*/

    }
}
