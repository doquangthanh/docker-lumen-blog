<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('TagsTableSeeder');
        $this->command->info('Tags table seeded!');

        $this->call('CategoriesTableSeeder');
        $this->command->info('Categories table seeded!');

        $this->call('RolesTableSeeder');
        $this->command->info('Roles table seeded!');

        $this->call('UsersTableSeeder');
        $this->command->info('Users table seeded!');

        $this->call('PostsTableSeeder');
        $this->command->info('Posts table seeded!');

        $this->call('PostTagTableSeeder');
        $this->command->info('Post_Tag table seeded!');
    }
}
