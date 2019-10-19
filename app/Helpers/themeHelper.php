<?php

/**
 * has_permissions
 */

if(!function_exists('has_permissions')) {
    function has_permissions($permissions) {
        (array) $permissions;
        foreach($permissions as $permission) {
            //check user permissions
        }
        return true;
    }
}

/**
 * load_icon
 */

if(!function_exists('load_icon')) {
    function load_icon($icon_name) {
        return '<i class="fa fas far fal fab fa-'.$icon_name.'"></i>';
    }
}

if(!function_exists('statToPercent')) {
    function statToPercent($stat) {
        $con = [
            'E' => .05,
            'D' => .10,
            'C' => .20,
            'B' => .30,
            'A' => .50,
            'UNKNOWN' => .65
        ];
        $percent = $con[$stat];
        return $percent;
    }
}

if(!function_exists('getRarity')) {
    /*HIGHEST OF WEIGHTS BASE IS SOLUTION*/
    function getRarity($weights, $boost = 0) {
        $highest_base = 0;
        foreach($weights as $weight) {
            if($weight > $highest_base) {
                $highest_base = $weight;

            }
        }
        // $weights_alt = [];
        // foreach($weights as $weight_name => $weight) {
        //     $weights_alt[$weight_name] = (($weight + ($highest_base - $weight)));
        // }
        $sum_alt = 0;
        foreach($weights as $weight) {
            $sum_alt += $weight;
        }
        $result_num = rand(0, $sum_alt);
        $num_current = 0;
        $result = '';
        foreach($weights as $weight_name => $weight) {
            $num_current += $weight;
            if($result_num <= $num_current) {
                $result = $weight_name;
                break;
            }
        }
        $sum = 0;
        foreach($weights as $weight) {
            $sum += $weight;
        }
        $result_num = rand(0, $sum);
        $num_current = 0;
        $result = '';
        foreach($weights as $weight_name => $weight) {
            $num_current += $weight;
            if($result_num <= $num_current) {
                $result = $weight_name;
                break;
            }
        }
        return $result;

        // $highest_base = 0;
        // foreach($weights as $weight) {
        //     if($weight > $highest_base) {
        //         $highest_base = $weight;
        //     }
        // }
        // $weights_alt = [];
        // foreach($weights as $weight_name => $weight) {
        //     $weights_alt[$weight_name] = floor(($weight * (($highest_base / 100 * $boost) - $weight)));
        // }
        // $sum_alt = 0;
        // foreach($weights_alt as $weight) {
        //     $sum_alt += $weight;
        // }
        // $result_num = rand(0, $sum_alt);
        // $num_current = 0;
        // $result = '';
        // foreach($weights_alt as $weight_name => $weight) {
        //     $num_current += $weight;
        //     if($result_num <= $num_current) {
        //         $result = $weight_name;
        //         break;
        //     }
        // }
        // $sum = 0;
        // foreach($weights as $weight) {
        //     $sum += $weight;
        // }
        // $result_num = rand(0, $sum);
        // $num_current = 0;
        // $result = '';
        // foreach($weights as $weight_name => $weight) {
        //     $num_current += $weight;
        //     if($result_num <= $num_current) {
        //         $result = $weight_name;
        //         break;
        //     }
        // }
        // dd($weights_alt);
        // return $result;
    }
}

if(!function_exists('getRangeRarity')) {
    function getRangeRarity($range_min, $range_max, $boost) {
        // $range = $range_max - $range_min;
        // $weights_base = [];
        // $sum_base = 0;
        // //generate base weights (1 for each)
        // for($i = $range_min;$i < $range_max; $i++) {
        //     $weights_base[$i] = 1;
        //     $sum_base += 1;
        // }
        // $weights_alt = [];
        // for($i = 0;$i < $sum_base;$i++) {
        //     $weights_alt[$range_min + $i] = $sum_base - (($range_min + $i) - $sum_base) * $sum_base * ($boost / 100);
        //     //$weights_alt[$i] = floor(1 + $weights_base[$range_min + $i] / 100 * $boost);
        // }
        // // foreach($weights_base as $weight_int => $weight) {
        // //     $weights_alt[$weight_int] = floor($weight_int / 100 * $boost);
        // //     //$weights_alt[$weight_int] = floor($weights_base[$weight_int] + (($sum_base - ($sum_base - $weight_int)) / 100 * $boost));
        // // }
        // dd($weights_alt);
        // $sum_alt = 0;
        // foreach($weights_alt as $weight) {
        //     $sum_alt += $weight;
        // }
        // $result_num = rand(0, $sum_alt);
        // $num_current = 0;
        // $result = '';
        // foreach($weights_alt as $weight_name => $weight) {
        //     $num_current += $weight;
        //     if($result_num <= $num_current) {
        //         $result = $weight_name;
        //         break;
        //     }
        // }
        // // floor(250 - (250 - int))
        // dd($weights_alt);
        // return $result;
    }
}

if(!function_exists('weights_artifact')) {
    function weights_artifact($cat) {
        if($cat == 'common') {
            return [
                'common' => 1000,
                'uncommon' => 700,
                'rare' => 400,
                'epic' => 100,
                'legendary' => 30,
                'ascended' => 1
            ];
        }
        elseif($cat == 'uncommon') {
            return [
                'common' => 700,
                'uncommon' => 1000,
                'rare' => 700,
                'epic' => 400,
                'legendary' => 100,
                'ascended' => 30
            ];
        }
        elseif($cat == 'rare') {
            return [
                'common' => 400,
                'uncommon' => 700,
                'rare' => 1000,
                'epic' => 700,
                'legendary' => 400,
                'ascended' => 100
            ];
        }
        elseif($cat == 'epic') {
            return [
                'common' => 100,
                'uncommon' => 400,
                'rare' => 700,
                'epic' => 1000,
                'legendary' => 700,
                'ascended' => 400
            ];
        }
        elseif($cat == 'legendary') {
            return [
                'common' => 30,
                'uncommon' => 100,
                'rare' => 400,
                'epic' => 700,
                'legendary' => 1000,
                'ascended' => 700
            ];
        }
        elseif($cat == 'ascended') {
            return [
                'common' => 1,
                'uncommon' => 30,
                'rare' => 100,
                'epic' => 400,
                'legendary' => 700,
                'ascended' => 1000
            ];
        }
    }
}

if(!function_exists('weights_artifactchance')) {
    function weights_artifactchance($cat) {
        if($cat == 'common') {
            return [
                'fail' => 9500,
                'success' => 500
            ];
        }
        elseif($cat == 'uncommon') {
            return [
                'fail' => 9000,
                'success' => 1000
            ];
        }
        elseif($cat == 'rare') {
            return [
                'fail' => 8000,
                'success' => 2000
            ];
        }
        elseif($cat == 'epic') {
            return [
                'fail' => 7000,
                'success' => 3000
            ];
        }
        elseif($cat == 'legendary') {
            return [
                'fail' => 6000,
                'success' => 4000
            ];
        }
        elseif($cat == 'ascended') {
            return [
                'fail' => 5000,
                'success' => 5000
            ];
        }
    }
}

if(!function_exists('weights_job')) {
    function weights_job() {
        return [
            'common' => 6000,
            'uncommon' => 2500,
            'rare' => 1000,
            'epic' => 400,
            'legendary' => 90,
            'ascended' => 10
        ];
    }
}
