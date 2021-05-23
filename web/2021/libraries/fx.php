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

function buildEventsHTML($events, $year) {
    $eventsHTML = "";

    for ($x = 0; $x < count($events); $x++) {
        $eventsHTML .= "<p>";
        $eventsHTML .= "<a href='/$year/registrants/?action=print&event={$events[$x]['key']}' title='Print permission slips for {$events[$x]['name']}'  target='_blank' rel='noreferrer'>";
        $eventsHTML .= "Print permission slips for {$events[$x]['name']}";
        $eventsHTML .= "</a>";
        $eventsHTML .= "</p>";
    }

    return $eventsHTML;
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
            $registrantsHTML .= buildEventRegistrantsCount($registrants, $event);
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

function buildEventRegistrantsCount($registrants, $event){
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

function buildPermissionSlipsHTML($registrants) {
    $permissionSlipsHTML = "";
    for ($x = 0; $x < count($registrants); $x++) {
        $permissionSlipsHTML .= "<div>";
        $permissionSlipsHTML .= "<img class='responsive' src='/2021/images/permissionslipheader.png' alt='Permission Slip Header'>";
        $permissionSlipsHTML .= "Complete this form separately for each event or activity involving special considerations (see <span class='italics'>Handbook 2: Administering the Church</span>, 13.6.20, ChurchofJesusChrist.org), an overnight stay, travel outside the local area, or an activity with higher than ordinary risks.";
        $permissionSlipsHTML .= "Event Details (to be filled out by event planner)";
        $permissionSlipsHTML .= "Event";
        $permissionSlipsHTML .= "{$registrants[$x]['event_name']}";
        $permissionSlipsHTML .= "Date(s) of event";
        $permissionSlipsHTML .= "{$registrants[$x]['date_start']} - {$registrants[$x]['date_end']}";
        $permissionSlipsHTML .= "Describe event and activities (please be specific)";
        $permissionSlipsHTML .= "{$registrants[$x]['event_desc']}";
        $permissionSlipsHTML .= "Ward";
        $permissionSlipsHTML .= "{$registrants[$x]['p_ward']}";
        $permissionSlipsHTML .= "Stake";
        $permissionSlipsHTML .= "{$registrants[$x]['stake']}";
        $permissionSlipsHTML .= "Event or activity leader";
        $permissionSlipsHTML .= "{$registrants[$x]['l_name']}";
        $permissionSlipsHTML .= "Event or activity leader's phone number";
        $permissionSlipsHTML .= "{$registrants[$x]['l_phone']}";
        $permissionSlipsHTML .= "Event or activity leader's email";
        $permissionSlipsHTML .= "{$registrants[$x]['l_email']}";
        $permissionSlipsHTML .= "Participant Information";
        $permissionSlipsHTML .= "Participant";
        $permissionSlipsHTML .= "{$registrants[$x]['p_name']}";
        $permissionSlipsHTML .= "Date of birth";
        $permissionSlipsHTML .= "{$registrants[$x]['p_dob']}";
        $permissionSlipsHTML .= "Age";
        $permissionSlipsHTML .= "{$registrants[$x]['p_age']}";
        $permissionSlipsHTML .= "Primary telephone number";
        $permissionSlipsHTML .= "{$registrants[$x]['tele_one']}";
        // TODO tele_one_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "Secondary telephone number";
        $permissionSlipsHTML .= "{$registrants[$x]['tele_two']}";
        // TODO tele_two_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "Medical Information";
        $permissionSlipsHTML .= "Does the participant require a special diet?";
        // TODO
        $permissionSlipsHTML .= "Yes";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If yes, please explain the dietary restrictions";
        $permissionSlipsHTML .= "{$registrants[$x]['diet_txt']}";
        $permissionSlipsHTML .= "Does the participant have any allergies?";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If yes, please list the allergies";
        $permissionSlipsHTML .= "{$registrants[$x]['allergies_txt']}";
        $permissionSlipsHTML .= "Is the participant taking any medication or over-the-counter (OTC) drugs?";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If yes, can the participant self-administer his or her medication?";
        // TODO
        $permissionSlipsHTML .= "Yes";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If no, please contact the event or activity leader directly.";
        $permissionSlipsHTML .= "List all prescription or over-the-counter (OTC) medications the participant is taking";
        $permissionSlipsHTML .= "{$registrants[$x]['medication_txt']}";
        $permissionSlipsHTML .= "Physical Conditions That Limit Activity";
        $permissionSlipsHTML .= "Does the participant have a chronic or recurring illness?";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If yes, please explain";
        $permissionSlipsHTML .= "{$registrants[$x]['chronic_txt']}";
        $permissionSlipsHTML .= "Has the participant had surgery or a serious illness in the past year?";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "If yes, please explain";
        $permissionSlipsHTML .= "{$registrants[$x]['serious_txt']}";
        $permissionSlipsHTML .= "Identify any other limits, restrictions, or disabilities that could prevent the participant from fully participating in the event or activity (attach additional pages if needed)";
        $permissionSlipsHTML .= "{$registrants[$x]['limitations_txt']}";
        $permissionSlipsHTML .= "Other Accommodations or Special Needs";
        $permissionSlipsHTML .= "Identify any other needs or considerations the participant has that the event or activity planner should be aware of (attach additional pages if needed)";
        $permissionSlipsHTML .= "Permission";
        $permissionSlipsHTML .= "{$registrants[$x]['considerations_txt']}";
        $permissionSlipsHTML .= "I give permission for my child or youth to participate in the event and activities listed above (unless noted) and authorize the adult leaders supervising this event to administer emergency treatment to the abovenamed participant for any accident or illness and to act in my stead in approving necessary medical care. This authorization shall cover this event and travel to and from this event.";
        $permissionSlipsHTML .= "The participant is responsible for his or her own conduct and is aware of and agrees to abide by Church standards, camp or event safety rules, and other pertinent instructions. Participants’ conduct and interactions should abide by Church standards and exemplify Christlike behavior.";
        $permissionSlipsHTML .= "Parents and participants should understand that participation in an activity is not a right but a privilege that can be revoked if they behave inappropriately or if they pose a risk to themselves or others.";
        $permissionSlipsHTML .= "Participant’s signature";
        $permissionSlipsHTML .= "{$registrants[$x]['p_sig']}";
        $permissionSlipsHTML .= "Date";
        $permissionSlipsHTML .= "{$registrants[$x]['p_sig_date']}";
        $permissionSlipsHTML .= "Parent or guardian’s signature (if necessary)";
        $permissionSlipsHTML .= "{$registrants[$x]['g_sig']}";
        $permissionSlipsHTML .= "Date";
        $permissionSlipsHTML .= "{$registrants[$x]['g_sig_date']}";
        $permissionSlipsHTML .= "© 2017, 2019 by Intellectual Reserve, Inc. All rights reserved. 5/19. PD60004035 000";
        $permissionSlipsHTML .= "</div>";
    }
    return $permissionSlipsHTML;
}

?>
