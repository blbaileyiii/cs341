<?php
/*
 * Master Controller
 */
session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/query-model.php';
// Get the fxs for valiation and file building
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';


// if (isset($_POST)) {
//     $imageData=$_POST[0];
//     echo postSig($imageData);
// } else {
//     echo 'FAILED';
//     var_dump($_POST);
// }

$sigURL = filter_input(INPUT_POST, 'sig');
var_dump(filter_input(INPUT_POST, 'sig'));
$action = filter_input(INPUT_POST, 'action');
var_dump(filter_input(INPUT_POST, 'action'));

if(isset($sigURL)){
    echo postSig($sigURL);
} else {
    echo 'FAILED';
    var_dump($_POST);
}



?>