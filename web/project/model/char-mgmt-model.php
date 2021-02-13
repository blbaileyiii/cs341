<?php

function getCharacters($username) {
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
        $charactersHTML .= "<section class='characters grid-tiles'>";
        foreach ($characters as $character => $characterInfo) {
            $charactersHTML .= "<div class='character' data-character='$character'>";
            $charactersHTML .= "<h2>$character</h2>";
            $charactersHTML .= "<div class='character-profile'>";
            $charactersHTML .= "Race: <i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "<div class='image'>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "</div>";
        }

        $charactersHTML .= "<div class='character' data-character='+new'>";
        $charactersHTML .= "<h2>+ Create a Character</h2>";
        $charactersHTML .= "<div class='image'>";
        $charactersHTML .= "</div>";
        $charactersHTML .= "</div>";

        $charactersHTML .= "</section>";
    }

    return $charactersHTML;
}

function getCharacter($username, $charname) {
    if($charname == "+new"){
        $character = [];
        $character['New Character'];
    } else {
        try {
            $character = [];

            $db = eowConnect();

            // SELECT the character bio/info from the corresponding characters.
            $sql = 
            'SELECT username, charid, charname, txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
            FROM users 
            JOIN char ON users.userid=char.userid
            JOIN txgenus ON txgenus.txgenusid=char.txgenusid
            JOIN txfamily ON txfamily.txfamilyid=txgenus.txfamilyid
            JOIN txrace ON txrace.txraceid=txfamily.txraceid
            WHERE username=:username AND charname=:charname';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username, ':charname' => $charname));
            $characterSQL = $stmt->fetchAll();
            //var_dump($charactersSQL);

            foreach($characterSQL as $charSQL){

                $character[$charSQL['charname']]['charid'] = $charSQL['charid'];
                $character[$charSQL['charname']]['txracename'] = $charSQL['txracename'];
                $character[$charSQL['charname']]['txracedesc'] = $charSQL['txracedesc'];
                $character[$charSQL['charname']]['txfamilyname'] = $charSQL['txfamilyname'];
                $character[$charSQL['charname']]['txfamilydesc'] = $charSQL['txfamilydesc'];
                $character[$charSQL['charname']]['txgenusname'] = $charSQL['txgenusname'];
                $character[$charSQL['charname']]['txgenuspron'] = $charSQL['txgenuspron'];
                $character[$charSQL['charname']]['txgenusdesc'] = $charSQL['txgenusdesc'];                
            }

            // SELECT the character attributes from the corresponding characters.
            $sql = 
            'SELECT username, charname, charattribid, attribname, attribabbrv, attribdesc, attribtypeof, charattribval
            FROM users 
            JOIN char ON users.userid=char.userid
            JOIN charattribs ON char.charid=charattribs.charid
            JOIN attributes ON charattribs.attribid=attributes.attribid
            WHERE username=:username AND charname=:charname';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username, ':charname' => $charname));
            $characterattribsSQL = $stmt->fetchAll();
            //var_dump($charattribsSQL);

            foreach($characterattribsSQL as $charattribsSQL){

                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['charattribid'] = $charattribsSQL['charattribid'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribabbrv'] = $charattribsSQL['attribabbrv'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribdesc'] = $charattribsSQL['attribdesc'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribtypeof'] = $charattribsSQL['attribtypeof'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['charattribval'] = $charattribsSQL['charattribval'];
            }

            // SELECT the character inventory from the corresponding characters.
            $sql = 
            'SELECT username, charname, charinvid, itemname, itemdescshort, itemdesclong, charinvslot, charinvqty
            FROM users 
            JOIN char ON users.userid=char.userid
            JOIN charinv ON char.charid=charinv.charid
            JOIN items ON charinv.itemid=items.itemid
            WHERE username=:username AND charname=:charname';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username, ':charname' => $charname));
            $characterinvSQL = $stmt->fetchAll();
            //var_dump($charinvSQL);

            foreach($characterinvSQL as $charinvSQL){

                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['charinvid'] = $charinvSQL['charinvid'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemname'] = $charinvSQL['itemname'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdescshort'] = $charinvSQL['itemdescshort'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdesclong'] = $charinvSQL['itemdesclong'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['charinvqty'] = $charinvSQL['charinvqty'];
            }

            // SELECT the character skills from the corresponding characters.
            $sql = 
            'SELECT username, charname, charskillid, skillname, skilldescshort, skilldesclong, charskillxp
            FROM users 
            JOIN char ON users.userid=char.userid
            JOIN charskills ON char.charid=charskills.charid
            JOIN skills ON charskills.skillid=skills.skillid
            WHERE username=:username AND charname=:charname';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $username, ':charname' => $charname));
            $characterskillsSQL = $stmt->fetchAll();
            //var_dump($charskillsSQL);

            foreach($characterskillsSQL as $charskillsSQL){

                $character[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['charskillid'] = $charskillsSQL['charskillid'];
                $character[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['skilldescshort'] = $charskillsSQL['skilldescshort'];
                $character[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['skilldesclong'] = $charskillsSQL['skilldesclong'];
                $character[$charskillsSQL['charname']]['skills'][$charskillsSQL['skillname']]['charskillxp'] = $charskillsSQL['charskillxp'];
            }

            // The next line closes the interaction with the database 
            $stmt->closeCursor();
            
            //var_dump($characters);

            return $character;

        } catch(PDOException $ex) {
            echo $sql . "<br>" . $ex->getMessage();
        }
    }
}

function getCharacterHTML($character) {

    $characterHTML = "";

    if(count($character) > 0) {
        $characterHTML .= "<section class='characters'>";        
        foreach ($character as $charname => $characterInfo) {
            $characterHTML .= "<div>";
            $characterHTML .= "<h1>$charname</h1>";
            $characterHTML .= "<div class='character-profile'>";
            $characterHTML .= "<h2><i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i></h2>";
            $characterHTML .= "</div>";
            $characterHTML .= "<div class='image'>";
            $characterHTML .= "</div>";
            $characterHTML .= "<section class='character-attributes'>";
            $characterHTML .= "<h2>Attributes</h2>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['attributes'] as $attribute => $attributeInfo){
                $characterHTML .= "<li><span class='info-name'>$attributeInfo[attribabbrv]</span>: $attributeInfo[charattribval]</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-skills'>";
            $characterHTML .= "<h2>Skills</h2>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['skills'] as $skill => $skillInfo){
                $characterHTML .= "<li>";
                $characterHTML .= "<span class='info-name'>$skill</span>";
                //$charactersHTML .= "<ul>";
                //$charactersHTML .= "<li>Description: $skillInfo[skilldescshort]</li>";
                //$charactersHTML .= "<li>Additional: $skillInfo[skilldesclong]</li>";
                //$charactersHTML .= "<li>Advancement: $skillInfo[charskillxp]</li>";
                //$charactersHTML .= "</ul>";
                $characterHTML .= "</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-inventory'>";
            $characterHTML .= "<h2>Inventory</h2>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['inventory'] as $slot => $item){
                $characterHTML .= "<li>$item[itemname]: $item[charinvqty]</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<div class='character-management'>";
            $characterHTML .= "<form class='form' method='post'>";
            $characterHTML .= "<input type='hidden' name='character' value='$charname'>";
            $characterHTML .= "<div class='non-fields'>";
            $characterHTML .= "<button type='submit' name='action' value='char-edit'>Edit</button>";
            $characterHTML .= "</div>";
            $characterHTML .= "<div class='non-fields'>";
            $characterHTML .= "<button type='submit' name='action' value='char-delete-verify'>Delete</button>";
            $characterHTML .= "</div>";
            $characterHTML .= "</form>";
            $characterHTML .= "</div>";
            $characterHTML .= "</div>";
        }
        $characterHTML .= "</section>";
    }

    return $characterHTML;
}

function getCharEditHTML($character, $playableOptions) {

    $characterHTML = "";

    if(count($character) > 0) {
        $characterHTML .= "<section class='characters'>";
        $characterHTML .= "<form class='form' method='post'>";
        foreach ($character as $charname => $characterInfo) {
            $characterHTML .= "<div>";
            $characterHTML .= "<h1>$charname</h1>";
            $characterHTML .= "<div class='character-profile'>";
            $characterHTML .= "<input id='charid' name='charid' value='$characterInfo[charid]' type='hidden'>";
            $characterHTML .= "<div class='fields'>";
            $characterHTML .= "<label for='race'><span class='info-name'>Character Race</span><span class='field-tip'>Required</span></label>";
            $characterHTML .= "<select id='race' name='race' value ='' required>";
            $characterHTML .= $playableOptions;
            $characterHTML .= "</select>";
            $characterHTML .= "</div>";
            $characterHTML .= "</div>";
            $characterHTML .= "<div class='image'>";
            $characterHTML .= "</div>";
            $characterHTML .= "<section class='character-attributes'>";
            $characterHTML .= "<h2>Attributes</h2>";
            foreach($characterInfo['attributes'] as $attribute => $attributeInfo){
                $characterHTML .= "<div class='fields'>";
                $characterHTML .= "<label for='attribid-$attributeInfo[charattribid]'><span class='info-name'>$attribute</span><span class='field-tip'>Required</span></label>";
                $characterHTML .= "<input id='attribid-$attributeInfo[charattribid]' name='attribid-$attributeInfo[charattribid]' type='number' value='$attributeInfo[charattribval]' placeholder='$attributeInfo[charattribval]' min='$attributeInfo[charattribval]' step='1'>";
                $characterHTML .= "</div>";
            }
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-skills'>";
            $characterHTML .= "<h2>Skills</h2>";
            foreach($characterInfo['skills'] as $skill => $skillInfo){
                $characterHTML .= "<div class='fields'>";
                $characterHTML .= "<label for='skillid-$skillInfo[charskillid]'><span class='info-name'>$skill</span><span class='field-tip'>Required</span></label>";
                $characterHTML .= "<input id='skillid-$skillInfo[charskillid]' name='skillid-$skillInfo[charskillid]' type='number' value='$skillInfo[charskillxp]' placeholdermin='$skillInfo[charskillxp]' min='$skillInfo[charskillxp]' step='1'>";
                $characterHTML .= "</div>";
            }
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-inventory'>";
            $characterHTML .= "<h2>Inventory</h2>";
            foreach($characterInfo['inventory'] as $slot => $item){
                $characterHTML .= "<div class='fields'>";
                $characterHTML .= "<label for='itemid-$item[charinvid]'><span class='info-name'>$item[itemname]</span><span class='field-tip'>Required</span></label>";
                $characterHTML .= "<input id='itemid-$item[charinvid]' name='itemid-$item[charinvid]' type='number' value='$item[charinvqty]' placeholder='$item[charinvqty]' min='$item[charinvqty]' step='1'>";
                $characterHTML .= "</div>";
            }
            $characterHTML .= "</section>";
            $characterHTML .= "</div>";
        }
        $characterHTML .= "<div class='non-fields'>";
        $characterHTML .= "<button type='submit' name='action' value='save-edit'>Save</button>";
        $characterHTML .= "</div>";
        $characterHTML .= "<div class='non-fields'>";
        $characterHTML .= "<button name='action' value='cancel'>Cancel</button>";
        $characterHTML .= "</div>";
        $characterHTML .= "</form>";
        $characterHTML .= "</section>";
    }

    return $characterHTML;
}



function getPlayableRaces(){
    // Create a connection object from the echoes of whimsy connection function
    $db = eowConnect(); 
    // The SQL statement to be used with the database 
    $sql = 
    'SELECT txfamilyname, txfamilydesc, txgenusid, txgenusname, txgenuspron, txgenusdesc
    FROM txrace LEFT JOIN txfamily on txrace.txraceid=txfamily.txraceid
    LEFT JOIN txgenus ON txfamily.txfamilyid=txgenus.txfamilyid
    WHERE txrace.txraceid=1
    ORDER BY txracename, txfamilyname, txgenusname';

    // The next line creates the prepared statement using the echoes of whimsy connection      
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement 
    $stmt->execute(); 
    // The next line gets the data from the database and 
    // stores it as an array in the $taxonomy variable 
    $playableRaces = $stmt->fetchAll(); 
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // The next line sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $playableRaces;
}

function getPlayableOptions($playableRaces, $character){
    $playableOptions = "";
    $selected = "";

    if(count($character) > 0) {
        foreach ($character as $charname => $characterInfo) {
            $selected = "$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']);
        }
    }

    foreach ($playableRaces as $playableRace) {
        if($selected == "$playableRace[txfamilyname] " . strtolower($playableRace['txgenusname'])) {
            $playableOptions .= "<option value='$playableRace[txgenusid]' selected>$playableRace[txfamilyname] " . strtolower($playableRace['txgenusname']) . "</option>";
        } else {
            $playableOptions .= "<option value='$playableRace[txgenusid]'>$playableRace[txfamilyname] " . strtolower($playableRace['txgenusname']) . "</option>";
        }
    }

    return $playableOptions;
}

function saveEdits($username, $character){
    if(!empty($character)){
        
        try {
            //$db = eowConnect();

            // Run the Character update here.

            // Run the Attribute, Skill, and Item updates.
            foreach($character as $charInfo => $val){

                $charInfoTEMP = explode("-", $charInfo, 2);
                $charInfoKey = $charInfoTEMP[0];
                $charInfoId = $charInfoTEMP[1];

                echo "$charInfoKey<br>$charInfoId<br>";
                
                switch ($charInfoKey) {
                    case 'attribid':
                        $sql = 
                        'UPDATE charattribs
                        SET charattribval = :charattribval
                        WHERE charattribid = :charattribid';
                        $tokens = array(':charattribval' => $val, ':charattribid:' => $charInfoId);
                        break;
                    case 'skillid':
                        $sql=
                        'UPDATE charskills
                        SET charskillxp = :charskillxp
                        WHERE charskillid = :charskillid';
                        $tokens = array(':charskillxp' => $val, ':charskillid' => $charInfoId);
                        break;
                    case 'itemid':
                        $sql=
                        'UPDATE charinv
                        SET charinvqty = :charinvqty
                        WHERE charinvid = :charinvid';
                        $tokens = array(':charinvqty' => $val, ':charinvid' => $charInfoId);
                        break;
                    default:
                        break;
                }
                
                echo $sql;
                echo "<br>";
                var_dump($tokens);

                // UPDATE the character bio/info from the form data.
                //$sql = 
                '';
                /*
                'UPDATE users
                SET sessionhashpass = :sessionhashpass,
                    lastactive = now(),
                    userhost = :userhost
                WHERE username=:username';
                */

                // if(!empty($sql)){
                    //$stmt = $db->prepare($sql);
                    //$stmt->execute(array(':username' => $username));
                    //$characterSQL = $stmt->fetchAll();
                    //var_dump($charactersSQL);

                    // The next line closes the interaction with the database
                    //$stmt->closeCursor();
                //}

                
            }
            
        } catch(PDOException $ex) {
            //echo $sql . "<br>" . $ex->getMessage();
        }

    }
}

?>
