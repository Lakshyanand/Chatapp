<?php

namespace Database\Factories;
use App\Models\Userdetail;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Userdetail>
 */
class UserdetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Userdetail::class;
    public function definition()
    {
        return [
            'name' => $this->faker->unique->name(),
            'email' => $this->faker->unique->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 'Admin',
        ];
    }
}
