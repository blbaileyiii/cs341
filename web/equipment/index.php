<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/query-model.php';
// Get the fxs for valiation and file building
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/fx.php';

$events = getEventsJSON();
if($events){
    $events = json_decode($events, true);
    $navList = buildNavList($events);
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'updateList':
        break;
    default:     
        include $_SERVER['DOCUMENT_ROOT'] . '/view/equipment.php';
        break;
}
?>