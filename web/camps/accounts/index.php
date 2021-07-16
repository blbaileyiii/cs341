<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/libraries/connections.php';
// Get the registration model for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/models/query-model.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/models/equipment-model.php';
// Get the fxs for valiation and file building
//require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'login':
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/login.php';
        break;
    default:     
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/login.php';
        break;
}
?>