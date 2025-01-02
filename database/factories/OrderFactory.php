<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'datetime_from' => $this->faker->date(),
            'datetime_to' => $this->faker->date(),
            'weight' => rand(1, 100),
            'price' => $this->faker->randomNumber(),
            'order_number' => Str::random(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'active' => $this->faker->boolean(),
        ];
    }
}
