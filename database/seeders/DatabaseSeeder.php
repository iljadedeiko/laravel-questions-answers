<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\ProgLanguages;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            QuestionsAnswersUsersSeeder::class,
            FavoritesSeeder::class,
            CategorySeeder::class,
            ProgLanguagesSedeer::class
        ]);
    }
}
