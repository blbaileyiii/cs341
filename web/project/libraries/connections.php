<?php

// <?php require_once './library/connections.php';
// <?php eowConnect();

function eowConnect(){
    try {
        $dbUrl = getenv('DATABASE_URL');

        echo $dbUrl;

        //$dbOpts = parse_url($dbUrl);

        //$dbHost = $dbOpts["host"];
        //$dbPort = $dbOpts["port"];
        //$dbUser = $dbOpts["user"];
        //$dbPassword = $dbOpts["pass"];
        //$dbName = ltrim($dbOpts["path"],'/');
        //$dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
        //$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        // Create the actual connection object and assign it to a variable
        
        // $db = new PDO($dsn, $dbUser, $dbPassword, $options);
        // echo "Working"
        // return $db;
    } catch(PDOException $e) {
        echo 'Sorry, the connection failed';
    // header('Location: ./view/500.php');
    // exit;
    }
}
?>