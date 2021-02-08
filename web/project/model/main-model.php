<?php
/*
 * Main Echoes of Whimsy Model
 */

function getNews() {
        // Create a connection object from the echoes of whimsy connection function
        $db = eowConnect(); 
        // The SQL statement to be used with the database 
        $sql = 
        'SELECT *
        FROM news
        ORDER BY newsposted DESC
        LIMIT 10';
    
        // The next line creates the prepared statement using the echoes of whimsy connection      
        $stmt = $db->prepare($sql);
        // The next line runs the prepared statement 
        $stmt->execute(); 
        // The next line gets the data from the database and 
        // stores it as an array in the $taxonomy variable 
        $news = $stmt->fetchAll();
        // The next line closes the interaction with the database 
        $stmt->closeCursor(); 
        // The next line sends the array of data back to where the function 
        // was called (this should be the controller) 
        return $news;
}

function getNewsHTML($news) {
    //var_dump($news);
    $newsHTML ="";

    foreach ($news as $article) {
        $date=date_create($article['newsposted']);
        $newsHTML .= "<div class='news'>\n";
        $newsHTML .= "\t<h2>$article[newstitle]</h2>\n";        
        $newsHTML .= "\t<p>".date_format($date, 'l, F jS Y h:i A')."</p>\n";
        $newsHTML .= "\t<p>$article[newsbody]</p>\n";
        $newsHTML .= "</div>\n";
    }

    return $newsHTML;
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

?>

