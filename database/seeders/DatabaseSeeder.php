<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Order;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory(100)->create();

        Order::factory(1000)->create([
            'from_city_id' => City::query()->where('name', 'Volgograd')->first()->id,
            'to_city_id' => City::query()->where('name', 'Moscow')->first()->id,
        ]);
    }
}
