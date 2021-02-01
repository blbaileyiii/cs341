<?php
/*
 * Accounts Controller
 */

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Get the db functions for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

register();

switch($action){
    case 'login':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        break;
    case 'registration':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/registration.php';
        break;
    case 'account':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/account.php';
    default:
        break;
}

?>