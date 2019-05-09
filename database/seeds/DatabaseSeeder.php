<?php

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
        $sql = database_path('sql/countries.sql');
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents($sql));

        $sql = database_path('sql/states.sql');
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents($sql));

        $sql = database_path('sql/cities.sql');
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents($sql));

        \Illuminate\Support\Facades\DB::table('roles')->insert(['name'=>'administrator']);
        \Illuminate\Support\Facades\DB::table('roles')->insert(['name'=>'user']);
        \Illuminate\Support\Facades\DB::table('roles')->insert(['name'=>'property_owner']);

        factory(\App\Models\Category::class, 50)->create();
        factory(\App\Models\Tag::class,150)->create();

        factory(\App\Models\User::class, 50)->create()->each(function($u){
            $u->profile()->save(factory(\App\Models\Profile::class)->make());
            $u->roles()->attach(\App\Models\Role::all()->random()->id);
        });

        factory(\App\Models\PropertyObject::class, 500)->create(['user_id'=>\App\Models\User::all()->random()->id])->each(function($o){
            $o->categories()->sync(\App\Models\Category::limit(rand(1,10))->get()->pluck('id'));
            $o->tags()->sync(\App\Models\Tag::limit(rand(1,10))->get()->pluck('id'));
            $o->ratings()->save(factory(\App\Models\Rating::class)->make(['user_id'=>\App\Models\User::all()->random()->id, 'property_object_id'=>\App\Models\PropertyObject::all()->random()->id]));
        });



    }
}
