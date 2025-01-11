<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Division;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $divisions = Division::all();

        foreach ($divisions as $division) {

            for ($i = 0; $i <= 2; $i++) {
                Employee::create([
                    'id' => (string) $faker->uuid,
                    'division_id' => $division->id,
                    'name' => $faker->name,
                    'phone' => $faker->phoneNumber,
                    'image' => $faker->imageUrl(640, 480, 'people', true),
                    'position' => $faker->jobTitle,
                ]);
            }
        }
    }
}
