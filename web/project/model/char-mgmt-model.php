<?php

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
            $charactersHTML .= "<div class='character' data-character='$character'>";
            $charactersHTML .= "<h3>$character</h3>";
            $charactersHTML .= "<div class='character-profile'>";
            $charactersHTML .= "Race: <i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "<div class='image'>";
            $charactersHTML .= "</div>";
            $charactersHTML .= "</div>";
        }

        $charactersHTML .= "<div class='character' data-character='+new'>";
        $charactersHTML .= "<h3>+ Create a Character</h3>";
        $charactersHTML .= "<div class='image'>";
        $charactersHTML .= "</div>";
        $charactersHTML .= "</div>";

        $charactersHTML .= "</section>";
    }

    return $charactersHTML;
}

function getCharacter($username, $userhashpass, $charname) {
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
            'SELECT username, charname, attribname, attribabbrv, attribdesc, attribtypeof, charattribval
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

                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribabbrv'] = $charattribsSQL['attribabbrv'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribdesc'] = $charattribsSQL['attribdesc'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['attribtypeof'] = $charattribsSQL['attribtypeof'];
                $character[$charattribsSQL['charname']]['attributes'][$charattribsSQL['attribname']]['charattribval'] = $charattribsSQL['charattribval'];
            }

            // SELECT the character inventory from the corresponding characters.
            $sql = 
            'SELECT username, charname, itemname, itemdescshort, itemdesclong, charinvslot, charinvqty
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

                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemname'] = $charinvSQL['itemname'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdescshort'] = $charinvSQL['itemdescshort'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['itemdesclong'] = $charinvSQL['itemdesclong'];
                $character[$charinvSQL['charname']]['inventory'][$charinvSQL['charinvslot']]['charinvqty'] = $charinvSQL['charinvqty'];
            }

            // SELECT the character skills from the corresponding characters.
            $sql = 
            'SELECT username, charname, skillname, skilldescshort, skilldesclong, charskillxp
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
            $characterHTML .= "<h2>$charname</h2>";
            $characterHTML .= "<div class='character-profile'>";
            $characterHTML .= "Race: <i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i>";
            $characterHTML .= "</div>";
            $characterHTML .= "<div class='image'>";
            $characterHTML .= "</div>";
            $characterHTML .= "<section class='character-attributes'>";
            $characterHTML .= "<h3>Attributes</h3>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['attributes'] as $attribute => $attributeInfo){
                $characterHTML .= "<li><span class='info-name'>$attributeInfo[attribabbrv]</span>: $attributeInfo[charattribval]</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-skills'>";
            $characterHTML .= "<h3>Skills</h3>";
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
            $characterHTML .= "<h3>Inventory</h3>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['inventory'] as $slot => $item){
                $characterHTML .= "<li>$item[itemname]: $item[charinvqty]</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<div class='character-management'>";
            $characterHTML .= "<form method='post'>";
            $characterHTML .= "<input type='hidden' name='action' value='char-mgmt'>";
            $characterHTML .= "<button type='submit' name='edit' value='$charname'>Edit</button>";
            $characterHTML .= "<button type='submit' name='delete' value='$charname'>Delete</button>";
            $characterHTML .= "</form>";
            $characterHTML .= "</div>";
            $characterHTML .= "</div>";
        }
        $characterHTML .= "</section>";
    }

    return $characterHTML;
}

function getCharEditHTML($character) {

    $characterHTML = "";

    if(count($character) > 0) {
        $characterHTML .= "<section class='characters'>";
        $characterHTML .= "<h2>Characters</h2>";
        $characterHTML .= "<form>";
        foreach ($character as $charname => $characterInfo) {
            $characterHTML .= "<div>";
            $characterHTML .= "<h3>$charname</h3>";
            $characterHTML .= "<div class='character-profile'>";
            $characterHTML .= "Race: <i>$characterInfo[txfamilyname] " . strtolower($characterInfo['txgenusname']) . "</i>";
            $characterHTML .= "</div>";
            $characterHTML .= "<div class='image'>";
            $characterHTML .= "</div>";
            $characterHTML .= "<section class='character-attributes'>";
            $characterHTML .= "<h4>Attributes</h4>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['attributes'] as $attribute => $attributeInfo){
                $characterHTML .= "<li>";
                $characterHTML .= "<label for=''><span class='info-name'>$attributeInfo[attribabbrv]</span></label>";
                $characterHTML .= "<input type='number' value='$attributeInfo[charattribval]'>";
                $characterHTML .= "</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-skills'>";
            $characterHTML .= "<h4>Skills</h4>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['skills'] as $skill => $skillInfo){
                $characterHTML .= "<li>";
                $characterHTML .= "<label for=''><span class='info-name'>$skill</span></label>";
                $characterHTML .= "<input type='number' value='$skillInfo[charskillxp]'>";
                $characterHTML .= "</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "<section class='character-inventory'>";
            $characterHTML .= "<h4>Inventory</h4>";
            $characterHTML .= "<ul>";
            foreach($characterInfo['inventory'] as $slot => $item){
                $characterHTML .= "<li>";
                $characterHTML .= "<label for=''><span class='info-name'>$item[itemname]</span></label>";
                $characterHTML .= "<input type='number' value='$item[charinvqty]'>";
                $characterHTML .= "</li>";
            }
            $characterHTML .= "</ul>";
            $characterHTML .= "</section>";
            $characterHTML .= "</div>";
        }
        $characterHTML .= "<button type='submit'>Save</button>";
        $characterHTML .= "<button>Cancel</button>";
        $characterHTML .= "</form>";
        $characterHTML .= "</section>";
    }

    return $characterHTML;
}

?>
