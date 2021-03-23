<?php

function checkInt($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_INT);
    if($chkVal){ return $chkVal; } 
    return NULL;
}

function checkBool($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_BOOLEAN);
    if(!is_null($chkVal)){return $chkVal ? 'true' : 'false';}
    return $chkVal;    
}

function checkFloat($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_FLOAT);
    if($chkVal){ return $chkVal; } 
    return NULL;
}

function checkEmail($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_EMAIL);
    if($chkVal){ return $chkVal; } 
    return NULL;
}

function checkMinValue($chkVal, $minValue){
    if($chkVal >= $minValue){ return $chkVal; } 
    return NULL;
}

function checkTel($chkVal) {
    if(is_numeric(str_replace(array('-','(',')', ' ', '+'), '', $chkVal))) { return $chkVal; } 
    return NULL;
}

function checkTelType($chkVal) {
    if($chkVal == "cell" || $chkVal == "home" || $chkVal == "work") { return $chkVal; } 
    return NULL;
}

function checkWard($chkVal) {
    if($chkVal == "cs" || $chkVal == "hh1" || $chkVal == "hh5" || $chkVal == "rh" || $chkVal == "tc" || $chkVal == "wv" || $chkVal == "ws") { return $chkVal; } 
    return NULL;
}

function checkIsDate($chkVal, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $chkVal);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    if($d && $d->format($format) === $chkVal) { return $chkVal; } 
    return NULL;
}

function checkBoolText($chkVal, $chkTxt) {
    if($chkVal == 'y' && strlen(trim($chkTxt)) > 0) { return $chkVal; }
    elseif ($chkVal == 'n') { return $chkVal; }
    return NULL;
}

function checkDepBool($chkVal, $chkAgainst) {
    if($chkAgainst == 'y'){
        if(is_null($chkVal)) {return NULL;}
    }
    return TRUE;
}

function checkSig($chkVal) {
    if(strlen(trim($chkVal)) > 2) { return $chkVal; }
    return NULL;
}

function getAge($participantDOB) {
    $dOB = new DateTime($participantDOB);
    $interval = $dOB->diff(new DateTime);
    
    return $interval->y;
}

function checkAge($chkVal, $age){
    if($age >= 19) { return "N/A - Adult Participant"; }
    return $chkVal;
}

function checkMaxDOB($chkVal) {
    $dateMax = "2007-12-31";
    if ($dateMax >= $chkVal) { return $chkVal; }
    return NULL;
}

function buildEventList($events){
    $eventList = '';
    for ($x = 0; $x <= count($events); $x++) {
        $eventList .= "<option value='{$events[$x]['id']}'>{$events[$x]['name']}</option>";
    }
    return $eventList;
}

function buildEventScript($events){
    
    $switchScript = buildSwitchScript($events);

    $eventScript = "document.getElementById('eventId').addEventListener('change', function() { $switchScript });";
    return $eventScript;
}


function buildSwitchScript($events){
    $switchScript = "let eventID = document.getElementById('eventId').value;";
    //$switchScript .= "console.log('EventID:' + eventID);";
    $switchScript .= "switch(eventID) {";
    for ($x = 0; $x <= count($events); $x++) {
        $switchScript .= "case '{$events[$x]['id']}':";
        $switchScript .= "document.getElementById('eventDate').value = \"{$events[$x]['date_start']}\";";
        $switchScript .= "document.getElementById('eventDesc').value = \"{$events[$x]['desc']}\";";
        $switchScript .= "document.getElementById('eventLeaderName').value = \"{$events[$x]['l_name']}\";";
        $switchScript .= "document.getElementById('eventLeaderPhone').value = \"{$events[$x]['l_phone']}\";";
        $switchScript .= "document.getElementById('eventLeaderEmail').value = \"{$events[$x]['l_email']}\";";
        $switchScript .= "break;";
    }
    $switchScript .= "}";

    return $switchScript;
}

function buildAboutHTML($events) {
    $aboutHTML = "";
    return $aboutHTML;
}

function buildContactsHTML($events) {
    $contactsHTML = "";
    return $contactsHTML;
}

?>
