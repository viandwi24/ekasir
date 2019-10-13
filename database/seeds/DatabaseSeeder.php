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
        $name = $this->command->info('');
        $name = $this->command->info('=================================================');
        $name = $this->command->info('==========[EKASIR - DATABASE SEEDER]=============');
        $name = $this->command->info('=================================================');

        if ($this->command->confirm('Run Users Setup ?')) {
            $this->call(UsersTableSeeder::class);
        }

        $name = $this->command->info('=================================================');
        $name = $this->command->info('');
    }
}
