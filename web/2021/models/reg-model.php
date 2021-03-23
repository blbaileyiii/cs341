<?php
/*
 * HHSCAMPS Registration Model
 */

// Will handle site registrations.
function regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate, $participantESig, $guardianESig){
    try {
        // Create a connection object using the phpmotors connection function
        $db = hhConnect();
        // The SQL statement

        $sql = 
        'INSERT INTO hhstake.registrants ("eventId", "participantName", "ward", "participantDOB", "participantAge", "email", "primTel", "primTelType", "secTel", "secTelType", "participantAddress", "participantCity", "participantState", "emergencyContact", "emerPrimTel", "emerPrimTelType", "emerSecTel", "emerSecTelType", "specialDiet", "specialDietTxt", "allergies", "allergiesTxt", "medication", "selfMedicate", "medicationList", "chronicIllness", "chronicIllnessTxt", "serious", "seriousTxt", "limitations", "considerations", "participantSig", "participantSigDate", "guardianSig", "guardianSigDate", "participantESig", "guardianESig")
        VALUES (:eventId, :participantName, :ward, :participantDOB, :participantAge, :email, :primTel, :primTelType, :secTel, :secTelType, :participantAddress, :participantCity, :participantState, :emergencyContact, :emerPrimTel, :emerPrimTelType, :emerSecTel, :emerSecTelType, :specialDiet, :specialDietTxt, :allergies, :allergiesTxt, :medication, :selfMedicate, :medicationList, :chronicIllness, :chronicIllnessTxt, :serious, :seriousTxt, :limitations, :considerations, :participantSig, :participantSigDate, :guardianSig, :guardianSigDate, :participantESig, :guardianESig)
        RETURNING "registrantId"';
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
            ':participantESig' => $participantESig,
            ':guardianESig' => $guardianESig
        );
        // Insert the data
        $stmt->execute($sqlVarArray);
        // Ask how many rows changed as a result of our insert
        $regResults = $stmt->fetchAll();
        if (count($regResults === 0)){
            $regId = $regResults[0]['registrantId'];            
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