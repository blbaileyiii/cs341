<?php
/*
 * Main Echoes of Whimsy Model
 */

function getTaxonomy(){
    // Create a connection object from the echoes of whimsy connection function
    $db = eowConnect(); 
    // The SQL statement to be used with the database 
    $sql = 
    'SELECT txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
    FROM txrace LEFT JOIN txfamily on txrace.txraceid=txfamily.txraceid
    LEFT JOIN txgenus ON txfamily.txfamilyid=txgenus.txfamilyid
    ORDER BY txracename, txfamilyname, txgenusname';

    // The next line creates the prepared statement using the echoes of whimsy connection      
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement 
    $stmt->execute(); 
    // The next line gets the data from the database and 
    // stores it as an array in the $taxonomy variable 
    $taxonomy = $stmt->fetchAll(); 
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // The next line sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $taxonomy;
   }

function register(){
    var_dump($_POST);
    if(isset($_POST['register']['email'])){
        echo "email is set...";
        $useremail = $_POST['register.email'];
        
        $db = eowConnect();

        $sql = 
        'SELECT useremail
        FROM users
        WHERE useremail=:useremail';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':useremail' => $useremail));
        $accounts = $stmt->fetchAll();
        $stmt->closeCursor(); 
        var_dump($accounts);
        echo count($accounts);
    }
    
}

?>

