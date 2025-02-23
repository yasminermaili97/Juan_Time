<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new Type();
        $type->name = 'Sport';
        $type->save();

        $type = new Type();
        $type->name = 'Casual';
        $type->save();

        $type = new Type();
        $type->name = 'Ejecutive';
        $type->save();

        $type = new Type();
        $type->name = 'Elegance';
        $type->save();

    }
}
