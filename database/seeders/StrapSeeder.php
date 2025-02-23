<?php

namespace Database\Seeders;

use App\Models\Strap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $strap = new Strap();
        $strap->name = 'metalic';
        $strap->save();

        $strap = new Strap();
        $strap->name = 'plastic';
        $strap->save();

        $strap = new Strap();
        $strap->name = 'leather';
        $strap->save();

    }
}
