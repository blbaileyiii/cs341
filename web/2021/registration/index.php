<?php

/*
 * Registration Controller
 */

session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/connections.php';
// Get the account model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/models/reg-model.php';
// Get the account validation fxs for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/2021/libraries/fx.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'confirm':
        break;
    case 'Register':
        // Sanitize form data
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $participantName = filter_input(INPUT_POST, 'participantName', FILTER_SANITIZE_STRING);
        $ward = filter_input(INPUT_POST, 'ward', FILTER_SANITIZE_STRING);
        $participantDOB = filter_input(INPUT_POST, 'participantDOB', FILTER_SANITIZE_STRING);
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

        //$selfMedicate

        //OVERWRITE Signature Dates... Need to match today.

        // If participantDOB is >= 19 certain things

        // Calculate age by DOB...
        $participantAge = getAge($participantDOB); 


        echo $eventId . "<br>";
        echo $participantName . "<br>";
        echo $ward . "<br>";
        echo $participantDOB . "<br>";
        echo $primTel . "<br>";
        echo $primTelType . "<br>";
        echo $secTel . "<br>";
        echo $secTelType . "<br>";
        echo $participantAddress . "<br>";
        echo $participantCity . "<br>";
        echo $participantState . "<br>";
        echo $emergencyContact . "<br>";
        echo $emerPrimTel . "<br>";
        echo $emerPrimTelType . "<br>";
        echo $emerSecTel . "<br>";
        echo $emerSecTelType . "<br>";
        echo $specialDiet . "<br>";
        echo $specialDietTxt . "<br>";
        echo $allergies . "<br>";
        echo $allergiesTxt . "<br>";
        echo $medication . "<br>";
        echo $selfMedicate . "<br>";
        echo $medicationList . "<br>";
        echo $chronicIllness . "<br>";
        echo $chronicIllnessTxt . "<br>";
        echo $serious . "<br>";
        echo $seriousTxt . "<br>";
        echo $limitations . "<br>";
        echo $considerations . "<br>";
        echo $participantSig . "<br>";
        echo $participantSigDate . "<br>";
        echo $guardianSig . "<br>";
        echo $guardianSigDate . "<br>";

        // Insert form data
        //getEvents();
        $regId = false;
        //$regId = regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate);
        
        // Validate Insert
        //if($regOutcome === 1){
        if($regId){        
            $_SESSION['message'] = "Thanks for registering $participantName.";
            $_SESSION['participantid'] = $regId;
            $_SESSION['participant'] = $participantName;
            $_SESSION['eventid'] = $eventId;            
            header('Location: /2021/registration/');
            exit;
        } else {
            $_SESSION['message'] = "Sorry, $participantName, but registration failed. Please try again.<br>If the problem persists please contact your Ward Leadership and/or the WebAdmin.";
            $events = getEvents(2021);
            $eventList = buildEventList($events);
            $eventScript = buildEventScript($events);
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit;
        }

        break;
    default:
        $events = getEvents(2021);
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