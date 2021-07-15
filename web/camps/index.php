<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/models/query-model.php';
// Get the fxs for valiation and file building
require_once $_SERVER['DOCUMENT_ROOT'] . '/camps/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$year = 2021;

switch($action){
    case 'ymcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/ymcamp.php';
        break;
    case 'ywcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/ywcamp.php';
        break;
    case 'trek':
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/trek.php';
        break;
    case 'attributions':
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/attributions.php';
        break;
    default:
        $events = getEventsJSON($year);
        if($events){
            $events = json_decode($events, true);
            $aboutHTML = buildAboutHTML($events);
            $contactsHTML = buildContactsHTML($events);
        }        
        // var_dump($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/home.php';
}
?>