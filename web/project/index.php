<?php

/*
 * Master Controller
 */

// Get the database connection file
echo $_SERVER['DOCUMENT_ROOT'];

if(substr($_SERVER['DOCUMENT_ROOT'], 0, 4) == 'http'){
    echo 'webpage';
} else {
    echo 'local drive...'
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/project/libraries/connections.php';
// Get the Taxaonomy table for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/project/model/main-model.php';

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