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
    foreach ($events as $event) {
        $eventList .= "<option value='$event[eventId]'>$event[eventName]</option>";
    }
    
    return $eventList;
}

function buildEventScript($events){

    $switchScript = "";
    foreach ($events as $event) {
        $switchScript .= "case $event[eventId]:";
        $switchScript .= "document.getElementById('eventDate').value = $event[eventDate];";
    }

    $eventScript = "document.getElementById('eventId').addEventListerner('change', function() {  });";

    return $eventScript;
}

?>
