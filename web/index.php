<?php
/*
 * Domain Master Controller
 */
session_start();
// Get the database connection file
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/reg-model.php';
// Get the fxs for valiation and file building
//require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case '2021':
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/ymcamp.php';
        break;
    default:
        header('Location: /2021/');
        exit;
}