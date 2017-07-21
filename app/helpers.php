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

    /**
     * Define link route
     * @param  array $path
     * @return string
     */
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

if (!function_exists('selected_category')) {

    /**
     * Define value selected category
     * @param  integer $value
     * @param  integer $defaultValue
     * @return string
     */
    function selected_category($value, $defaultValue) {
        return $value === $defaultValue ? 'selected' : '';
    }
}

if (!function_exists('selected_label')) {

    /**
     * Define value selected label
     * @param  integer $value
     * @param  integer $value
     * @return string
     */
    function selected_label($value, $labels) {
        return in_array($value, $labels) ? 'selected' : '';
    }
}