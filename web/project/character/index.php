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
require_once $currRoot . '/project/model/char-mgmt-model.php';

$username = $_SESSION['eowSession']['username'];
$userhashpass = $_SESSION['eowSession']['userhashpass'];
if(empty($username) || empty($userhashpass)){
    header('Location: /project/account/index.php');
    exit;
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$message = "";

switch($action){    
    case 'char-info':
        $charname = filter_input(INPUT_GET,'character');
        $character = getCharacter($username, $userhashpass, $charname);
        $characterHTML = getCharacterHTML($character);
        include $currRoot . '/project/view/character.php';
        break;
    case 'char-mgmt':
        $charname = filter_input(INPUT_GET,'character');
        if (!empty($_POST['edit'])) {
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
    default:
        $characters = getCharacters($username, $userhashpass);
        $charactersHTML = getCharactersHTML($characters);
        include $currRoot . '/project/view/characters.php';
        break;
}

?>