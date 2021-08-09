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
    case "print":
        $event = filter_input(INPUT_GET, 'event');
        $id = filter_input(INPUT_GET, 'id');

        $id = checkInt($id);
        echo $id;
        $registrants = getPaperwork($event, $id);
        if($registrants){
            $registrants = json_decode($registrants, true);
            echo $id;
            if($id > -1){
                $permissionSlipsHTML = buildPermissionSlipsHTML($registrants);
            }            
            include $_SERVER['DOCUMENT_ROOT'] . '/view/print.php';
            exit; 
        } 
        break;
    default:
        $registrants = getRegistrants();
        if($registrants){
            $registrants = json_decode($registrants, true);
            $registrantsTable = buildRegistrantsHTML($registrants);
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registrants.php';
            exit; 
        } 
        break;
}
?>