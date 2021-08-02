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

switch($action){
    case "getPaperwork":
        $events = getEventsJSON();
        if($events){
            $events = json_decode($events, true);
            $eventsHTML = buildEventsHTML($events, $year);
            include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/paperwork.php';
            exit; 
        }
        break;
    case "print":
        $event = filter_input(INPUT_GET, 'event');
        $registrants = getPaperwork($event);
        if($registrants){
            $registrants = json_decode($registrants, true);
            $permissionSlipsHTML = buildPermissionSlipsHTML($registrants);
            include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/print.php';
            exit; 
        } 
        break;
    default:
        $registrants = getRegistrants();
        if($registrants){
            $registrants = json_decode($registrants, true);
            $registrantsTable = buildRegistrantsHTML($registrants);
            include $_SERVER['DOCUMENT_ROOT'] . '/camps/view/registrants.php';
            exit; 
        } 
        break;
}
?>