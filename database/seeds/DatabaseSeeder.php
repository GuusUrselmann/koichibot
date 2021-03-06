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
        $this->call(LevelsTableSeeder::class);
        $this->call(UserskinsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StandsTableSeeder::class);
        $this->call(QuestsTableSeeder::class);
        $this->call(AbilitiesTableSeeder::class);
        $this->call(ArtifactsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(SearchesTableSeeder::class);
    }
}
