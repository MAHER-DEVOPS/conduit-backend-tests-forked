<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
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
        

        //Creation of user rose
        $rose = User::create(
            [
                'username' => "Rose",
                'email' => "rose@gmail.com",
                'password' => bcrypt('pwd'),
                'image' => null,
                'bio' => "Je voudrais devenir enseignante pour enfants",
                'created_at' => now()
            ]
        );

        //creation ofuser musonda
        $musonda = User::create(
            [
                'username' => "Musonda",
                'email' => "musonda@gmail.com",
                'password' => bcrypt('pwd2'),
                'image' => null,
                'bio' => "Je songe àdevenir infirmière, j’écris mes réflexions",
                'created_at' => now()
            ]
        );

        //Musonda follow Rose et Rose follow musonda
        $musonda->following()->attach($rose);
        $rose->following()->attach($musonda);

        //creation an article attached a rose
        $article_rose = Article::create(
            [
                'user_id' => $rose->id,
                'title' => 'hello Musonda',
                'slug' => 'hello Musonda',
                'description' => 'Article of Rose',
                'body' => 'Article of Rose',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        //rose article followed by musonda
        $article_rose->users()->attach($musonda);

        //creation of musonda 2 articles
        $article_mus1 = Article::create(
            [
                'user_id' => $musonda->id,
                'title' => 'hey Rose1',
                'slug' => 'hey Rose1',
                'description' => 'Article 1 of Musonda',
                'body' => 'Article 1 of Musonda',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $article_mus2 = Article::create(
            [
                'user_id' => $musonda->id,
                'title' => 'hello Rose2',
                'slug' => 'hello Rose2',
                'description' => 'Article 2 of Musonda',
                'body' => 'Article 2 of Musonda',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // rose followed articles of Musonda
        $article_mus1->users()->attach($rose);
        $article_mus2->users()->attach($rose);

        // tag education
        $education_tag = Tag::create(
            [
                'name' => 'éducation'
            ]
        );

        // add a tag on rose article
        $article_rose->tags()->attach($education_tag);

        // add a comment on rose article by Musonda
        $article_rose->comments()->create(
            [
                'user_id' => $musonda->id,
                'article_id' => $article_rose->id,
                'body' => "J'adore ta manière de concevoir l'éducation des enfants !",
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}