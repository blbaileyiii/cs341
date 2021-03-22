<?php

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

function getAge($participantDOB) {
    $dOB = new DateTime($participantDOB);
    $interval = $dOB->diff(new DateTime);
    
    return $interval->y;
}

function buildEventList($events){
    $eventList = '';
    for ($x = 0; $x <= count($events); $x++) {
        $eventList .= "<option value='{$events[$x]['eventId']}'>{$events[$x]['eventName']}</option>";
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
        $switchScript .= "case '{$events[$x]['eventId']}':";
        $switchScript .= "document.getElementById('eventDate').value = \"{$events[$x]['eventDate']}\";";
        $switchScript .= "document.getElementById('eventDesc').value = \"{$events[$x]['eventDesc']}\";";
        $switchScript .= "document.getElementById('eventLeaderName').value = \"{$events[$x]['eventLeaderName']}\";";
        $switchScript .= "document.getElementById('eventLeaderPhone').value = \"{$events[$x]['eventLeaderPhone']}\";";
        $switchScript .= "document.getElementById('eventLeaderEmail').value = \"{$events[$x]['eventLeaderEmail']}\";";
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
