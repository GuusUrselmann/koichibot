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
    function getRarity($weights) {
        // $sum_base = 0;
        // foreach($weights_base as $weight) {
        //     $sum_base += $weight;
        // }
        // $weights_alt = [];
        // foreach($weights_base as $weight_name => $weight) {
        //     $weights_alt[$weight_name] = floor($weights_base[$weight_name] + (($sum_base - $weights_base[$weight_name]) / 100 * $weight_boost));
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
