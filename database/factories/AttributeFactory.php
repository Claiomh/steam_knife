<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attribute::class;
    public function definition(): array
    {
        static $index = 0;
        $attributes = [
            ['title' => 'После полевых испытаний'],
            ['title' => 'Немного поношенное'],
            ['title' => 'Закалённое в боях'],
            ['title' => 'Поношенное'],
            ['title' => 'Прямо с завода'],
        ];
        return $attributes[$index++ % count($attributes)];
    }
}
