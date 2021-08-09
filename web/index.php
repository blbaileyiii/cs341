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

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'ymcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/view/ymcamp.php';
        break;
    case 'ywcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/view/ywcamp.php';
        break;
    case 'trek':
        include $_SERVER['DOCUMENT_ROOT'] . '/view/trek.php';
        break;
    case 'attributions':
        include $_SERVER['DOCUMENT_ROOT'] . '/view/attributions.php';
        break;
    case 'esig-show' :
        include $_SERVER['DOCUMENT_ROOT'] . '/view/esig-show.php';
        break;
    default:
        $events = getEventsJSON();
        if($events){
            $events = json_decode($events, true);
            $aboutHTML = buildAboutHTML($events);
            $contactsHTML = buildContactsHTML($events);
        }        
        // var_dump($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/view/home.php';
}
?>