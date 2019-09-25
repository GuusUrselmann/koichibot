<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'discord_id' => '196748533536129026',
            'username' => 'messenwerper#9969',
            'password' => Hash::make('password'),
            'userlevel' => 'owner',
            'money' => 0,
            'userskin_id' => '1',
            'stand_id' => 9,
            'level_id' => 1
        ]);
        App\User::create([
            'discord_id' => '278550031848570881',
            'username' => 'Platigarde#2294',
            'password' => Hash::make('password'),
            'userlevel' => 'owner',
            'money' => 0,
            'userskin_id' => '2',
            'stand_id' => 8,
            'level_id' => 1
        ]);
        App\User::create([
            'discord_id' => '481056864231227422',
            'username' => 'Dog#0002',
            'password' => Hash::make('password'),
            'userlevel' => 'member',
            'money' => 0,
            'userskin_id' => '3',
            'stand_id' => 4,
            'level_id' => 1
        ]);
    }
}
