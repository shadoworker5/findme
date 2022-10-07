<?php

if (!function_exists('file_exist')) {
    function file_exist($file_name) {
        return file_exists($file_name);
    }
}

if (!function_exists('save_result')) {
    function save_result($file_name, $content) {
        file_put_contents($file_name, $content);
    }
}

if (!function_exists('set_config')) {
    function set_config() {
        return json_decode(file_get_contents('../../conf.json'));
    }
}

if (!function_exists('get_user_ip')) {
    function get_user_ip() {
        // if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        // } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        // } else {
        //     $ipaddress = $_SERVER['REMOTE_ADDR'];
        // }
        
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $ipaddress;
    }
}
