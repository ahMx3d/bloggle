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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
            PagesTableSeeder::class,
            CommentsTableSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}
