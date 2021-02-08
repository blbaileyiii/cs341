<?php
session_start();
/*
 * Account(s) Controller
 */

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Load the login functions
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/acct-mgmt-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$message = "";

switch($action){
    case 'login':
        $message = login();
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        break;
    case 'registration':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/registration.php';
        break;
    case 'logout':        
        $message = logout();
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        break;
    case 'register':
        $message = register();
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/registration.php';
        break;
    case 'verify-email':
        $message = "Account Created: Verify Email Before Logging In";
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        break;    
    case 'account':
        $username = $_SESSION['eowSession']['username'];
        $userhashpass = $_SESSION['eowSession']['userhashpass'];
        if(empty($username) || empty($userhashpass)){            
            include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/project/view/account.php';
        }
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/login.php';
        break;
}

?>