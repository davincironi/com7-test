<?php

// $factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'description' => $faker->text(100),
//         'category_id' => rand(1, 4)
//     ];
// });

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(100),
            'category_id' => rand(1, 4),
            'price' => rand(20, 4500),
        ];
    }
}
