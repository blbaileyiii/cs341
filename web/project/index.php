<?php

/*
 * Master Controller
 */

// Get the database connection file
echo "starting include";
include $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Get the Taxaonomy table for use as needed
//require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/main-model.php';
//eowConnect();

// Get the taxonomy array
//$taxonomy = getTaxonomy();

//var_dump($taxonomy);
//	exit;

// Build a navigation bar using the $classifications array
//$navList = '<nav><ul>';
//$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
//foreach ($classifications as $classification) {
//    $navList .= "<li><a href='/phpmotors/index.php?action=". urlencode($classification['classificationName']) ."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
//}
//$navList .= '</ul></nav>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'template':
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/template.php';
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/project/view/home.php';
}

?>