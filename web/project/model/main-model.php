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
    //var_dump($_POST);
    if(isset($_POST['register']['uname'])){
        $username = htmlspecialchars($_POST['register']['uname']);
        
        $db = eowConnect();

        $sql = 
        'SELECT username
        FROM users
        WHERE username=:username';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $accounts = $stmt->fetchAll();
        
        //echo count($accounts);

        if(count($accounts) == 0 
        && isset($_POST['register']['email'])
        && isset($_POST['register']['fname'])
        && isset($_POST['register']['lname'])
        && isset($_POST['register']['password']) ) {

            try {

                $email = htmlspecialchars($_POST['register']['email']);
                $fname = htmlspecialchars($_POST['register']['fname']);
                $lname = htmlspecialchars($_POST['register']['fname']);

                $hashedpass = password_hash(htmlspecialchars($_POST['register']['password']), PASSWORD_DEFAULT);
                unset($_POST['register']['password']);

                //echo '<br>' . $hashedpass;

                $sql = 
                'INSERT INTO public.users (username, userfname, userlname, useremail, userhashpass)
                VALUES (:username, :userfname, :userlname, :useremail, :userhashpass)';

                $stmt = $db->prepare($sql);
                $stmt->execute(array(':username' => $username, ':userfname' => $fname, ':userlname' => $lname, ':useremail' => $email, ':userhashpass' => $hashedpass ));

                unset($_POST['register']);
                echo "Account Created";


            } catch(PDOException $ex) {
                echo $sql . "<br>" . $ex->getMessage();
            }

        } else {
            //count is greater than 0 ...username already exists...
        }       

        $stmt->closeCursor();  
    }  
}

function login() {
    //password_verify($input, $hashedpedindb);
    //gethostname();
}

?>

