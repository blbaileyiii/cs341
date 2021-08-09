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

$events = getEventsJSON();
if($events){
    $events = json_decode($events, true);
    $navList = buildExpNavList($events);
} 

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'getCamp':
        $camp = filter_input(INPUT_GET, 'camp', FILTER_SANITIZE_STRING);
        if($camp){
            // Check if page exists...send to Home if not.

            $dir = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $camp;
            $images = scandir($dir);
            var_dump($images);

            $images2 = glob($dir . '/*.jpg');
            var_dump($images2)

            if((@include $_SERVER['DOCUMENT_ROOT'] . '/view/' . $camp . '.php') === false)
            {
                header('Location: /');
                exit;
            } 
        }
        header('Location: /');
        exit;
    case 'attributions':
        if($events){
            $navList = buildNavList($events);
        } 
        include $_SERVER['DOCUMENT_ROOT'] . '/view/attributions.php';
        break;
    default:
        if($events){
            $aboutHTML = buildAboutHTML($events);
            $contactsHTML = buildContactsHTML($events);
        }        
        // var_dump($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/view/home.php';
}
?>