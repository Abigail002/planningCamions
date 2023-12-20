<?php

namespace Database\Seeders;

use App\Models\Truck;
use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Truck::factory()->count(2)->create([
            ['number' => "TG0574BM"],
            ['number' => "TG1784BK"],
        ]);
    }
}
