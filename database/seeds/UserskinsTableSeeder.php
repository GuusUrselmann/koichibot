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
            'name' => 'Classy Jotaro Kujo',
            'image' => 'userskins/ClassyJotaroKujo.jpg'
        ]);
        App\Userskin::create([
            'name' => 'Diavolo',
            'image' => 'userskins/Diavolo.jpg'
        ]);
        App\Userskin::create([
            'name' => 'Dio Brando',
            'image' => 'userskins/DioBrando.png'
        ]);
        App\Userskin::create([
            'name' => 'Giorno Giovanna',
            'image' => 'userskins/GiornoGiovanna.png'
        ]);
        App\Userskin::create([
            'name' => 'Guido Mista',
            'image' => 'userskins/GuidoMista.png'
        ]);
        App\Userskin::create([
            'name' => 'Jonathan Joestar',
            'image' => 'userskins/JonathanJoestar.jpg'
        ]);
        App\Userskin::create([
            'name' => 'Joseph Joestar',
            'image' => 'userskins/JosephJoestar.png'
        ]);
        App\Userskin::create([
            'name' => 'Jotaro Kujo',
            'image' => 'userskins/JotaroKujo.jpg'
        ]);
        App\Userskin::create([
            'name' => 'Noriaki Kakyoin',
            'image' => 'userskins/NoriakiKakyoin.jpg'
        ]);
    }
}
