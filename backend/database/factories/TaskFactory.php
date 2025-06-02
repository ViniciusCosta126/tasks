<?php

namespace Database\Factories;

use App\Models\Coluna;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "titulo" => $this->faker->sentence(3),
            "responsavel_id" => User::factory(),
            "criador_id" => User::factory(),
            "data_vencimento" => $this->faker->dateTimeInInterval("+1 week", "+4 days"),
            "coluna_id" => Coluna::factory(),
            "descricao" => $this->faker->sentence(5),
            "ativa" => $this->faker->boolean(100),
        ];
    }
}
