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
// Get all unsecured data
require_once $currRoot . '/project/model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$message = "";

switch($action){    
    case 'char-info':
        $username = $_SESSION['eowSession']['username'];
        $userhashpass = $_SESSION['eowSession']['userhashpass'];
        $charname = filter_input(INPUT_GET,'character');
        if(empty($username) || empty($userhashpass)){
            include $currRoot . '/project/view/login.php';
            exit;
        }
        $character = getCharacter($username, $userhashpass, $charname);
        $characterHTML = getCharacterHTML($character);
        include $currRoot . '/project/view/character.php';
        break;
    case 'char-mgmt':
        $username = $_SESSION['eowSession']['username'];
        $userhashpass = $_SESSION['eowSession']['userhashpass'];
        $charname = filter_input(INPUT_GET,'character');
        if(empty($username) || empty($userhashpass)){            
            include $currRoot . '/project/view/login.php';
            exit;
        } else if (!empty($_POST['edit'])) {
            $charname = filter_input(INPUT_POST,'edit');
            // Run edit.
            //var_dump($_POST);
            $character = getCharacter($username, $userhashpass, $charname);
            $characterHTML = getCharEditHTML($character);
            include $currRoot . '/project/view/character.php';
        } else if (!empty($_POST['delete'])) {
            $charname = filter_input(INPUT_POST,'delete');
            // Run delete.
            //var_dump($_POST);
        } else {            
            $character = getCharacter($username, $userhashpass, $charname);
            $characterHTML = getCharacterHTML($character);
            include $currRoot . '/project/view/character.php';            
        }
        break;         
    case 'races':
        $races = getRaces();
        $racesHTML = getRacesHTML($races);
        include $currRoot . '/project/view/races.php';
        break;
    default:
        $news = getNews();
        $newsHTML = getNewsHTML($news);
        include $currRoot . '/project/view/news.php';
}

?>