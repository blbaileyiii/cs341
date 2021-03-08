<?php

/*
 * Master Controller
 */
session_start();
// Get the database connection file
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the account model for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/accounts-model.php';
// Get the account validation fxs for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

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
    default:
        //include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/home.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/home.php';
}
?>