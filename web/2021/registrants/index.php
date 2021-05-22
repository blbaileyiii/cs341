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
    default:
        $registrants = getRegistrants();
        if($registrants){
            $registrants = json_decode($registrants, true);
            $registrantsTable = buildRegistrantsHTML($registrants);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registrants.php';
            exit; 
        } 
        break;
}
?>