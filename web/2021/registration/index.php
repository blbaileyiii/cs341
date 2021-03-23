<?php

/*
 * Registration Controller
 */

session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the account model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/reg-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/json-model.php';
// Get the account validation fxs for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'confirm':
        // Sanitize form data
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $participantName = filter_input(INPUT_POST, 'participantName', FILTER_SANITIZE_STRING);
        $ward = filter_input(INPUT_POST, 'ward', FILTER_SANITIZE_STRING);
        $participantDOB = filter_input(INPUT_POST, 'participantDOB', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $primTel = filter_input(INPUT_POST, 'primTel', FILTER_SANITIZE_STRING);
        $primTelType = filter_input(INPUT_POST, 'primTelType', FILTER_SANITIZE_STRING);
        $secTel = filter_input(INPUT_POST, 'secTel', FILTER_SANITIZE_STRING);
        $secTelType = filter_input(INPUT_POST, 'secTelType', FILTER_SANITIZE_STRING);
        $participantAddress = filter_input(INPUT_POST, 'participantAddress', FILTER_SANITIZE_STRING);
        $participantCity = filter_input(INPUT_POST, 'participantCity', FILTER_SANITIZE_STRING);
        $participantState = filter_input(INPUT_POST, 'participantState', FILTER_SANITIZE_STRING);
        $emergencyContact = filter_input(INPUT_POST, 'emergencyContact', FILTER_SANITIZE_STRING);
        $emerPrimTel = filter_input(INPUT_POST, 'emerPrimTel', FILTER_SANITIZE_STRING);
        $emerPrimTelType = filter_input(INPUT_POST, 'emerPrimTelType', FILTER_SANITIZE_STRING);
        $emerSecTel = filter_input(INPUT_POST, 'emerSecTel', FILTER_SANITIZE_STRING);
        $emerSecTelType = filter_input(INPUT_POST, 'emerSecTelType', FILTER_SANITIZE_STRING);
        $specialDiet = filter_input(INPUT_POST, 'specialDiet', FILTER_SANITIZE_STRING);
        $specialDietTxt = filter_input(INPUT_POST, 'specialDietTxt', FILTER_SANITIZE_STRING);
        $allergies = filter_input(INPUT_POST, 'allergies', FILTER_SANITIZE_STRING);
        $allergiesTxt = filter_input(INPUT_POST, 'allergiesTxt', FILTER_SANITIZE_STRING);
        $medication = filter_input(INPUT_POST, 'medication', FILTER_SANITIZE_STRING);
        $selfMedicate = filter_input(INPUT_POST, 'selfMedicate', FILTER_SANITIZE_STRING);
        $medicationList = filter_input(INPUT_POST, 'medicationList', FILTER_SANITIZE_STRING);
        $chronicIllness = filter_input(INPUT_POST, 'chronicIllness', FILTER_SANITIZE_STRING);
        $chronicIllnessTxt = filter_input(INPUT_POST, 'chronicIllnessTxt', FILTER_SANITIZE_STRING);
        $serious = filter_input(INPUT_POST, 'serious', FILTER_SANITIZE_STRING);
        $seriousTxt = filter_input(INPUT_POST, 'seriousTxt', FILTER_SANITIZE_STRING);
        $limitations = filter_input(INPUT_POST, 'limitations', FILTER_SANITIZE_STRING);
        $considerations = filter_input(INPUT_POST, 'considerations', FILTER_SANITIZE_STRING);
        $participantSig = filter_input(INPUT_POST, 'participantSig', FILTER_SANITIZE_STRING);
        $participantSigDate = filter_input(INPUT_POST, 'participantSigDate', FILTER_SANITIZE_STRING);
        $guardianSig = filter_input(INPUT_POST, 'guardianSig', FILTER_SANITIZE_STRING);
        $guardianSigDate = filter_input(INPUT_POST, 'guardianSigDate', FILTER_SANITIZE_STRING);

        // Gray values are not sent on. They are set only to repopulate the gray fields if form validation fails.
        $eventDate = filter_input(INPUT_POST, 'eventDate', FILTER_SANITIZE_STRING);
        $eventDesc = filter_input(INPUT_POST, 'eventDesc', FILTER_SANITIZE_STRING);
        $stake = filter_input(INPUT_POST, 'stake', FILTER_SANITIZE_STRING);
        $eventLeaderName = filter_input(INPUT_POST, 'eventLeaderName', FILTER_SANITIZE_STRING);
        $eventLeaderPhone = filter_input(INPUT_POST, 'eventLeaderPhone', FILTER_SANITIZE_STRING);
        $eventLeaderEmail = filter_input(INPUT_POST, 'eventLeaderEmail', FILTER_SANITIZE_STRING);

        // Validate form data
        $eventId = checkInt($eventId);
        $participantDOB = checkIsDate($participantDOB);
        $email = checkEmail($email);
        $primTel = checkTel($primTel);
        $secTel = checkTel($secTel);
        $emerPrimTel = checkTel($emerPrimTel);
        $emerSecTel = checkTel($emerSecTel);
        $primTelType = checkTelType($primTelType);
        $secTelType = checkTelType($secTelType);
        $emerPrimTelType = checkTelType($emerPrimTelType);
        $emerSecTelType = checkTelType($emerSecTelType);
        $specialDiet = checkBoolText($specialDiet,$specialDietTxt);
        $allergies = checkBoolText($allergies,$allergiesTxt);
        $medication = checkBoolText($medication,$medicationList);
        $chronicIllness = checkBoolText($chronicIllness,$chronicIllnessTxt);
        $serious = checkBoolText($serious,$seriousTxt);
        $participantSig = checkSig($participantSig);
        $guardianSig = checkSig($guardianSig);

        //$selfMedicate
        $chkSelfMedicate = checkDepBool($selfMedicate, $medication);

        // Calculate age by DOB...
        $participantAge = getAge($participantDOB);
        $participantDOB = checkMaxDOB($participantDOB);
        // If participantDOB is >= 19 certain things
        $guardianSig = checkAge($guardianSig, $participantAge);

        //OVERWRITE Signature Dates... Need to match today.
        $participantSigDate = date('Y-m-d');
        $guardianSigDate = date('Y-m-d');

        
        echo "eventId: ". $eventId . "<br>";
        echo "eventDate: ". $eventDate . "<br>";
        echo "eventDesc: ". $eventDesc . "<br>";
        echo "stake: ". $stake . "<br>";
        echo "eventLeaderName: ". $eventLeaderName . "<br>";
        echo "eventLeaderPhone: ". $eventLeaderPhone . "<br>";
        echo "eventLeaderEmail: ". $eventLeaderEmail . "<br>";
        echo "participantAge: ". $participantAge . "<br>";
        echo "participantName: ". $participantName . "<br>";
        echo "ward: ". $ward . "<br>";
        echo "participantDOB: ". $participantDOB . "<br>";
        echo "primTel: ". $primTel . "<br>";
        echo "primTelType: ". $primTelType . "<br>";
        echo "secTel: ". $secTel . "<br>";
        echo "secTelType: ". $secTelType . "<br>";
        echo "participantAddress: ". $participantAddress . "<br>";
        echo "participantCity: ". $participantCity . "<br>";
        echo "participantState: ". $participantState . "<br>";
        echo "emergencyContact: ". $emergencyContact . "<br>";
        echo "emerPrimTel: ". $emerPrimTel . "<br>";
        echo "emerPrimTelType: ". $emerPrimTelType . "<br>";
        echo "emerSecTel: ". $emerSecTel . "<br>";
        echo "emerSecTelType: ". $emerSecTelType . "<br>";
        echo "specialDiet: ". $specialDiet . "<br>";
        echo "specialDietTxt: ". $specialDietTxt . "<br>";
        echo "allergies: ". $allergies . "<br>";
        echo "allergiesTxt: ". $allergiesTxt . "<br>";
        echo "medication: ". $medication . "<br>";
        echo "selfMedicate: ". $selfMedicate . "<br>";
        echo "medicationList: ". $medicationList . "<br>";
        echo "chronicIllness: ". $chronicIllness . "<br>";
        echo "chronicIllnessTxt: ". $chronicIllnessTxt . "<br>";
        echo "serious: ". $serious . "<br>";
        echo "seriousTxt: ". $seriousTxt . "<br>";
        echo "limitations: ". $limitations . "<br>";
        echo "considerations: ". $considerations . "<br>";
        echo "participantSig: ". $participantSig . "<br>";
        echo "participantSigDate: ". $participantSigDate . "<br>";
        echo "guardianSig: ". $guardianSig . "<br>";
        echo "guardianSigDate: ". $guardianSigDate . "<br>";


        if(empty($participantDOB)){
            $_SESSION['message'] = "<div class='alert'>Sorry, only participants turning 14 this year or older may register.</div>";
            $events = getEventsJSON(2021);
            $events = json_decode($events, true);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit; 
        }

        // Check for empty / null values. All values listed are required.
        if((empty($eventId) || empty($participantName) || empty($ward) || empty($participantDOB) || empty($email) || empty($primTel) || empty($primTelType) || empty($participantAddress) || empty($participantCity) || empty($participantState) || empty($emergencyContact) || empty($emerPrimTel) || empty($emerPrimTelType) || empty($specialDiet) || empty($allergies) || empty($medication) || empty($chkSelfMedicate) || empty($chronicIllness) || empty($serious) || empty($participantSig) || empty($guardianSig))){
            $_SESSION['message'] = "<div class='alert'>Please provide information for all empty form fields.</div>";
            $events = getEventsJSON(2021);
            $events = json_decode($events, true);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit; 
        }
        
        $events = getEventsJSON(2021);
        $events = json_decode($events, true);
        $eventList = buildEventList($events);
        $eventScript = buildEventScript($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/confirmation.php';
        break;
    case 'Register':
        // Sanitize form data
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $participantName = filter_input(INPUT_POST, 'participantName', FILTER_SANITIZE_STRING);
        $ward = filter_input(INPUT_POST, 'ward', FILTER_SANITIZE_STRING);
        $participantDOB = filter_input(INPUT_POST, 'participantDOB', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $primTel = filter_input(INPUT_POST, 'primTel', FILTER_SANITIZE_STRING);
        $primTelType = filter_input(INPUT_POST, 'primTelType', FILTER_SANITIZE_STRING);
        $secTel = filter_input(INPUT_POST, 'secTel', FILTER_SANITIZE_STRING);
        $secTelType = filter_input(INPUT_POST, 'secTelType', FILTER_SANITIZE_STRING);
        $participantAddress = filter_input(INPUT_POST, 'participantAddress', FILTER_SANITIZE_STRING);
        $participantCity = filter_input(INPUT_POST, 'participantCity', FILTER_SANITIZE_STRING);
        $participantState = filter_input(INPUT_POST, 'participantState', FILTER_SANITIZE_STRING);
        $emergencyContact = filter_input(INPUT_POST, 'emergencyContact', FILTER_SANITIZE_STRING);
        $emerPrimTel = filter_input(INPUT_POST, 'emerPrimTel', FILTER_SANITIZE_STRING);
        $emerPrimTelType = filter_input(INPUT_POST, 'emerPrimTelType', FILTER_SANITIZE_STRING);
        $emerSecTel = filter_input(INPUT_POST, 'emerSecTel', FILTER_SANITIZE_STRING);
        $emerSecTelType = filter_input(INPUT_POST, 'emerSecTelType', FILTER_SANITIZE_STRING);
        $specialDiet = filter_input(INPUT_POST, 'specialDiet', FILTER_SANITIZE_STRING);
        $specialDietTxt = filter_input(INPUT_POST, 'specialDietTxt', FILTER_SANITIZE_STRING);
        $allergies = filter_input(INPUT_POST, 'allergies', FILTER_SANITIZE_STRING);
        $allergiesTxt = filter_input(INPUT_POST, 'allergiesTxt', FILTER_SANITIZE_STRING);
        $medication = filter_input(INPUT_POST, 'medication', FILTER_SANITIZE_STRING);
        $selfMedicate = filter_input(INPUT_POST, 'selfMedicate', FILTER_SANITIZE_STRING);
        $medicationList = filter_input(INPUT_POST, 'medicationList', FILTER_SANITIZE_STRING);
        $chronicIllness = filter_input(INPUT_POST, 'chronicIllness', FILTER_SANITIZE_STRING);
        $chronicIllnessTxt = filter_input(INPUT_POST, 'chronicIllnessTxt', FILTER_SANITIZE_STRING);
        $serious = filter_input(INPUT_POST, 'serious', FILTER_SANITIZE_STRING);
        $seriousTxt = filter_input(INPUT_POST, 'seriousTxt', FILTER_SANITIZE_STRING);
        $limitations = filter_input(INPUT_POST, 'limitations', FILTER_SANITIZE_STRING);
        $considerations = filter_input(INPUT_POST, 'considerations', FILTER_SANITIZE_STRING);
        $participantSig = filter_input(INPUT_POST, 'participantSig', FILTER_SANITIZE_STRING);
        $participantSigDate = filter_input(INPUT_POST, 'participantSigDate', FILTER_SANITIZE_STRING);
        $guardianSig = filter_input(INPUT_POST, 'guardianSig', FILTER_SANITIZE_STRING);
        $guardianSigDate = filter_input(INPUT_POST, 'guardianSigDate', FILTER_SANITIZE_STRING);
        $adult = filter_input(INPUT_POST, 'adult', FILTER_SANITIZE_STRING);
        $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
        $permission = filter_input(INPUT_POST, 'permission', FILTER_SANITIZE_STRING);
        $responsibility = filter_input(INPUT_POST, 'responsibility', FILTER_SANITIZE_STRING);
        $participantESig = filter_input(INPUT_POST, 'participantESig', FILTER_SANITIZE_STRING);
        $guardianESig = filter_input(INPUT_POST, 'guardianESig', FILTER_SANITIZE_STRING);

        echo "participantSig: ". $participantSig . "<br>";

        // Gray values are not sent on. They are set only to repopulate the gray fields if form validation fails.
        $eventDate = filter_input(INPUT_POST, 'eventDate', FILTER_SANITIZE_STRING);
        $eventDesc = filter_input(INPUT_POST, 'eventDesc', FILTER_SANITIZE_STRING);
        $stake = filter_input(INPUT_POST, 'stake', FILTER_SANITIZE_STRING);
        $eventLeaderName = filter_input(INPUT_POST, 'eventLeaderName', FILTER_SANITIZE_STRING);
        $eventLeaderPhone = filter_input(INPUT_POST, 'eventLeaderPhone', FILTER_SANITIZE_STRING);
        $eventLeaderEmail = filter_input(INPUT_POST, 'eventLeaderEmail', FILTER_SANITIZE_STRING);

        // Validate form data
        $eventId = checkInt($eventId);
        $participantDOB = checkIsDate($participantDOB);
        $email = checkEmail($email);
        $primTel = checkTel($primTel);
        $secTel = checkTel($secTel);
        $emerPrimTel = checkTel($emerPrimTel);
        $emerSecTel = checkTel($emerSecTel);
        $primTelType = checkTelType($primTelType);
        $secTelType = checkTelType($secTelType);
        $emerPrimTelType = checkTelType($emerPrimTelType);
        $emerSecTelType = checkTelType($emerSecTelType);
        $specialDiet = checkBoolText($specialDiet,$specialDietTxt);
        $allergies = checkBoolText($allergies,$allergiesTxt);
        $medication = checkBoolText($medication,$medicationList);
        $chronicIllness = checkBoolText($chronicIllness,$chronicIllnessTxt);
        $serious = checkBoolText($serious,$seriousTxt);
        $participantSig = checkSig($participantSig);
        $guardianSig = checkSig($guardianSig);
        $adult = checkBool($adult);
        $contact = checkBool($contact);
        $permission = checkBool($permission);
        $responsibility = checkBool($responsibility);
        $participantESig = checkSig($participantESig);
        $guardianESig = checkSig($guardianESig);
        // $selfMedicate
        $chkSelfMedicate = checkDepBool($selfMedicate, $medication);

        // Calculate age by DOB...
        $participantAge = getAge($participantDOB);
        $participantDOB = checkMaxDOB($participantDOB);
        // If participantDOB is >= 19 certain things
        $guardianSig = checkAge($guardianSig, $participantAge);
        $guardianESig = checkAge($guardianESig, $participantAge);

        //OVERWRITE Signature Dates... Need to match today.
        $participantSigDate = date('Y-m-d');
        $guardianSigDate = date('Y-m-d');

        
        echo "eventId: ". $eventId . "<br>";
        echo "eventDate: ". $eventDate . "<br>";
        echo "eventDesc: ". $eventDesc . "<br>";
        echo "stake: ". $stake . "<br>";
        echo "eventLeaderName: ". $eventLeaderName . "<br>";
        echo "eventLeaderPhone: ". $eventLeaderPhone . "<br>";
        echo "eventLeaderEmail: ". $eventLeaderEmail . "<br>";
        echo "participantAge: ". $participantAge . "<br>";
        echo "participantName: ". $participantName . "<br>";
        echo "ward: ". $ward . "<br>";
        echo "participantDOB: ". $participantDOB . "<br>";
        echo "primTel: ". $primTel . "<br>";
        echo "primTelType: ". $primTelType . "<br>";
        echo "secTel: ". $secTel . "<br>";
        echo "secTelType: ". $secTelType . "<br>";
        echo "participantAddress: ". $participantAddress . "<br>";
        echo "participantCity: ". $participantCity . "<br>";
        echo "participantState: ". $participantState . "<br>";
        echo "emergencyContact: ". $emergencyContact . "<br>";
        echo "emerPrimTel: ". $emerPrimTel . "<br>";
        echo "emerPrimTelType: ". $emerPrimTelType . "<br>";
        echo "emerSecTel: ". $emerSecTel . "<br>";
        echo "emerSecTelType: ". $emerSecTelType . "<br>";
        echo "specialDiet: ". $specialDiet . "<br>";
        echo "specialDietTxt: ". $specialDietTxt . "<br>";
        echo "allergies: ". $allergies . "<br>";
        echo "allergiesTxt: ". $allergiesTxt . "<br>";
        echo "medication: ". $medication . "<br>";
        echo "selfMedicate: ". $selfMedicate . "<br>";
        echo "medicationList: ". $medicationList . "<br>";
        echo "chronicIllness: ". $chronicIllness . "<br>";
        echo "chronicIllnessTxt: ". $chronicIllnessTxt . "<br>";
        echo "serious: ". $serious . "<br>";
        echo "seriousTxt: ". $seriousTxt . "<br>";
        echo "limitations: ". $limitations . "<br>";
        echo "considerations: ". $considerations . "<br>";
        echo "participantSig: ". $participantSig . "<br>";
        echo "participantSigDate: ". $participantSigDate . "<br>";
        echo "guardianSig: ". $guardianSig . "<br>";
        echo "guardianSigDate: ". $guardianSigDate . "<br>";
        echo "adult: ". $adult . "<br>";
        echo "contact: ". $contact . "<br>";
        echo "permission: ". $permission . "<br>";
        echo "responsibility: ". $responsibility . "<br>";
        echo "participantESig: ". $participantESig . "<br>";
        echo "guardianESig: ". $guardianSig . "<br>";
        

        if(empty($participantDOB)){
            $_SESSION['message'] = "<div class='alert'>Sorry, only participants turning 14 this year or older may register.</div>";
            $events = getEventsJSON(2021);
            $events = json_decode($events, true);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit; 
        }

        if((empty($eventId) || empty($participantName) || empty($ward) || empty($participantDOB) || empty($email) || empty($primTel) || empty($primTelType) || empty($participantAddress) || empty($participantCity) || empty($participantState) || empty($emergencyContact) || empty($emerPrimTel) || empty($emerPrimTelType) || empty($specialDiet) || empty($allergies) || empty($medication) || empty($chkSelfMedicate) || empty($chronicIllness) || empty($serious) || empty($participantSig) || empty($guardianSig)  || empty($adult)  || empty($contact)  || empty($permission)  || empty($responsibility) || empty($participantESig) || empty($guardianESig))){
            $_SESSION['message'] = "<div class='alert'>Please provide information for all empty form fields.</div>";
            $events = getEventsJSON(2021);
            $events = json_decode($events, true);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit; 
        }

        // Insert form data
        $regId = regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate, $adult, $contact, $permission, $responsibility, $participantESig, $guardianESig);
        //$regId = false; // Testing only

        // Validate Insert
        // if($regOutcome === 1){
        if($regId){        
            $_SESSION['message'] = "<div class='message'>Thanks for registering $participantName.</div>";
            $_SESSION['participantid'] = $regId;
            $_SESSION['participant'] = $participantName;
            $_SESSION['eventid'] = $eventId;            
            header('Location: /2021/registration/');
            exit;
        } else {
            $_SESSION['message'] = "<div class='alert'>Sorry, $participantName, but registration failed. Please try again.<br>If the problem persists please contact your Ward Leadership and/or the WebAdmin.</div>";
            $events = getEventsJSON(2021);
            $events = json_decode($events, true);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit;
        }

        break;
    default:
        $events = getEventsJSON(2021);
        $events = json_decode($events, true);
        $eventList = buildEventList($events);
        $eventScript = buildEventScript($events);
        include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
}

// Redirect script at java level to switch from http to https.
// No longer needed as it is handled in .htaccess rules, but I want to keep a ref. 
// <script>
//     if (window.location.href.substring(0, 8) != "https://") {
//         window.location = location.href.replace(/^http:/, 'https:');
//     }
// </script>


?>