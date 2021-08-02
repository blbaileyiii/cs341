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


if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
    $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
    echo postSig($imageData);
} else {
    echo 'FAILED';
    var_dump($_POST);
}

?>