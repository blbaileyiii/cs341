<?php

function checkInt($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_INT);
    if($chkVal){ return $chkVal; } 
    return NULL;
}

function checkBool($chkVal){
    $chkVal = filter_var($chkVal, FILTER_VALIDATE_BOOLEAN);
    if(!is_null($chkVal)){return $chkVal ? 'yes' : 'no';}
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
    if($chkVal == 'yes' && strlen(trim($chkTxt)) > 0) { return $chkVal; }
    elseif ($chkVal == 'no') { return $chkVal; }
    return NULL;
}

function checkDepBool($chkVal, $chkAgainst) {
    if($chkAgainst == 'yes'){
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

function checkMaxDOB($chkVal, $dateMax) {
    if ($dateMax >= $chkVal) { return $chkVal; }
    return NULL;
}

function buildEventList($events){
    $eventList = '';
    for ($x = 0; $x < count($events); $x++) {
        $eventList .= "<option value='{$events[$x]['id']}'>{$events[$x]['name']}</option>";
    }
    return $eventList;
}

function buildAboutHTML($events) {
    $aboutHTML = "";
    return $aboutHTML;
}

function buildContactsHTML($events) {
    $contactsHTML = "";
    return $contactsHTML;
}

function buildRegistrantsHTML($registrants) {

    
    $registrantsHTML = "";
    $event = "";

    for ($x = 0; $x < count($registrants); $x++) {
        if ($registrants[$x]['name'] != $event){

            if ($event != ""){
                $registrantsHTML .= "</table>";
            }

            $event = $registrants[$x]['name'];
            
            $registrantsHTML .= "<h2>{$registrants[$x]['name']}</h2>";
            $registrantsHTML .= "<table>";
            $registrantsHTML .= eventRegistrantsCount($registrants, $event);
            $registrantsHTML .= "<tr>";
            $registrantsHTML .= "<th>Event</th>";
            $registrantsHTML .= "<th>Ward</th>";
            $registrantsHTML .= "<th>Name</th>";
            $registrantsHTML .= "<th>Age</th>";
            $registrantsHTML .= "<th>Email</th>";
            $registrantsHTML .= "<th>Phone</th>";
            $registrantsHTML .= "<th></th>";
            $registrantsHTML .= "<th>Emergency Contact</th>";
            $registrantsHTML .= "<th>Phone</th>";
            $registrantsHTML .= "<th></th>";
            $registrantsHTML .= "</tr>";
        }

        if ($registrants[$x]['p_age'] >= 19){
            $registrantsHTML .= "<tr class='adult-registrant'>";
        } else {
            $registrantsHTML .= "<tr>";
        }

        $registrantsHTML .= "<td>{$registrants[$x]['name']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['p_ward']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['p_name']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['p_age']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['email']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['tele_one']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['tele_one_type']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['emer_name']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['emer_tele_one']}</td>";
        $registrantsHTML .= "<td>{$registrants[$x]['emer_tele_one_type']}</td>";
        $registrantsHTML .= "</tr>";
    }

    if ($registrantsHTML != ""){
        $registrantsHTML .= "</table>";
    }

    return $registrantsHTML;
}

function eventRegistrantsCount($registrants, $event){
    $countHTML = "";

    $totalRegistrantCount = 0;
    $youthRegistrantCount = 0;
    $adultRegistrantCount = 0;

    for ($x = 0; $x < count($registrants); $x++) {
        if($registrants[$x]['name'] == $event){
            $totalRegistrantCount++;
            if ($registrants[$x]['p_age'] >= 19){
                $adultRegistrantCount++;
            } else {
                $youthRegistrantCount++;
            }
        }
    }

    $countHTML .= "<p>Total Youth Registered: $youthRegistrantCount</p>";
    $countHTML .= "<p>Total Adults Registered: $adultRegistrantCount</p>";
    $countHTML .= "<p>Total Participants Registered: $totalRegistrantCount</p>";
    return $countHTML;
}

?>
