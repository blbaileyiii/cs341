<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/reg-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/equipment-model.php';
// Get the fxs for valiation and file building
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'getEquipment':
        echo getEquipmentJSON();
        break;
    default:
        if (!isset($_SESSION['equipment'])){
            $_SESSION['equipment'] = getEquipment();
        }        
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/equipment.php';
        break;
}
?>