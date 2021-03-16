<?php

/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once '/2021/models/reg-model.php';
// Get the fxs for valiation and file building
require_once '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'ymcamp':
        include '/2021/view/ymcamp.php';
        break;
    case 'ywcamp':
        include '/2021/view/ywcamp.php';
        break;
    case 'trek':
        include '/2021/view/trek.php';
        break;
    default:
        $events = getEvents(2021);
        $aboutHTML = buildAboutHTML($events);
        $contactsHTML = buildContactsHTML($events);
        include '/2021/view/home.php';
}
?>