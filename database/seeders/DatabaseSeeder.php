<?php

    namespace Database\Seeders;

    use App\Models\Author;
    use App\Models\AuthorBoardgame;
    use App\Models\Boardgame;
    use App\Models\BoardgameCategory;
    use App\Models\Category;
    use App\Models\Play;
    use App\Models\PlayUser;
    use App\Models\User;
    use App\Models\Vote;
    use Database\Factories\BoardgameCategoryFactory;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run() {

            User::factory()->create([
                                        'firstName' => 'admin',
                                        'lastName' => 'admin',
                                        'username' => 'admin',
                                        'email' => 'admin@gmail.com',
                                        'password' => 'adminadmin',
                                        'isAdmin' => true,
                                        'isActive' => true,
                                    ]);

            $boardgame = Boardgame::factory()->create();

            Vote::factory(5)->create([
                                         'boardgame_id' => $boardgame->id
                                     ]);

            $winner = User::factory()->create();

            Play::factory(5)->create([
                                         'winner_id' => $winner->id
                                     ])->each(function ($play) {
                PlayUser::factory()->create(['play_id' => $play->id]);
            });

            $categories = Category::factory(3)->create();

            BoardgameCategory::factory()->create([
                                                     'category_id' => $categories[0]->id,
                                                     'boardgame_id' => $boardgame->id
                                                 ]);

            BoardgameCategory::factory()->create([
                                                     'category_id' => $categories[1]->id,
                                                     'boardgame_id' => $boardgame->id
                                                 ]);

            BoardgameCategory::factory()->create([
                                                     'category_id' => $categories[2]->id,
                                                     'boardgame_id' => $boardgame->id
                                                 ]);

            Author::factory(10)->create()->each(function ($author) use ($boardgame) {
                AuthorBoardgame::factory()->create([
                                                       'author_id' => $author->id,
                                                       'boardgame_id' => $boardgame->id
                                                   ]);
            });


        }
    }
