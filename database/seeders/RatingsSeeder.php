<?php

namespace Database\Seeders;
use App\Models\RatingComments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RatingComments::create([
            'user_id' => 2,
            'post_id' => 2,
            'comment' => 'sangat membantu sekali postingannya :)',
            'like_value' => 4,
        ]);
    }
}
