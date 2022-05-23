<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'Zuhril Fahrizal',
            'username' => 'zuhrilFahrizal',
            'email' => 'zuhrilfil12m@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // User::create([
        //     'name' => 'Nando Septian',
        //     'email' => 'nandosep22@gmail.com',
        //     'password' => bcrypt('1245678')
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Business',
            'slug' => 'business'
        ]);

        Category::create([
            'name' => 'Graphic Design',
            'slug' => 'graphic-design'
        ]);

        Post::factory(27)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima quam necessitatibus, repellat voluptates',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus eius exercitationem accusamus atque cumque iusto ipsam, odit est nostrum accusantium, dolorem recusandae cum aut repudiandae omnis deleniti facilis sequi, harum? Magni ipsam a praesentium fuga nemo doloremque consectetur, pariatur aspernatur repellendus nihil quam ad enim dolore possimus culpa quasi natus non veritatis id neque! Nihil repellendus illum tempore incidunt nesciunt nam rem accusantium sit minus enim unde fugiat aliquid pariatur eum dignissimos possimus suscipit corporis fugit, quisquam similique cum dolor.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima quam necessitatibus, repellat voluptates',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus eius exercitationem accusamus atque cumque iusto ipsam, odit est nostrum accusantium, dolorem recusandae cum aut repudiandae omnis deleniti facilis sequi, harum? Magni ipsam a praesentium fuga nemo doloremque consectetur, pariatur aspernatur repellendus nihil quam ad enim dolore possimus culpa quasi natus non veritatis id neque! Nihil repellendus illum tempore incidunt nesciunt nam rem accusantium sit minus enim unde fugiat aliquid pariatur eum dignissimos possimus suscipit corporis fugit, quisquam similique cum dolor.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima quam necessitatibus, repellat voluptates',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus eius exercitationem accusamus atque cumque iusto ipsam, odit est nostrum accusantium, dolorem recusandae cum aut repudiandae omnis deleniti facilis sequi, harum? Magni ipsam a praesentium fuga nemo doloremque consectetur, pariatur aspernatur repellendus nihil quam ad enim dolore possimus culpa quasi natus non veritatis id neque! Nihil repellendus illum tempore incidunt nesciunt nam rem accusantium sit minus enim unde fugiat aliquid pariatur eum dignissimos possimus suscipit corporis fugit, quisquam similique cum dolor.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => 'judul-ke-empat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima quam necessitatibus, repellat voluptates',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus eius exercitationem accusamus atque cumque iusto ipsam, odit est nostrum accusantium, dolorem recusandae cum aut repudiandae omnis deleniti facilis sequi, harum? Magni ipsam a praesentium fuga nemo doloremque consectetur, pariatur aspernatur repellendus nihil quam ad enim dolore possimus culpa quasi natus non veritatis id neque! Nihil repellendus illum tempore incidunt nesciunt nam rem accusantium sit minus enim unde fugiat aliquid pariatur eum dignissimos possimus suscipit corporis fugit, quisquam similique cum dolor.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
