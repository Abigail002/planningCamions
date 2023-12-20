<?php

namespace Database\Seeders;

use App\Models\ContainerType;
use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContainerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContainerType::factory()
            ->count(5)
            ->create([
                [
                    'length' => "20'",
                    'heigtht' => "8'6''",
                    'subType' => "DV",
                ],
                [
                    'length' => "40'",
                    'heigtht' => "8'6''",
                    'subType' => "HC",
                ],
                [
                    'length' => "40'",
                    'heigtht' => "9'6''",
                    'subType' => "HC",
                ],
                [
                    'length' => "40'",
                    'heigtht' => "9'6''",
                    'subType' => "HR",
                ],
                [
                    'length' => "40'",
                    'heigtht' => "9'6''",
                    'subType' => "OT",
                ],
            ]);
    }
}
