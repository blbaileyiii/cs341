<?php
/*
 * Main Echoes of Whimsy Model
 */

function login() {
    //echo 'login called...';
    //var_dump($_POST);
    if(isset($_POST['login']['uname'])
    && isset($_POST['login']['password'])){
        $username = htmlspecialchars($_POST['login']['uname']);
        
        try {
            $db = eowConnect();

            $sql = 
            'SELECT userhashpass, userdisabled, usersuspended, useremailverified, userlevel
            FROM users
            WHERE username=:username';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username));
            $accounts = $stmt->fetchAll();

            //echo '<br><br>';
            //var_dump($accounts);

            //There should only be 1 record.
            if(count($accounts) == 1){
                
                //If there is only 1 record 
                $account = $accounts[0];
                //echo '<br>Account retrieved.';
                //echo $account['userfname'];

                //
                //password_verify($input, $hashedpedindb);
                //gethostname();

                //Verify password and check for account "health" and proceed if good. If not address the issue with the "user".
                if( password_verify(htmlspecialchars($_POST['login']['password']), $account['userhashpass'])
                && !$account['userdisabled']
                && !$account['usersuspended']
                && $account['useremailverified']) {
                    //echo '<br>Account is good.';
                    unset($_POST['login']['password']);

                    //create the active user.
                    $sessionHash = password_hash($account['userhashpass'], PASSWORD_DEFAULT);
                    $hostname = gethostname();

                    //echo $hostname;

                    $sql = 
                    'UPDATE users
                    SET sessionhashpass = :sessionhashpass,
                        lastactive = now(),
                        userhost = :userhost
                    WHERE username=:username';

                    $stmt = $db->prepare($sql);
                    $stmt->execute(array(':username' => $username, ':sessionhashpass' => $sessionHash, ':userhost' => $hostname));
                    $accounts = $stmt->fetchAll();
                    
                    //echo 'sql executed...';

                    //Sync session to active user.
                    $_SESSION['eowSession']['username'] = $username;
                    $_SESSION['eowSession']['userhashpass'] = $account['userhashpass'];

                    unset($_POST['login']);

                } else if ($account['userdisabled']) {
                    // [Perm] Account Disabled. Contact support for further information.
                } else if ($account['usersuspended']) {
                    // [Temp] Account Suspended. Check again after Date: XYZ. Contact support for further information.
                } else if (!$account['useremailverified']) {
                    // not verified, warn the user and make them fix it.
                    //echo 'Email Not Verified...';
                } else if (!password_verify(htmlspecialchars($_POST['login']['password']), $account['userhashpass']) ) {
                    // Login Credentials are invalid.
                    //echo 'Login Credentials are invalid.';
                } else {
                    //Unexpected error...
                    //echo 'Unexpected error...';
                }

            } else if(count($accounts) == 0) {
                // Login Credentials are invalid.
                //echo 'Login Credentials are invalid.';
            } else {
                // if it is greater than 1 something really bad happened and we have duplicate accounts...
                //echo 'Something unexpected happened...';
                //var_dump($accounts);
            }

            //CLOSE CONNECTION
            $stmt->closeCursor(); 


            return true;

        } catch(PDOException $ex) {
            echo $sql . "<br>" . $ex->getMessage();
        }
    } else {
        return false;
    }
}

function logout() {
    // NEED TO UPDATE THE DB TOO!!! BUT FOR NOW JUST CLEAR THE SESSION VAR.
    unset($_POST['login']);
    unset($_SESSION['eowSession']);
}

function register() {
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
                $lname = htmlspecialchars($_POST['register']['lname']);

                $hashedpass = password_hash(htmlspecialchars($_POST['register']['password']), PASSWORD_DEFAULT);
                unset($_POST['register']['password']);

                //echo '<br>' . $hashedpass;

                $sql = 
                'INSERT INTO public.users (username, userfname, userlname, useremail, userhashpass)
                VALUES (:username, :userfname, :userlname, :useremail, :userhashpass)';

                $stmt = $db->prepare($sql);
                $stmt->execute(array(':username' => $username, ':userfname' => $fname, ':userlname' => $lname, ':useremail' => $email, ':userhashpass' => $hashedpass ));

                unset($_POST['register']);
                //echo "Account Created";

            } catch(PDOException $ex) {
                echo $sql . "<br>" . $ex->getMessage();
            }

        } else {
            //count is greater than 0 ...username already exists...
            //also need to account for email being unique...
        }       

        $stmt->closeCursor();  
    }  
}

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

