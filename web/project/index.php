<?php
session_start();
/*
 * Master Controller
 */
if(substr($_SERVER['DOCUMENT_ROOT'], 0, 4) == '/app'){
    $currRoot = $_SERVER['DOCUMENT_ROOT'];
} else {
    $currRoot = $_SERVER['DOCUMENT_ROOT'] . '/CS341/web';
}

// Get the database connection file
require_once $currRoot . '/project/libraries/connections.php';
// Get the Taxaonomy table for use as needed
require_once $currRoot . '/project/model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$message = "";

switch($action){
    case 'logon':
        include $currRoot . '/project/view/login.php';
        break;
    case 'login':
        $message = login();
        include $currRoot . '/project/view/login.php';
        break;
    case 'registration':
        include $currRoot . '/project/view/registration.php';
        break;
    case 'logout':        
        $message = logout();
        include $currRoot . '/project/view/login.php';
        break;
    case 'register':
        $message = register();
        include $currRoot . '/project/view/registration.php';
        break;
    case 'verify-email':
        $message = "Account Created: Verify Email Before Logging In";
        include $currRoot . '/project/view/login.php';
        break;
    case 'account':
        $username = $_SESSION['eowSession']['username'];
        $userhashpass = $_SESSION['eowSession']['userhashpass'];
        if(empty($username) || empty($userhashpass)){            
            include $currRoot . '/project/view/login.php';
        } else {
            $characters = getCharacters($username, $userhashpass);
            $charactersHTML = getCharactersHTML($characters);
            include $currRoot . '/project/view/account.php';
        }  
        
        break;
    case 'races':
        $races = getRaces();
        $racesHTML = getRacesHTML($races);
        include $currRoot . '/project/view/races.php';
        break;
    case 'template':
        include $currRoot . '/project/view/template.php';
        break;
    default:
        include $currRoot . '/project/view/news.php';
}

?>