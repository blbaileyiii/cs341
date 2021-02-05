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

                    //CLOSE CONNECTION
                    $stmt->closeCursor();
                    
                    //echo 'sql executed...';

                    //Sync session to active user.
                    $_SESSION['eowSession']['username'] = $username;
                    $_SESSION['eowSession']['userhashpass'] = $account['userhashpass'];

                    unset($_POST['login']);

                } else if ($account['userdisabled']) {
                    // [Perm] Account Disabled. Contact support for further information.
                    return "Account Disabled. Contact support for further information.";
                } else if ($account['usersuspended']) {
                    // [Temp] Account Suspended. Check again after Date: XYZ. Contact support for further information.
                    return "Account Suspended. Contact support for further information.";
                } else if (!$account['useremailverified']) {
                    // not verified, warn the user and make them fix it.
                    return 'Email Not Verified.';
                } else if (!password_verify(htmlspecialchars($_POST['login']['password']), $account['userhashpass']) ) {
                    // Login Credentials are invalid.
                    return 'Invalid User Name / Password.';
                } else {
                    //Unexpected error...
                    return 'Unexpected error. Contact Support.';
                }

            } else if(count($accounts) == 0) {
                // Login Credentials are invalid.
                return 'Invalid User Name / Password';
            } else {
                // if it is greater than 1 something really bad happened and we have duplicate accounts...
                return 'Something Unexpected Occurred. Contact Support';
                //var_dump($accounts);
            }

            header('Location: /project/index.php?action=account');
            exit;

        } catch(PDOException $ex) {
            return $sql . "<br>" . $ex->getMessage();
            //login err redirect back to login...
        }
    } 
    
    return "Login Failed. Please try again.";
}

function logout() {
    // CLEAR THE SESSION VAR.
    unset($_POST['login']);
    unset($_SESSION['eowSession']);

    //NEED TO UPDATE THE DB TOO!!!

    return "Logout Complete";

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

                $stmt->closeCursor();

                unset($_POST['register']);

                //echo "Account Created: Verify Email Before Logging In";
                header('Location: /project/index.php?action=verify-email');
                exit;

            } catch(PDOException $ex) {
                return $sql . "<br>" . $ex->getMessage();
            }

        } else {
            //count is greater than 0 ...username already exists...
            //also need to account for email being unique...
            return "Username is already in use";
        }

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

