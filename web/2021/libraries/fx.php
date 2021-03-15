<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkInt($chkInt){
    $valInt = filter_var($chkInt, FILTER_VALIDATE_INT);
    return $valInt;
}

function checkFloat($chkFloat){
    $valFloat = filter_var($chkFloat, FILTER_VALIDATE_FLOAT);
    return $valFloat;
}

function checkMinValue($chkValue, $minValue){
    if($chkValue >= $minValue){
        return $chkValue;
    } else {
        return FALSE;
    }
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function getNavList($carclassifications){
    $navList = "<nav><ul>";
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";

    foreach ($carclassifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=". urlencode($classification['classificationName']) ."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= "</ul></nav>";

    return $navList;
}

function getClassificationList($carclassifications){
    $classificationList = "";

    foreach ($carclassifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    return $classificationList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 

    foreach ($classifications as $classification) { 
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 

    $classificationList .= '</select>'; 

    return $classificationList; 
}

function buildEventList($events){
    $eventList = '';
    for ($x = 0; $x <= count($events); $x++) {
        $eventList .= "<option value='{$events[$x]['eventId']}'>{$events[$x]['eventName']}</option>";
    }
    
    return $eventList;
}

function buildEventScript($events){
    $switchScript = "let eventID = document.getElementById('eventId').value;";
    $switchScript .= "console.log('EventID:' + eventID);";
    $switchScript .= "switch(eventID) {";
    for ($x = 0; $x <= count($events); $x++) {
        $switchScript .= "case '{$events[$x]['eventId']}':";
        $switchScript .= "document.getElementById('eventDate').value = '{$events[$x]['eventDate']}';";
        $switchScript .= "document.getElementById('eventDesc').value = '{$events[$x]['eventDesc']}';";
        $switchScript .= "document.getElementById('eventLeaderName').value = '{$events[$x]['eventLeaderName']}';";
        $switchScript .= "document.getElementById('eventLeaderPhone').value = '{$events[$x]['eventLeaderPhone']}';";
        $switchScript .= "document.getElementById('eventLeaderEmail').value = '{$events[$x]['eventLeaderEmail']}';";
        $switchScript .= "break;";
    }
    $switchScript .= "}";

    $eventScript = "document.getElementById('eventId').addEventListener('change', function() { $switchScript });";

    return $eventScript;
}

?>
