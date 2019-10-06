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
    function getRarity($weights_base, $weight_boost) {
        $sum_base = 0;
        foreach($weights_base as $weight) {
            $sum_base += $weight;
        }
        $weights_alt = [];
        foreach($weights_base as $weight_name => $weight) {
            $weights_alt[$weight_name] = floor($weights_base[$weight_name] + (($sum_base - $weights_base[$weight_name]) / 100 * $weight_boost));
        }
        $sum_alt = 0;
        foreach($weights_alt as $weight) {
            $sum_alt += $weight;
        }
        $result_num = rand(0, $sum_alt);
        $num_current = 0;
        $result = '';
        foreach($weights_alt as $weight_name => $weight) {
            $num_current += $weight;
            if($result_num <= $num_current) {
                $result = $weight_name;
                break;
            }
        }
        return $result;
    }
}
//apply same for arrays of numbers
