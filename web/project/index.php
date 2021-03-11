<?php
session_start();
/*
 * Master Controller
 */

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Get all unsecured data
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$message = "";

switch($action){      
    case 'races':
        $races = getRaces();
        $racesHTML = getRacesHTML($races);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/races.php';
        break;
    case 'template':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/template.php';
        break;
    default:
        $news = getNews();
        $newsHTML = getNewsHTML($news);
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/news.php';
}

?>