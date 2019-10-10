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
            'health' => 250,
            'power_min' => 34,
            'power_max' => 56,
            'power' => 'A',
            'speed' => 'A',
            'range' => 'A',
            'durability' => 'A',
            'precision' => 'A',
            'potential' => 'A',
            'abilities' => '1,3,4',
            'level_id' => 1,
            'experience' => 0,
            'unlocks_userskins' => '2'
        ]);
        App\User::create([
            'discord_id' => '278550031848570881',
            'username' => 'Platigarde#2294',
            'password' => Hash::make('password'),
            'userlevel' => 'owner',
            'money' => 0,
            'userskin_id' => '2',
            'stand_id' => 8,
            'health' => 250,
            'power_min' => 34,
            'power_max' => 56,
            'power' => 'A',
            'speed' => 'A',
            'range' => 'A',
            'durability' => 'A',
            'precision' => 'A',
            'potential' => 'A',
            'abilities' => '1,3,4',
            'level_id' => 1,
            'experience' => 16,
            'unlocks_userskins' => '1,2'
        ]);
        // App\User::create([
        //     'discord_id' => '481056864231227422',
        //     'username' => 'Dog#0002',
        //     'password' => Hash::make('password'),
        //     'userlevel' => 'member',
        //     'money' => 0,
        //     'userskin_id' => '3',
        //     'stand_id' => 4,
        //     'health' => 250,
        //     'power_min' => 34,
        //     'power_max' => 56,
        //     'power' => 'A',
        //     'speed' => 'A',
        //     'range' => 'A',
        //     'durability' => 'A',
        //     'precision' => 'A',
        //     'potential' => 'A',
        //     'level_id' => 1,
        //     'experience' => 0
        // ]);
        // App\User::create([
        //     'discord_id' => '353408166773653514',
        //     'username' => 'Illusive#3528',
        //     'password' => Hash::make('password'),
        //     'userlevel' => 'member',
        //     'money' => 0,
        //     'userskin_id' => '4',
        //     'stand_id' => 5,
        //     'health' => 250,
        //     'power_min' => 34,
        //     'power_max' => 56,
        //     'power' => 'A',
        //     'speed' => 'A',
        //     'range' => 'A',
        //     'durability' => 'A',
        //     'precision' => 'A',
        //     'potential' => 'A',
        //     'level_id' => 1,
        //     'experience' => 0
        // ]);
    }
}
