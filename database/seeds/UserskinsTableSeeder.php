<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserskinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Userskin::create([
            'name' => 'Koichi',
            'image' => 'userskins/Koichi.png'
        ]);
        App\Userskin::create([
            'name' => 'Platigarde',
            'image' => 'userskins/Platigarde.png'
        ]);
        App\Userskin::create([
            'name' => 'Dog',
            'image' => 'userskins/Dog.png'
        ]);
    }
}
