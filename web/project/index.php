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