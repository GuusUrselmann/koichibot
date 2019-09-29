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
