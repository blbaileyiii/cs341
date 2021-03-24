<?php
/*
 * Master Controller
 */
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/json-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'getEvents':
        echo getEventsJSON(2021);
        break;
    case 'getEquipment':
        echo getEquipmentJSON();
        break;
    default:
        break;
}
?>