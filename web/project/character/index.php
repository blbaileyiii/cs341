<?php
session_start();
/*
 * Character(s) Controller
 */

// Secure area.
// Immediately Check for login/username. 
// If it has not been created then bump them to the login page.
$username = $_SESSION['eowSession']['username'];
$userhashpass = $_SESSION['eowSession']['userhashpass'];
if(empty($username) || empty($userhashpass)){
    header('Location: /project/account/index.php');
    exit;
}

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Get all unsecured data
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/char-mgmt-model.php';

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
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character.php';
        break;
    case 'char-edit':
        $charname = filter_input(INPUT_GET,'character');
        // Run edit.
        //var_dump($_POST);
        $character = getCharacter($username, $userhashpass, $charname);
        $characterHTML = getCharEditHTML($character);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character.php';
        break;
    case 'char-delete':
        $charname = filter_input(INPUT_GET,'character');        
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character-delete.php';
        break;
    case 'char-create':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character-new.php';
        break;
    default:
        $characters = getCharacters($username, $userhashpass);
        $charactersHTML = getCharactersHTML($characters);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/characters.php';
        break;
}

?>