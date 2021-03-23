<?php
/*
 * HHSCAMPS Registration Model
 */

// Will handle site registrations.
function regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate, $adult, $contact, $permission, $responsibility, $participantESig, $guardianESig){
    try {
        // Create a connection object using the phpmotors connection function
        $db = hhConnect();
        // The SQL statement

        $sql = 
        'INSERT INTO hhstake.registrants (event_id, p_name, p_ward, p_dob, p_age, email, tele_one, tele_one_type, tele_two, tele_two_type, p_address, p_city, p_state, emer_name, emer_tele_one, emer_tele_one_type, emer_tele_two, emer_tele_two_type, diet, diet_txt, allergies, allergies_txt, medication, self_medicate, medication_txt, chronic, chronic_txt, serious, serious_txt, limitations_txt, considerations_txt, p_sig, p_sig_date, g_sig, g_sig_date, adult, contact, permission, responsibility, p_esig, g_esig)
        VALUES (:eventId, :participantName, :ward, :participantDOB, :participantAge, :email, :primTel, :primTelType, :secTel, :secTelType, :participantAddress, :participantCity, :participantState, :emergencyContact, :emerPrimTel, :emerPrimTelType, :emerSecTel, :emerSecTelType, :specialDiet, :specialDietTxt, :allergies, :allergiesTxt, :medication, :selfMedicate, :medicationList, :chronicIllness, :chronicIllnessTxt, :serious, :seriousTxt, :limitations, :considerations, :participantSig, :participantSigDate, :guardianSig, :guardianSigDate, :adult, :contact, :permission, :responsibility, :participantESig, :guardianESig)
        RETURNING id';

        //VALUES ($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate, $adult, $contact, $permission, $responsibility, $participantESig, $guardianESig)
        //RETURNING id";
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // Build var array
        
        $sqlVarArray = array(
            ':eventId' => $eventId,
            ':participantName' => $participantName,
            ':ward' => $ward,
            ':participantDOB' => $participantDOB,
            ':participantAge' => $participantAge,
            ':email' => $email,
            ':primTel' => $primTel,
            ':primTelType' => $primTelType,
            ':secTel' => $secTel,
            ':secTelType' => $secTelType,
            ':participantAddress' => $participantAddress,
            ':participantCity' => $participantCity,
            ':participantState' => $participantState,
            ':emergencyContact' => $emergencyContact,
            ':emerPrimTel' => $emerPrimTel,
            ':emerPrimTelType' => $emerPrimTelType,
            ':emerSecTel' => $emerSecTel,
            ':emerSecTelType' => $emerSecTelType,
            ':specialDiet' => $specialDiet,
            ':specialDietTxt' => $specialDietTxt,
            ':allergies' => $allergies,
            ':allergiesTxt' => $allergiesTxt,
            ':medication' => $medication,
            ':selfMedicate' => $selfMedicate,
            ':medicationList' => $medicationList,
            ':chronicIllness' => $chronicIllness,
            ':chronicIllnessTxt' => $chronicIllnessTxt,
            ':serious' => $serious,
            ':seriousTxt' => $seriousTxt,
            ':limitations' => $limitations,
            ':considerations' => $considerations,
            ':participantSig' => $participantSig,
            ':participantSigDate' => $participantSigDate,
            ':guardianSig' => $guardianSig,
            ':guardianSigDate' => $guardianSigDate,
            ':adult' => $adult,
            ':contact' => $contact,
            ':permission' => $permission,
            ':responsibility' => $responsibility,
            ':participantESig' => $participantESig,
            ':guardianESig' => $guardianESig
        );
        
        // Insert the data
        $stmt->execute($sqlVarArray);
        //$stmt->execute();
        // Ask how many rows changed as a result of our insert
        $regResults = $stmt->fetchAll();
        if (count($regResults === 0)){
            $regId = $regResults[0]['id'];            
        } else {
            $regId = NULL;
        }
        
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        //return $regOutcome;
        return $regId;
    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}
?>