function getRaces() {
    try {
        $db = eowConnect();

        $sql = 
        'SELECT txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
        FROM txrace LEFT JOIN txfamily ON txrace.txraceid=txfamily.txraceid
        LEFT JOIN txgenus ON txfamily.txfamilyid=txgenus.txfamilyid
        ORDER BY txrace.txraceid, txfamilyname, txgenusname';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $racesSQL = $stmt->fetchAll();

        // The next line closes the interaction with the database 
        $stmt->closeCursor(); 

        $races = [];

        foreach($racesSQL as $raceSQL){

            $races[$raceSQL['txracename']]['txracedesc'] = $raceSQL['txracedesc'];
            $races[$raceSQL['txracename']]['txfamilynames'][$raceSQL['txfamilyname']]['txfamilydesc'] = $raceSQL['txfamilydesc'];
            $races[$raceSQL['txracename']]['txfamilynames'][$raceSQL['txfamilyname']]['txgenusnames'][$raceSQL['txgenusname']]['txgenusdesc'] = $raceSQL['txgenusdesc'];
            $races[$raceSQL['txracename']]['txfamilynames'][$raceSQL['txfamilyname']]['txgenusnames'][$raceSQL['txgenusname']]['txgenuspron'] = $raceSQL['txgenuspron'];

        }
        //var_dump($races);

        return $races;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }    
}

function getRacesHTML($races) {

    $racesHTML ="";

        foreach ($races as $race => $raceInfo) {
            $racesHTML .= "<div class='race'>\n";
            $racesHTML .= "\t<h2>$race</h2>\n";
            $racesHTML .= "\t<p>$raceInfo[txracedesc]</p>\n";
            foreach ($raceInfo['txfamilynames'] as $family => $familyInfo) {
                if($family !== "") {
                    $racesHTML .= "\t<div class='family'>\n";
                    $racesHTML .= "\t\t<h3 class='family-full-width'>$family</h3>\n";
                    $racesHTML .= "\t\t<p class='family-full-width'>$familyInfo[txfamilydesc]</p>\n";
                }                
                foreach ($familyInfo['txgenusnames'] as $genus => $genusInfo) {
                    if($genus !== "") {
                        $racesHTML .= "\t\t<div class='genus'>\n";
                        $racesHTML .= "\t\t\t<h4>$genus</h4>\n";
                        $racesHTML .= "\t\t\t<p>$genusInfo[txgenuspron]</p>\n";
                        $racesHTML .= "\t\t\t<p>$genusInfo[txgenusdesc]</p>\n";
                        $racesHTML .= "\t\t</div>\n";
                    }
                }
                $racesHTML .= "\t</div>\n";
            }
            $racesHTML .= "</div>\n";
        }

        return $racesHTML;
}

function getUserChars() {
    if(isset($_SESSION['eowSession']['username'])
    && isset($_SESSION['eowSession']['userhashpass'])) {

        $username = $_SESSION['eowSession']['username'];
        //$userhashpass = $_SESSION['eowSession']['userhashpass'];

        //CLEAN THIS UP SO IT DOES A PROPER CHECK LATER...
        try {
            $db = eowConnect();

            $sql = 
            'SELECT username, charname, txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
            FROM users 
            JOIN char ON users.userid=char.userid
            JOIN txgenus ON txgenus.txgenusid=char.txgenusid
            JOIN txfamily ON txfamily.txfamilyid=txgenus.txgenusid
            JOIN txrace ON txrace.txraceid=txfamily.txraceid
            ';

            $stmt = $db->prepare($sql);
            //$stmt->execute(array(':username' => $username));
            $stmt->execute();
            $characters = $stmt->fetchAll();

            var_dump($characters);

            // The next line closes the interaction with the database 
            $stmt->closeCursor(); 

        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

?>

