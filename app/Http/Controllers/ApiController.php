<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Classes\Fighter;
use App\Classes\Fight;
use App\User;
use App\Stand;
use App\Quest;
use App\Artifact;
use App\Job;
use App\Search;

class ApiController extends Controller
{
    public function __construct() {
        //$this->middleware('api');
    }

    //TODO: ///
    public function stand(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $data = [
            'user' => $user,
            'response' => 'success'
        ];
        return $data;
    }

    //TODO: ///
    public function setup(Request $request) {
        $dataPost = $request->all();
        $user = User::where('username', $dataPost['username'])->first();
        if($user != null) {
            return ['response' => 'userExists'];
        }
        $stand = Stand::where('type', 'standard')->get()->random();
        $password = Str::random(16);
        $stats = ['E','D','C'];
        $userNew = User::create([
            'discord_id' => $dataPost['discord_id'],
            'username' => $dataPost['username'],
            'password' => Hash::make($password),
            'userlevel'=> 'member',
            'money'=> 0,
            'userskin_id'=> 1,
            'stand_id' => $stand->id,
            'health' => 30,
            'power_min' => 10,
            'power_max' => 20,
            'power' => $stats[array_rand($stats)],
            'speed' => $stats[array_rand($stats)],
            'range' => $stats[array_rand($stats)],
            'durability' => $stats[array_rand($stats)],
            'precision' => $stats[array_rand($stats)],
            'potential' => $stats[array_rand($stats)],
            'level_id' => 1,
            'experience' => 0,
            'unlocks_userskins' => 1
        ]);
        $data = [
            'user' => $userNew,
            'stand' => $stand,
            'password' => $password,
            'response' => 'success'
        ];
        return $data;
    }

    //TODO: ///
    public function profile(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand', 'userskin')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $level = $user->level();
        $levelNext = $user->level(1);
        $data = [
            'user' => $user,
            'level' => $level,
            'levelNext' => $levelNext,
            'response' => 'success'
        ];
        return $data;
    }

    //TODO: ///
    public function quest(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $rarity_boost = $user->getLevelBoost();
        //Get quest
        $quest = Quest::fromRarity($rarity_boost)->inRandomOrder()->first();
        //Get player as fighter (to alter stats if need be)
        $player = new Fighter('player', $user->stand_id, $user->health, $user->power_min, $user->power_max, $user->power, $user->speed, $user->range, $user->durability, $user->precision, $user->potential, $user->abilities, $user->level()->level);
        //Generate enemy as fighter (to alter stats if need be)
        $enemy = $user->generateEnemy($quest->difficulty);
        $fight = new Fight($player, $enemy);
        $fight->start();
        $rewards = [];
        if($fight->winner_fighter->type == 'player') {
            //generate money
            $rewards['money']['amount'] = ceil(rand($quest->money_spread*.8, $quest->money_spread*1.2)+$user->level()->level);
            $rewards['money']['description'] = '**+**'.($rewards['money']['amount'] - $user->level()->level).' money **+** '.$user->level()->level.' level bonus';
            $rewards['experience']['amount'] = ceil(rand($quest->experience_spread*.8, $quest->experience_spread*1.2));
            $rewards['experience']['description'] = '**+**'.$rewards['experience']['amount'].' Exp.';

            $artifact_chance = getRarity(weights_artifactchance($quest->rarity));
            if($artifact_chance == 'success') {
                $artifact_weights = weights_artifact($quest->rarity);
                $artifact_rarity = getRarity($artifact_weights);
                $artifact = Artifact::where('rarity', $artifact_rarity)->inRandomOrder()->first();
                $rewards['artifact']['item'] = $artifact;
                $rewards['artifact']['description'] = 'You found **'.$artifact->name.'**! that\'s pretty **'.$artifact->rarity.'**.';

            }
            $user->reward($rewards);
        }
        $data = [
            'user' => $user,
            'quest' => $quest,
            'player' => $player,
            'enemy' => $enemy,
            'fight' => $fight,
            'rewards' => $rewards,
            'response' => 'success'
        ];
        return $data;
    }

    //TODO: ///
    public function job(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $job_weights = weights_job();
        $job_rarity = getRarity($job_weights);
        $job = Job::where('rarity', $job_rarity)->inRandomOrder()->first();
        //generate reward(s)
        $rewards = [];
        //money
        $rewards['money']['amount'] = ceil(rand($job->money_spread*.8, $job->money_spread*1.2));
        $rewards['money']['description'] = '**+**'.($rewards['money']['amount']).' money';
        $user->reward($rewards);
        $data = [
            'user' => $user,
            'job' => $job,
            'rewards' => $rewards,
            'response' => 'success'
        ];
        return $data;
    }

    //TODO: ///
    public function search(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        $search_weights = weights_search();
        $search_rarity = getRarity($search_weights);
        $search = Search::where('rarity', $search_rarity)->inRandomOrder()->first();
        //generate reward(s)
        $rewards = [];
        //money
        if(rand(0, 100) <= 40) {
            $rewards['money']['amount'] = ceil(rand($search->money_spread*.8, $search->money_spread*1.2));
            $rewards['money']['description'] = '**+**'.($rewards['money']['amount']).' money';
        }
        //arrow
        if(rand(0, 100) <= 40) {
            $arrow = arrow_get();
            $rewards['arrow']['item'] = $arrow;
            $rewards['arrow']['description'] = '**+**'.$arrow;
        }
        //artifact
        $artifact_chance = getRarity(weights_artifactchance($search->rarity));
        if($artifact_chance == 'success') {
            $artifact_weights = weights_artifact($search->rarity);
            $artifact_rarity = getRarity($artifact_weights);
            $artifact = Artifact::where('rarity', $artifact_rarity)->inRandomOrder()->first();
            $rewards['artifact']['item'] = $artifact;
            $rewards['artifact']['description'] = 'You found **'.$artifact->name.'**! that\'s pretty **'.$artifact->rarity.'**.';
        }
        //or userskin
        elseif(rand(0, 100) <= 40) {
            //TODO: Add userskin possibility
        }

        $user->reward($rewards);
        $data = [
            'user' => $user,
            'search' => $search,
            'rewards' => $rewards,
            'response' => 'success'
        ];
        return $data;
    }

    public function arrow(Request $request) {
        $dataPost = $request->all();
        $user = User::with('stand')->where('username', $dataPost['username'])->first();
        $arrow = $dataPost['arrow'];
        // $user = User::with('stand')->where('username', 'messenwerper#9969')->first();
        // $arrow = 'overheaven';
        if($arrow != 'regular' || $arrow != 'requiem' || $arrow != 'overheaven') {
            return ['response' => 'arrowNull'];
        }
        if(!$user) {
            return ['response' => 'userEmpty'];
        }
        if(!$user->arrow_has($arrow)) {
            return ['response' => 'arrowEmpty'];
        }
        $stand_weights = weights_stand_arrow($arrow);
        $rarity = getRarity($stand_weights);
        $stand = Stand::where('rarity', $rarity)->inRandomOrder()->first();
        $stats_weights = weights_stats($rarity);
        $stats = stats_generate($stats_weights);
        $user->arrow_remove($arrow);
        $data = [
            'user' => $user,
            'stand' => $stand,
            'stats' => $stats,
            'response' => 'success'
        ];
        //Achievement checkup (/unlock)
        return $data;
    }
}
