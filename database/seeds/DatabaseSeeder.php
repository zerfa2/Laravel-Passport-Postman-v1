<?php

use App\User;
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
        // $this->call(UsersTableSeeder::class);
        
        factory(User::class)->times(10)->create();
        factory(\App\Post::class,15)->create();
        factory(\App\Comment::class,10)->create();
        
        // factory(\App\User::class)->times(1)->create(['admin'=>true])
        // ->each(function(\App\User $user){
        //     factory(\App\Post::class,2)->create(['author_id'=>$user->id])
        //     ->each(function(\App\Post $p){
        //         factory(\App\Comment::class)->times(2)->create(['post_id' => $p->id]);
        //     });
        // });
    }
}
