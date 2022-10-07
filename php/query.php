<?php
include('helpers.php');

$get_data_in_json = json_decode(file_get_contents('php://input'), true);
if ($get_data_in_json) {
    $file_name = date('Y-m-d');
    $RESULT_DB_PATH = "../../db/$file_name.json";
    $get_data_in_json['user_ip'] = get_user_ip();
    
    if (file_exist($RESULT_DB_PATH)) {
        $current_file_content = json_decode(file_get_contents($RESULT_DB_PATH), true);
        array_push($current_file_content, $get_data_in_json);
        $update_file_conent = json_encode($current_file_content, JSON_PRETTY_PRINT);
        save_result($RESULT_DB_PATH, $update_file_conent);
    } else {
        $create_file_conent = json_encode([$get_data_in_json], JSON_PRETTY_PRINT);
        save_result($RESULT_DB_PATH, $create_file_conent);
    }
}