<?php
/*
 * Master Controller
 */
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/query-model.php';

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
    case 'getItems':
        break;
    case 'postItem':
        $reg_id = filter_input(INPUT_POST, 'reg_id', FILTER_SANITIZE_NUMBER_INT);
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
        $owned = filter_input(INPUT_POST, 'owned', FILTER_SANITIZE_STRING);
        $pur_price = filter_input(INPUT_POST, 'pur_price', FILTER_SANITIZE_NUMBER_FLOAT);
        // TODO VALIDATE THE 4 to make sure they are what they say they are, 
        // and then if they all exist push on...
        // postItemJSON($reg_id, $item_id, $owned, $pur_price);
        break;
    default:
        break;
}
?>