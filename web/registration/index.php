<?php

/*
 * Registration Controller
 */

session_start();
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/connections.php';
// Get the account model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/reg-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/query-model.php';
// Get the account validation fxs for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/fx.php';

$events = getEventsJSON();
if($events){
    $events = json_decode($events, true);
    $eventList = buildEventList($events);
    $navList = buildNavList($events);
}

$min_DOB =  (date('Y') - 12).'-12-31'; // default

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'Register':
        // Sanitize form data
        $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $participantName = trim(filter_input(INPUT_POST, 'participantName', FILTER_SANITIZE_STRING));
        $ward = trim(filter_input(INPUT_POST, 'ward', FILTER_SANITIZE_STRING));
        $participantDOB = trim(filter_input(INPUT_POST, 'participantDOB', FILTER_SANITIZE_STRING));
        $shirtSize = trim(filter_input(INPUT_POST, 'shirtSize', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $primTel = trim(filter_input(INPUT_POST, 'primTel', FILTER_SANITIZE_STRING));
        $primTelType = trim(filter_input(INPUT_POST, 'primTelType', FILTER_SANITIZE_STRING));
        $secTel = trim(filter_input(INPUT_POST, 'secTel', FILTER_SANITIZE_STRING));
        $secTelType = trim(filter_input(INPUT_POST, 'secTelType', FILTER_SANITIZE_STRING));
        $participantAddress = trim(filter_input(INPUT_POST, 'participantAddress', FILTER_SANITIZE_STRING));
        $participantCity = trim(filter_input(INPUT_POST, 'participantCity', FILTER_SANITIZE_STRING));
        $participantState = trim(filter_input(INPUT_POST, 'participantState', FILTER_SANITIZE_STRING));
        $emergencyContact = trim(filter_input(INPUT_POST, 'emergencyContact', FILTER_SANITIZE_STRING));
        $emerPrimTel = trim(filter_input(INPUT_POST, 'emerPrimTel', FILTER_SANITIZE_STRING));
        $emerPrimTelType = trim(filter_input(INPUT_POST, 'emerPrimTelType', FILTER_SANITIZE_STRING));
        $emerSecTel = trim(filter_input(INPUT_POST, 'emerSecTel', FILTER_SANITIZE_STRING));
        $emerSecTelType = trim(filter_input(INPUT_POST, 'emerSecTelType', FILTER_SANITIZE_STRING));
        $specialDiet = trim(filter_input(INPUT_POST, 'specialDiet', FILTER_SANITIZE_STRING));
        $specialDietTxt = trim(filter_input(INPUT_POST, 'specialDietTxt', FILTER_SANITIZE_STRING));
        $allergies = trim(filter_input(INPUT_POST, 'allergies', FILTER_SANITIZE_STRING));
        $allergiesTxt = trim(filter_input(INPUT_POST, 'allergiesTxt', FILTER_SANITIZE_STRING));
        $medication = trim(filter_input(INPUT_POST, 'medication', FILTER_SANITIZE_STRING));
        $selfMedicate = trim(filter_input(INPUT_POST, 'selfMedicate', FILTER_SANITIZE_STRING));
        $medicationList = trim(filter_input(INPUT_POST, 'medicationList', FILTER_SANITIZE_STRING));
        $chronicIllness = trim(filter_input(INPUT_POST, 'chronicIllness', FILTER_SANITIZE_STRING));
        $chronicIllnessTxt = trim(filter_input(INPUT_POST, 'chronicIllnessTxt', FILTER_SANITIZE_STRING));
        $serious = trim(filter_input(INPUT_POST, 'serious', FILTER_SANITIZE_STRING));
        $seriousTxt = trim(filter_input(INPUT_POST, 'seriousTxt', FILTER_SANITIZE_STRING));
        $limitations = trim(filter_input(INPUT_POST, 'limitations', FILTER_SANITIZE_STRING));
        $considerations = trim(filter_input(INPUT_POST, 'considerations', FILTER_SANITIZE_STRING));
        $adult = trim(filter_input(INPUT_POST, 'adult', FILTER_SANITIZE_STRING));
        $contact = trim(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
        $permission = trim(filter_input(INPUT_POST, 'permission', FILTER_SANITIZE_STRING));
        $responsibility = trim(filter_input(INPUT_POST, 'responsibility', FILTER_SANITIZE_STRING));
        $participantESig = trim(filter_input(INPUT_POST, 'participantESig', FILTER_SANITIZE_STRING));
        $participantSigDate = trim(filter_input(INPUT_POST, 'participantSigDate', FILTER_SANITIZE_STRING));
        $guardianESig = trim(filter_input(INPUT_POST, 'guardianESig', FILTER_SANITIZE_STRING));
        $guardianSigDate = trim(filter_input(INPUT_POST, 'guardianSigDate', FILTER_SANITIZE_STRING));

        // Gray values are not sent on. They are set only to repopulate the gray fields if form validation fails.
        $eventDate = trim(filter_input(INPUT_POST, 'eventDate', FILTER_SANITIZE_STRING));
        $eventDesc = trim(filter_input(INPUT_POST, 'eventDesc', FILTER_SANITIZE_STRING));
        $stake = trim(filter_input(INPUT_POST, 'stake', FILTER_SANITIZE_STRING));
        $eventLeaderName = trim(filter_input(INPUT_POST, 'eventLeaderName', FILTER_SANITIZE_STRING));
        $eventLeaderPhone = trim(filter_input(INPUT_POST, 'eventLeaderPhone', FILTER_SANITIZE_STRING));
        $eventLeaderEmail = trim(filter_input(INPUT_POST, 'eventLeaderEmail', FILTER_SANITIZE_STRING));

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
        $specialDiet = checkBool($specialDiet);
        $specialDiet = checkBoolText($specialDiet,$specialDietTxt);
        $allergies = checkBool($allergies);
        $allergies = checkBoolText($allergies,$allergiesTxt);
        $medication = checkBool($medication);
        $medication = checkBoolText($medication,$medicationList);
        $selfMedicate = checkBool($selfMedicate);
        $chronicIllness = checkBool($chronicIllness);
        $chronicIllness = checkBoolText($chronicIllness,$chronicIllnessTxt);
        $serious = checkBool($serious);
        $serious = checkBoolText($serious,$seriousTxt);
        $adult = checkBool($adult);
        $contact = checkBool($contact);
        $permission = checkBool($permission);
        $responsibility = checkBool($responsibility);
        $participantESig = checkSig($participantESig);
        $guardianESig = checkSig($guardianESig);

        //$selfMedicate
        $chkSelfMedicate = checkDepBool($selfMedicate, $medication);

        // Calculate age by DOB against date event will occur...        
        if(isset($eventId)){
            foreach($events as $event){
                if($event['id'] == $eventId) { 
                    $minDOB = $event['min_DOB'];
                };
            } 
        }

        $participantAge = getAge($participantDOB);

        $minAge = getAge($min_DOB);
        
        $participantDOB = checkMaxDOB($participantDOB, $minDOB);

        // If participantDOB is >= 19 certain things
        $guardianESig = checkAge($guardianESig, $participantAge);

        //OVERWRITE Signature Dates... Need to match today.
        $participantSigDate = date('Y-m-d');
        $guardianSigDate = date('Y-m-d');


        // echo "eventId: ". $eventId . "<br>";
        // echo "eventDate: ". $eventDate . "<br>";
        // echo "eventDesc: ". $eventDesc . "<br>";
        // echo "stake: ". $stake . "<br>";
        // echo "eventLeaderName: ". $eventLeaderName . "<br>";
        // echo "eventLeaderPhone: ". $eventLeaderPhone . "<br>";
        // echo "eventLeaderEmail: ". $eventLeaderEmail . "<br>";
        // echo "participantAge: ". $participantAge . "<br>";
        // echo "participantName: ". $participantName . "<br>";
        // echo "ward: ". $ward . "<br>";
        // echo "participantDOB: ". $participantDOB . "<br>";
        // echo "primTel: ". $primTel . "<br>";
        // echo "primTelType: ". $primTelType . "<br>";
        // echo "secTel: ". $secTel . "<br>";
        // echo "secTelType: ". $secTelType . "<br>";
        // echo "participantAddress: ". $participantAddress . "<br>";
        // echo "participantCity: ". $participantCity . "<br>";
        // echo "participantState: ". $participantState . "<br>";
        // echo "emergencyContact: ". $emergencyContact . "<br>";
        // echo "emerPrimTel: ". $emerPrimTel . "<br>";
        // echo "emerPrimTelType: ". $emerPrimTelType . "<br>";
        // echo "emerSecTel: ". $emerSecTel . "<br>";
        // echo "emerSecTelType: ". $emerSecTelType . "<br>";
        // echo "specialDiet: ". $specialDiet . "<br>";
        // echo "specialDietTxt: ". $specialDietTxt . "<br>";
        // echo "allergies: ". $allergies . "<br>";
        // echo "allergiesTxt: ". $allergiesTxt . "<br>";
        // echo "medication: ". $medication . "<br>";
        // echo "selfMedicate: ". $selfMedicate . "<br>";
        // echo "medicationList: ". $medicationList . "<br>";
        // echo "chronicIllness: ". $chronicIllness . "<br>";
        // echo "chronicIllnessTxt: ". $chronicIllnessTxt . "<br>";
        // echo "serious: ". $serious . "<br>";
        // echo "seriousTxt: ". $seriousTxt . "<br>";
        // echo "limitations: ". $limitations . "<br>";
        // echo "considerations: ". $considerations . "<br>";        
        // echo "adult: ". $adult . "<br>";
        // echo "contact: ". $contact . "<br>";
        // echo "permission: ". $permission . "<br>";
        // echo "responsibility: ". $responsibility . "<br>";
        // echo "participantESig: ". $participantESig . "<br>";
        // echo "participantSigDate: ". $participantSigDate . "<br>";
        // echo "guardianESig: ". $guardianSig . "<br>";
        // echo "guardianSigDate: ". $guardianSigDate . "<br>";


        if(empty($participantDOB)){
            $_SESSION['message'] = "<div class='alert'>Sorry, either you forgot to add your Date of Birth or you aren't old enough. Note: Only participants turning $minAge this year or older may register.</div>";
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
            exit; 
        }

        // Check for empty / null values. All values listed are required.
        if(empty($eventId) || empty($participantName) || empty($ward) || empty($participantDOB) || empty($shirtSize) || empty($email) || empty($primTel) || empty($primTelType) || empty($participantAddress) || empty($participantCity) || empty($participantState) || empty($emergencyContact) || empty($emerPrimTel) || empty($emerPrimTelType) || empty($specialDiet) || empty($allergies) || empty($medication) || empty($chkSelfMedicate) || empty($chronicIllness) || empty($serious) || empty($adult)  || empty($contact)  || empty($permission)  || empty($responsibility)){
            $_SESSION['message'] = "<div class='alert'>Please provide information for all empty form fields.</div>";
            $validate = true;
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
            exit; 
        }
        if(empty($participantESig)){
            $_SESSION['message'] = "<div class='alert'>The participant must sign and confirm.</div>";
            $validate = true;
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
            exit; 
        }
        if(empty($guardianESig) && $participantAge < 19 ){
            $_SESSION['message'] = "<div class='alert'>The parent or guardian must sign and confirm.</div>";
            $validate = true;
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
            exit; 
        }

        // Correct Capitalization
        $participantName = ucwords(strtolower($participantName));
        $email = strtolower($email);
        $participantAddress = ucwords(strtolower($participantAddress));
        $participantCity = ucwords(strtolower($participantCity));
        if (strlen(trim($participantState)) <= 2) {$participantState = strtoupper($participantState);} else {$participantState = ucwords(strtolower($participantState));}
        $emergencyContact = ucwords(strtolower($emergencyContact));

        if($participantAge > 18) {
            $leader = true;
        } else {
            $leader = false;
        }

        $leader = checkBool($leader);

        // Insert form data
        $regId = regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $shirtSize, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $adult, $contact, $permission, $responsibility, $participantESig, $participantSigDate, $guardianESig, $guardianSigDate, $leader);
        //$regId = false; // Testing only

        // Validate Insert
        // if($regOutcome === 1){
        if($regId){            
            foreach($events as $event){
                if($event['id'] == $eventId) { $eventName = $event['name']; };
            }   
            //echo $eventName;
            $_SESSION['message'] = "<div class='message'>Thanks for registering $participantName.</div>";
            $_SESSION['participantid'] = $regId;
            $_SESSION['participant'] = $participantName;
            $_SESSION['eventid'] = $eventId;
            $_SESSION['eventname'] = $eventName;
            header('Location: /registration/');
            exit;
        } else {
            $_SESSION['message'] = "<div class='alert'>Sorry, $participantName, but registration failed. Please try again.<br>If the problem persists please contact your Ward Leadership and/or the WebAdmin.</div>";
            include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
            exit;
        }
        break;
    // case 'confirmation':
    //     // Sanitize form data
    //     $eventId = filter_input(INPUT_POST, 'eventId', FILTER_SANITIZE_NUMBER_INT);
    //     $participantName = trim(filter_input(INPUT_POST, 'participantName', FILTER_SANITIZE_STRING));
    //     $ward = trim(filter_input(INPUT_POST, 'ward', FILTER_SANITIZE_STRING));
    //     $participantDOB = trim(filter_input(INPUT_POST, 'participantDOB', FILTER_SANITIZE_STRING));
    //     $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    //     $primTel = trim(filter_input(INPUT_POST, 'primTel', FILTER_SANITIZE_STRING));
    //     $primTelType = trim(filter_input(INPUT_POST, 'primTelType', FILTER_SANITIZE_STRING));
    //     $secTel = trim(filter_input(INPUT_POST, 'secTel', FILTER_SANITIZE_STRING));
    //     $secTelType = trim(filter_input(INPUT_POST, 'secTelType', FILTER_SANITIZE_STRING));
    //     $participantAddress = trim(filter_input(INPUT_POST, 'participantAddress', FILTER_SANITIZE_STRING));
    //     $participantCity = trim(filter_input(INPUT_POST, 'participantCity', FILTER_SANITIZE_STRING));
    //     $participantState = trim(filter_input(INPUT_POST, 'participantState', FILTER_SANITIZE_STRING));
    //     $emergencyContact = trim(filter_input(INPUT_POST, 'emergencyContact', FILTER_SANITIZE_STRING));
    //     $emerPrimTel = trim(filter_input(INPUT_POST, 'emerPrimTel', FILTER_SANITIZE_STRING));
    //     $emerPrimTelType = trim(filter_input(INPUT_POST, 'emerPrimTelType', FILTER_SANITIZE_STRING));
    //     $emerSecTel = trim(filter_input(INPUT_POST, 'emerSecTel', FILTER_SANITIZE_STRING));
    //     $emerSecTelType = trim(filter_input(INPUT_POST, 'emerSecTelType', FILTER_SANITIZE_STRING));
    //     $specialDiet = trim(filter_input(INPUT_POST, 'specialDiet', FILTER_SANITIZE_STRING));
    //     $specialDietTxt = trim(filter_input(INPUT_POST, 'specialDietTxt', FILTER_SANITIZE_STRING));
    //     $allergies = trim(filter_input(INPUT_POST, 'allergies', FILTER_SANITIZE_STRING));
    //     $allergiesTxt = trim(filter_input(INPUT_POST, 'allergiesTxt', FILTER_SANITIZE_STRING));
    //     $medication = trim(filter_input(INPUT_POST, 'medication', FILTER_SANITIZE_STRING));
    //     $selfMedicate = trim(filter_input(INPUT_POST, 'selfMedicate', FILTER_SANITIZE_STRING));
    //     $medicationList = trim(filter_input(INPUT_POST, 'medicationList', FILTER_SANITIZE_STRING));
    //     $chronicIllness = trim(filter_input(INPUT_POST, 'chronicIllness', FILTER_SANITIZE_STRING));
    //     $chronicIllnessTxt = trim(filter_input(INPUT_POST, 'chronicIllnessTxt', FILTER_SANITIZE_STRING));
    //     $serious = trim(filter_input(INPUT_POST, 'serious', FILTER_SANITIZE_STRING));
    //     $seriousTxt = trim(filter_input(INPUT_POST, 'seriousTxt', FILTER_SANITIZE_STRING));
    //     $limitations = trim(filter_input(INPUT_POST, 'limitations', FILTER_SANITIZE_STRING));
    //     $considerations = trim(filter_input(INPUT_POST, 'considerations', FILTER_SANITIZE_STRING));
    //     $participantSig = trim(filter_input(INPUT_POST, 'participantSig', FILTER_SANITIZE_STRING));
    //     $participantSigDate = trim(filter_input(INPUT_POST, 'participantSigDate', FILTER_SANITIZE_STRING));
    //     $guardianSig = trim(filter_input(INPUT_POST, 'guardianSig', FILTER_SANITIZE_STRING));
    //     $guardianSigDate = trim(filter_input(INPUT_POST, 'guardianSigDate', FILTER_SANITIZE_STRING));
    //     $adult = trim(filter_input(INPUT_POST, 'adult', FILTER_SANITIZE_STRING));
    //     $contact = trim(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
    //     $permission = trim(filter_input(INPUT_POST, 'permission', FILTER_SANITIZE_STRING));
    //     $responsibility = trim(filter_input(INPUT_POST, 'responsibility', FILTER_SANITIZE_STRING));
    //     $participantESig = trim(filter_input(INPUT_POST, 'participantESig', FILTER_SANITIZE_STRING));
    //     $guardianESig = trim(filter_input(INPUT_POST, 'guardianESig', FILTER_SANITIZE_STRING));

    //     echo "participantSig: ". $participantSig . "<br>";

    //     // Gray values are not sent on. They are set only to repopulate the gray fields if form validation fails.
    //     $eventDate = trim(filter_input(INPUT_POST, 'eventDate', FILTER_SANITIZE_STRING));
    //     $eventDesc = trim(filter_input(INPUT_POST, 'eventDesc', FILTER_SANITIZE_STRING));
    //     $stake = trim(filter_input(INPUT_POST, 'stake', FILTER_SANITIZE_STRING));
    //     $eventLeaderName = trim(filter_input(INPUT_POST, 'eventLeaderName', FILTER_SANITIZE_STRING));
    //     $eventLeaderPhone = trim(filter_input(INPUT_POST, 'eventLeaderPhone', FILTER_SANITIZE_STRING));
    //     $eventLeaderEmail = trim(filter_input(INPUT_POST, 'eventLeaderEmail', FILTER_SANITIZE_STRING));

    //     // Validate form data
    //     $eventId = checkInt($eventId);
    //     $participantDOB = checkIsDate($participantDOB);
    //     $email = checkEmail($email);
    //     $primTel = checkTel($primTel);
    //     $secTel = checkTel($secTel);
    //     $emerPrimTel = checkTel($emerPrimTel);
    //     $emerSecTel = checkTel($emerSecTel);
    //     $primTelType = checkTelType($primTelType);
    //     $secTelType = checkTelType($secTelType);
    //     $emerPrimTelType = checkTelType($emerPrimTelType);
    //     $emerSecTelType = checkTelType($emerSecTelType);
    //     $specialDiet = checkBool($specialDiet);
    //     $specialDiet = checkBoolText($specialDiet,$specialDietTxt);
    //     $allergies = checkBool($allergies);
    //     $allergies = checkBoolText($allergies,$allergiesTxt);
    //     $medication = checkBool($medication);
    //     $medication = checkBoolText($medication,$medicationList);
    //     $selfMedicate = checkBool($selfMedicate);
    //     $chronicIllness = checkBool($chronicIllness);
    //     $chronicIllness = checkBoolText($chronicIllness,$chronicIllnessTxt);
    //     $serious = checkBool($serious);
    //     $serious = checkBoolText($serious,$seriousTxt);
    //     $participantSig = checkSig($participantSig);
    //     $guardianSig = checkSig($guardianSig);
    //     $adult = checkBool($adult);
    //     $contact = checkBool($contact);
    //     $permission = checkBool($permission);
    //     $responsibility = checkBool($responsibility);
    //     $participantESig = checkSig($participantESig);
    //     $guardianESig = checkSig($guardianESig);
    //     // $selfMedicate
    //     $chkSelfMedicate = checkDepBool($selfMedicate, $medication);

    //     // Calculate age by DOB...
    //     $participantAge = getAge($participantDOB);
    //     if(isset($eventId)){
    //         foreach($events as $event){
    //             if($event['id'] == $eventId) { $minDOB = $event['min_DOB']; };
    //         } 
    //     }
    //     $minAge = getAge($min_DOB);
        
    //     $participantDOB = checkMaxDOB($participantDOB, $minDOB);
    //     // If participantDOB is >= 19 certain things
    //     $guardianSig = checkAge($guardianSig, $participantAge);
    //     $guardianESig = checkAge($guardianESig, $participantAge);

    //     //OVERWRITE Signature Dates... Need to match today.
    //     $participantSigDate = date('Y-m-d');
    //     $guardianSigDate = date('Y-m-d');

    //     /*
    //     echo "eventId: ". $eventId . "<br>";
    //     echo "eventDate: ". $eventDate . "<br>";
    //     echo "eventDesc: ". $eventDesc . "<br>";
    //     echo "stake: ". $stake . "<br>";
    //     echo "eventLeaderName: ". $eventLeaderName . "<br>";
    //     echo "eventLeaderPhone: ". $eventLeaderPhone . "<br>";
    //     echo "eventLeaderEmail: ". $eventLeaderEmail . "<br>";
    //     echo "participantAge: ". $participantAge . "<br>";
    //     echo "participantName: ". $participantName . "<br>";
    //     echo "ward: ". $ward . "<br>";
    //     echo "participantDOB: ". $participantDOB . "<br>";
    //     echo "primTel: ". $primTel . "<br>";
    //     echo "primTelType: ". $primTelType . "<br>";
    //     echo "secTel: ". $secTel . "<br>";
    //     echo "secTelType: ". $secTelType . "<br>";
    //     echo "participantAddress: ". $participantAddress . "<br>";
    //     echo "participantCity: ". $participantCity . "<br>";
    //     echo "participantState: ". $participantState . "<br>";
    //     echo "emergencyContact: ". $emergencyContact . "<br>";
    //     echo "emerPrimTel: ". $emerPrimTel . "<br>";
    //     echo "emerPrimTelType: ". $emerPrimTelType . "<br>";
    //     echo "emerSecTel: ". $emerSecTel . "<br>";
    //     echo "emerSecTelType: ". $emerSecTelType . "<br>";
    //     echo "specialDiet: ". $specialDiet . "<br>";
    //     echo "specialDietTxt: ". $specialDietTxt . "<br>";
    //     echo "allergies: ". $allergies . "<br>";
    //     echo "allergiesTxt: ". $allergiesTxt . "<br>";
    //     echo "medication: ". $medication . "<br>";
    //     echo "selfMedicate: ". $selfMedicate . "<br>";
    //     echo "medicationList: ". $medicationList . "<br>";
    //     echo "chronicIllness: ". $chronicIllness . "<br>";
    //     echo "chronicIllnessTxt: ". $chronicIllnessTxt . "<br>";
    //     echo "serious: ". $serious . "<br>";
    //     echo "seriousTxt: ". $seriousTxt . "<br>";
    //     echo "limitations: ". $limitations . "<br>";
    //     echo "considerations: ". $considerations . "<br>";        
    //     echo "adult: ". $adult . "<br>";
    //     echo "contact: ". $contact . "<br>";
    //     echo "permission: ". $permission . "<br>";
    //     echo "responsibility: ". $responsibility . "<br>";
    //     echo "participantESig: ". $participantESig . "<br>";
    //     echo "participantSigDate: ". $participantSigDate . "<br>";
    //     echo "guardianESig: ". $guardianSig . "<br>";
    //     echo "guardianSigDate: ". $guardianSigDate . "<br>";
    //     */
        

    //     if(empty($participantDOB)){
    //         $_SESSION['message'] = "<div class='alert'>Sorry, either you forgot to add your Date of Birth or you aren't old enough. Note: Only participants turning $minAge this year or older may register.</div>";
    //         include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
    //         exit; 
    //     }

    //     if((empty($eventId) || empty($participantName) || empty($ward) || empty($participantDOB) || empty($email) || empty($primTel) || empty($primTelType) || empty($participantAddress) || empty($participantCity) || empty($participantState) || empty($emergencyContact) || empty($emerPrimTel) || empty($emerPrimTelType) || empty($specialDiet) || empty($allergies) || empty($medication) || empty($chkSelfMedicate) || empty($chronicIllness) || empty($serious) || empty($participantSig) || empty($guardianSig)  || empty($adult)  || empty($contact)  || empty($permission)  || empty($responsibility) || empty($participantESig) || empty($guardianESig))){
    //         $_SESSION['message'] = "<div class='alert'>Please provide information for all empty form fields.</div>";
    //         $validate = true;
    //         include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
    //         exit; 
    //     }

    //     // Insert form data
    //     $regId = regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $adult, $contact, $permission, $responsibility, $participantESig, $participantSigDate, $guardianESig, $guardianSigDate);
    //     //$regId = false; // Testing only

    //     // Validate Insert
    //     // if($regOutcome === 1){
    //     if($regId){            
    //         foreach($events as $event){
    //             if($event['id'] == $eventId) { $eventName = $event['name']; };
    //         }   
    //         //echo $eventName;
    //         $_SESSION['message'] = "<div class='message'>Thanks for registering $participantName.</div>";
    //         $_SESSION['participantid'] = $regId;
    //         $_SESSION['participant'] = $participantName;
    //         $_SESSION['eventid'] = $eventId;
    //         $_SESSION['eventname'] = $eventName;
    //         header('Location: /registration/');
    //         exit;
    //     } else {
    //         $_SESSION['message'] = "<div class='alert'>Sorry, $participantName, but registration failed. Please try again.<br>If the problem persists please contact your Ward Leadership and/or the WebAdmin.</div>";
    //         include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
    //         exit;
    //     }

    //     break;
    case 'backdoor':
        $eventList = buildEventListBackdoor($events);
        // Note: NO BREAK; or EXIT; This allows this setup to continue to the default: case...
    default:
        $eventId = filter_input(INPUT_GET, 'eventId', FILTER_SANITIZE_NUMBER_INT);
        $eventId = checkInt($eventId);
        include $_SERVER['DOCUMENT_ROOT'] . '/view/registration.php';
}

// Redirect script at java level to switch from http to https.
// No longer needed as it is handled in .htaccess rules, but I want to keep a ref. 
// <script>
//     if (window.location.href.substring(0, 8) != "https://") {
//         window.location = location.href.replace(/^http:/, 'https:');
//     }
// </script>


?>