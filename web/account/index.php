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
    case "createAccount":
        include $_SERVER['DOCUMENT_ROOT'] . '/view/accountCreation.php';
        break;
    case "CreateAccount":
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/view/login.php';
        exit;
        break;
}

?>