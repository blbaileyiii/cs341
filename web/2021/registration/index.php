<?php

/*
 * Registration Controller
 */

// Get the database connection file
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camp2021/library/connections.php';
// Get the Main Whimsy model for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camp2021/models/main-model.php';
// Get the Main Whimsy model for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camp2021/functions/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    default:
        //include $_SERVER['DOCUMENT_ROOT'] . '/camp2021/view/home.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
}

?>