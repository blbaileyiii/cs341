<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/query-model.php';
// Get the fxs for valiation and file building
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'ymcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/ymcamp.php';
        break;
    case 'ywcamp':
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/ywcamp.php';
        break;
    case 'trek':
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/trek.php';
        break;
    case 'attributions':
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/attributions.php';
        break;
    default:
        $events = getEventsJSON(2021);
        $aboutHTML = buildAboutHTML($events);
        $contactsHTML = buildContactsHTML($events);
        var_dump($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/home.php';
}
?>