<?php
session_start();
/*
 * Character(s) Controller
 */

// Secure area.
// Immediately Check for login/username. 
// If it has not been created then bump them to the login page.
$username = $_SESSION['eowSession']['username'];
if(empty($username)){
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
        $character = getCharacter($username, $charname);
        $characterHTML = getCharacterHTML($character);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character.php';
        break;
    case 'char-edit':
        $charname = filter_input(INPUT_POST,'character');
        $character = getCharacter($username, $charname);
        
        $playableRaces = getPlayableRaces();
        $playableOptions = getPlayableOptions($playableRaces, $character);
        // Run edit.
        //var_dump($_POST);        
        $characterHTML = getCharEditHTML($character, $playableOptions);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character.php';
        break;
    case 'save-edit':
        //var_dump($_POST);
        $character = [];
        foreach($_POST as $charInfo => $val){
            $character[$charInfo] = filter_input(INPUT_POST, $charInfo);
        }
        //echo "<br><br>";
        //var_dump($character);
        
        $message = saveEdits($username, $character);
        $characters = getCharacters($username);
        $charactersHTML = getCharactersHTML($characters);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/characters.php';
        break;
    case 'char-delete-verify':
        $charid = filter_input(INPUT_POST,'charid');
        $charname = filter_input(INPUT_POST,'character');        
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character-delete.php';
        break;
    case 'char-delete':
        $charid = filter_input(INPUT_POST,'charid');        

        $message = deleteCharacter($username, $charid);

        // If the delete fails you will be looking at your character again...
        $charname = filter_input(INPUT_POST,'character');
        $character = getCharacter($username, $charname);
        $characterHTML = getCharacterHTML($character);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character.php';
        break;
    case 'char-create':
        $playableRaces = getPlayableRaces();
        $playableOptions = getPlayableOptions($playableRaces, null);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/character-create.php';
        break;
    case 'save-new':
        $character = [];
        foreach($_POST as $charInfo => $val){
            $character[$charInfo] = filter_input(INPUT_POST, $charInfo);
        }
        $message = saveChar($username, $character);
        $characters = getCharacters($username);
        $charactersHTML = getCharactersHTML($characters);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/characters.php';
        break;
        break;
    case 'cancel':
        header('Location: /project/character/');
        exit;
    case 'Search':
        $searchparm = filter_input(INPUT_GET,'charname', FILTER_SANITIZE_STRING);
        $characters = searchCharacters($username, $searchparm);
        $charactersHTML = getCharactersHTML($characters);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/characters.php';
        break;
    default:
        $characters = getCharacters($username);
        $charactersHTML = getCharactersHTML($characters);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/characters.php';
        break;
}

?>