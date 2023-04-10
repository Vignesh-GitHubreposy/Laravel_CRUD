<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //composer dump-autoload
        return [
            'name' => fake()->name(),
            'mobile_no' => fake()->unique()->tollFreePhoneNumber(),//numerify('###-###-####'); // "766-620-7004"
            'email' => fake()->unique()->safeEmail(),
            'address'=>fake()->address(),
            'image'=>fake()->image(storage_path('app/profile'),640, 480, null, false),
            //'image'=>fake()->image(),
        ];
    }
}
