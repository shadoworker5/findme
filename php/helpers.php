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
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        
        return $ip;
    }
}
