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
        $permissionSlipsHTML .= "<img class='responsive' src='/2021/images/permissionslipheader.png' alt='Permission Slip Header'>";
        $permissionSlipsHTML .= "<p>Complete this form separately for each event or activity involving special considerations (see <span class='italics'>Handbook 2: Administering the Church</span>, 13.6.20, ChurchofJesusChrist.org), an overnight stay, travel outside the local area, or an activity with higher than ordinary risks.</p>";
        
        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Event Details (to be filled out by event planner)</h2>";

        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 4;'>";
        $permissionSlipsHTML .= "<span>Event</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['event_name']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Date(s) of event</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['date_start']} - {$registrants[$x]['date_end']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<span>Describe event and activities (please be specific)</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['event_desc']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Ward</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_ward']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Stake</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['stake']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Event or activity leader</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['l_name']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Event or activity leader's phone number</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['l_phone']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Event or activity leader's email</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['l_email']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";

        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Participant Information</h2>";

        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Participant</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_name']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Date of birth</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_dob']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right'>";
        $permissionSlipsHTML .= "<span>Age</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_age']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Primary telephone number</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['tele_one']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field'>";
        // TODO tele_one_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "Secondary telephone number";
        $permissionSlipsHTML .= "{$registrants[$x]['tele_two']}";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right';'>";
        // TODO tele_two_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Address</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_address']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>City</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_city']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right'>";
        $permissionSlipsHTML .= "<span>State or province</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_state']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Emergency contact (parent or guardian)</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['emer_name']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field'>";
        $permissionSlipsHTML .= "<span>Primary telephone number</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['emer_tele_one']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field'>";
        // TODO emer_tele_one_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field'>";
        $permissionSlipsHTML .= "<span>Secondary telephone number</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['emer_tele_two']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right'>";
        // TODO emer_tele_two_type
        $permissionSlipsHTML .= "Home";
        $permissionSlipsHTML .= "Cell";
        $permissionSlipsHTML .= "Work";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";

        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Medical Information</h2>";

        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Does the participant require a special diet?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 4;'>";
        $permissionSlipsHTML .= "<span>If yes, please explain the dietary restrictions</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['diet_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 2;'>";
        $permissionSlipsHTML .= "<span>Does the participant have any allergies?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 4;'>";
        $permissionSlipsHTML .= "<span>If yes, please list the allergies</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['allergies_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Is the participant taking any medication or over-the-counter (OTC) drugs?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>If yes, can the participant self-administer his or her medication?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No ";
        $permissionSlipsHTML .= "If no, please contact the event or activity leader directly.";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<span>List all prescription or over-the-counter (OTC) medications the participant is taking</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['medication_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";

        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Physical Conditions That Limit Activity</h2>";

        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Does the participant have a chronic or recurring illness?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>If yes, please explain</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['chronic_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>Has the participant had surgery or a serious illness in the past year?</span>";
        // TODO
        $permissionSlipsHTML .= "Yes ";
        $permissionSlipsHTML .= "No";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right' style='grid-column:span 3;'>";
        $permissionSlipsHTML .= "<span>If yes, please explain</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['serious_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<span>Identify any other limits, restrictions, or disabilities that could prevent the participant from fully participating in the event or activity (attach additional pages if needed)</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['limitations_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";

        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Other Accommodations or Special Needs</h2>";

        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<span>Identify any other needs or considerations the participant has that the event or activity planner should be aware of (attach additional pages if needed)</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['considerations_txt']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";
        
        $permissionSlipsHTML .= "<h2 style='grid-column:span 6;'>Permission</h2>";
        
        $permissionSlipsHTML .= "<div class='print-grid'>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<p>I give permission for my child or youth to participate in the event and activities listed above (unless noted) and authorize the adult leaders supervising this event to administer emergency treatment to the abovenamed participant for any accident or illness and to act in my stead in approving necessary medical care. This authorization shall cover this event and travel to and from this event.</p>";
        $permissionSlipsHTML .= "<div>";
        $permissionSlipsHTML .= "<p>The participant is responsible for his or her own conduct and is aware of and agrees to abide by Church standards, camp or event safety rules, and other pertinent instructions. Participants’ conduct and interactions should abide by Church standards and exemplify Christlike behavior.</p>";
        $permissionSlipsHTML .= "<p>Parents and participants should understand that participation in an activity is not a right but a privilege that can be revoked if they behave inappropriately or if they pose a risk to themselves or others.</p>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 5;'>";
        $permissionSlipsHTML .= "<span>Participant’s signature</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_sig']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right'>";
        $permissionSlipsHTML .= "<span>Date</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['p_sig_date']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field left' style='grid-column:span 5;'>";
        $permissionSlipsHTML .= "<span>Parent or guardian’s signature (if necessary)</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['g_sig']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field right'>";
        $permissionSlipsHTML .= "<span>Date</span>";
        $permissionSlipsHTML .= "<span>{$registrants[$x]['g_sig_date']}</span>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='print-field full' style='grid-column:span 6;'>";
        $permissionSlipsHTML .= "<p class='legal-sm' style='grid-column:span 6;'>© 2017, 2019 by Intellectual Reserve, Inc. All rights reserved. 5/19. PD60004035 000</p>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "</div>";
        $permissionSlipsHTML .= "<div class='page-break'>";
        $permissionSlipsHTML .= "</div>";
    }
    return $permissionSlipsHTML;
}

?>
