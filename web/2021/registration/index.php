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

        // Validate form data
        $participantAge = getAge($participantDOB); // Calculate age by DOB...

        echo $participantAge;
        exit;
        // Insert form data
        //getEvents();
        $regOutcome = regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate);
        
        // Validate Insert
        if($regOutcome === 1){
            $_SESSION['message'] = "Thanks for registering $participantName.";
            header('Location: /2021/registration/');
            exit;
        } else {
            $message = "Sorry $participantName, but the registration failed. Please try again.";
            include $_SERVER['DOCUMENT_ROOT'] . '/2021/view/registration.php';
            exit;
        }

        break;
    default:
        // include $_SERVER['DOCUMENT_ROOT'] . '/camp2021/view/home.php';
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