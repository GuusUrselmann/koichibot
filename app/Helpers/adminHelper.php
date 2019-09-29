<?php

/**
 * menu_admin_sidebar
 */

if(!function_exists('menu_admin_sidebar')) {
    function menu_admin_sidebar() {
        $menu_items = [
            'dashboard' => [
                'name' => 'dashboard',
                'display_name' => 'dashboard',
                'slug' => 'menuitem_dashboard',
                'site_url' => 'admin/dashboard',
                'icon' => 'home',
                'permissions' => [],
                'submenu' => []
            ],
            'users' => [
                'name' => 'users',
                'display_name' => 'users',
                'slug' => 'menuitem_users',
                'site_url' => 'admin/users',
                'icon' => 'user',
                'permissions' => [],
                'submenu' => [
                    'users-all' => [
                        'name' => 'users-all',
                        'display_name' => 'all users',
                        'slug' => 'menuitem_users-all',
                        'site_url' => 'admin/users',
                        'permissions' => []
                    ]
                ]
            ],
            'stands' => [
                'name' => 'stands',
                'display_name' => 'stands',
                'slug' => 'menuitem_stands',
                'site_url' => 'admin/stands',
                'icon' => 'user',
                'permissions' => [],
                'submenu' => [
                    'stands-all' => [
                        'name' => 'stands-all',
                        'display_name' => 'all stands',
                        'slug' => 'menuitem_stands-all',
                        'site_url' => 'admin/stands',
                        'permissions' => []
                    ]
                ]
            ],
            'levels' => [
                'name' => 'levels',
                'display_name' => 'levels',
                'slug' => 'menuitem_levels',
                'site_url' => 'admin/levels',
                'icon' => 'user',
                'permissions' => [],
                'submenu' => [
                    'levels-all' => [
                        'name' => 'levels-all',
                        'display_name' => 'all levels',
                        'slug' => 'menuitem_levels-all',
                        'site_url' => 'admin/levels',
                        'permissions' => []
                    ]
                ]
            ]
        ];

        $menu = [];

        foreach($menu_items as $item) {
            $menu[$item['name']] = $item;
        }

        return $menu;
    }
}