function getCharacters($username, $userhashpass) {
    try {
        $characters = [];

        $db = eowConnect();

        // SELECT the character bio/info from the corresponding characters.
        $sql = 
        'SELECT username, charid, charname, txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
        FROM users 
        JOIN char ON users.userid=char.userid
        JOIN txgenus ON txgenus.txgenusid=char.txgenusid
        JOIN txfamily ON txfamily.txfamilyid=txgenus.txfamilyid
        JOIN txrace ON txrace.txraceid=txfamily.txraceid
        WHERE username=:username';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $charactersSQL = $stmt->fetchAll();
        //var_dump($charactersSQL);

        foreach($charactersSQL as $characterSQL){

            $characters[$characterSQL['charname']]['charid'] = $characterSQL['charid'];
            $characters[$characterSQL['charname']]['txracename'] = $characterSQL['txracename'];
            $characters[$characterSQL['charname']]['txracedesc'] = $characterSQL['txracedesc'];
            $characters[$characterSQL['charname']]['txfamilyname'] = $characterSQL['txfamilyname'];
            $characters[$characterSQL['charname']]['txfamilydesc'] = $characterSQL['txfamilydesc'];
            $characters[$characterSQL['charname']]['txgenusname'] = $characterSQL['txgenusname'];
            $characters[$characterSQL['charname']]['txgenuspron'] = $characterSQL['txgenuspron'];
            $characters[$characterSQL['charname']]['txgenusdesc'] = $characterSQL['txgenusdesc'];                
        }

        // SELECT the character attributes from the corresponding characters.
        $sql = 
        'SELECT username, charname, attribname, attribabbrv, attribdesc, attribtypeof, charattribval
        FROM users 
        JOIN char ON users.userid=char.userid
        JOIN charattribs ON char.charid=charattribs.charid
        JOIN attributes ON charattribs.attribid=attributes.attribid
        WHERE username=:username';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $charsattribsSQL = $stmt->fetchAll();
        //var_dump($charattribsSQL);

        foreach($charsattribsSQL as $charattribsSQL){

            $characters[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribabbrv'] = $charattribsSQL['attribabbrv'];
            $characters[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribdesc'] = $charattribsSQL['attribdesc'];
            $characters[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribtypeof'] = $charattribsSQL['attribtypeof'];
            $characters[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['charattribval'] = $charattribsSQL['charattribval'];
        }

        // SELECT the character inventory from the corresponding characters.
        $sql = 
        'SELECT username, charname, itemname, itemdescshort, itemdesclong, charinvslot, charinvqty
        FROM users 
        JOIN char ON users.userid=char.userid
        JOIN charinv ON char.charid=charinv.charid
        JOIN items ON charinv.itemid=items.itemid
        WHERE username=:username';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $charsinvSQL = $stmt->fetchAll();
        //var_dump($charinvSQL);

        foreach($charsinvSQL as $charinvSQL){

            $characters[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemname'] = $charinvSQL['itemname'];
            $characters[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdescshort'] = $charinvSQL['itemdescshort'];
            $characters[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdesclong'] = $charinvSQL['itemdesclong'];
            $characters[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['charinvqty'] = $charinvSQL['charinvqty'];
        }

        // SELECT the character skills from the corresponding characters.
        $sql = 
        'SELECT username, charname, skillname, skilldescshort, skilldesclong, charskillxp
        FROM users 
        JOIN char ON users.userid=char.userid
        JOIN charskills ON char.charid=charskills.charid
        JOIN skills ON charskills.skillid=skills.skillid
        WHERE username=:username';


        $stmt = $db->prepare($sql);
        $stmt->execute(array(':username' => $username));
        $charsskillsSQL = $stmt->fetchAll();
        //var_dump($charskillsSQL);

        foreach($charsskillsSQL as $charskillsSQL){

            $characters[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['skilldescshort'] = $charskillsSQL['skilldescshort'];
            $characters[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['skilldesclong'] = $charskillsSQL['skilldesclong'];
            $characters[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['charskillxp'] = $charskillsSQL['charskillxp'];
        }

        // The next line closes the interaction with the database 
        $stmt->closeCursor();
        
        //var_dump($characters);

        return $characters;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getCharactersHTML($characters) {

    $charactersHTML = "";

    if(count($characters) > 0) {
        $charactersHTML .= "<section class='characters'>";
        $charactersHTML .= "<h2>Characters</h2>";
        foreach ($characters as $character => $characterInfo) {
            $charactersHTML .= "<div>";
            $charactersHTML .= "<h3>$character</h3>";
            $charactersHTML .= "<div class='profile'>";
            $charactersHTML .= "Race: <i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "<div class='image'>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "<section class='attributes'>";
            $charactersHTML .= "<h4>Attributes</h4>";
            $charactersHTML .= "<ul>";
            foreach($characterInfo['attributes'] as $attribute => $attributeInfo){
                $charactersHTML .= "<li><span class='info-name'>$attributeInfo[attribabbrv]</span>: $attributeInfo[charattribval]</li>";
            }
            $charactersHTML .= "</ul>";
            $charactersHTML .= "</section>";
            $charactersHTML .= "<section class='skills'>";
            $charactersHTML .= "<h4>Skills</h4>";
            $charactersHTML .= "<ul>";
            foreach($characterInfo['skills'] as $skill => $skillInfo){
                $charactersHTML .= "<li>";
                $charactersHTML .= "<span class='info-name'>$skill</span>";
                //$charactersHTML .= "<ul>";
                //$charactersHTML .= "<li>Description: $skillInfo[skilldescshort]</li>";
                //$charactersHTML .= "<li>Additional: $skillInfo[skilldesclong]</li>";
                //$charactersHTML .= "<li>Advancement: $skillInfo[charskillxp]</li>";
                //$charactersHTML .= "</ul>";
                $charactersHTML .= "</li>";
            }
            $charactersHTML .= "</ul>";
            $charactersHTML .= "</section>";
            $charactersHTML .= "<section class='inventory'>";
            $charactersHTML .= "<h4>Inventory</h4>";
            $charactersHTML .= "<ul>";
            foreach($characterInfo['inventory'] as $slot => $item){
                $charactersHTML .= "<li>$item[itemname]: $item[charinvqty]</li>";
            }
            $charactersHTML .= "</ul>";
            $charactersHTML .= "</section>";
            $charactersHTML .= "<div>";
            $charactersHTML .= "<form method='post'>";
            $charactersHTML .= "<input type='hidden' name='character' value='$characterInfo[charid]'>";
            $charactersHTML .= "<button type='submit' name='edit' value='edit'>Edit</button>";
            $charactersHTML .= "<button type='submit' name='delete' value='delete'>Delete</button>";
            $charactersHTML .= "</form>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "</div>";
        }
        $charactersHTML .= "</section>";
    }

    return $charactersHTML;
}

?>

