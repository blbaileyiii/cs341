<?php
/*
 * Main Week 05 Team Activity Model
 */

function getSomething() {
    try {
        $db = dbConnect();

        $sql = 
        'SELECT something
        FROM somewhere';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $sqlResults = $stmt->fetchAll();




        // The next line closes the interaction with the database 
        $stmt->closeCursor();
        //var_dump($sqlResults);

        return $sqlResults;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }    
}
?>

