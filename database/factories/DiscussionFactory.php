<?php

namespace Database\Factories;

use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{

    protected $model = Discussion::class;

    public function definition()
    {
        $title = fake()->unique()->lastName();
        return [
            'user_id' => rand(1,10),
            'channel_id' => rand(1,20),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->text(),

        ];
    }
}
