<?php
if (!function_exists('active_link')) {
    /**
     * Set active ul list menu
     * @param  boolean $active
     * @return string
     */
    function active_link($active) {
        return $active ? 'active': '';
    }
}

if (!function_exists('define_link')) {

    function define_link($path) {
        $link = '';

        if (!$path['active']) {
            $link .= '<a href="'.define_route($path['link']).'">'.$path['name'].'</a>';
        } else {
            $link = $path['name'];
        }

        return $link;
    }

}

if (!function_exists('define_route')) {
    /**
     * Set route list menu
     * @param  boolean $active
     * @return string
     */
    function define_route($route) {
        return $route !== '#' ? route($route) : '#';
    }
}