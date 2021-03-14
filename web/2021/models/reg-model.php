<?php
/*
 * PHP Motors Accounts Model
 */

function getEvents($eventYear) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.events
        WHERE EXTRACT(YEAR FROM e."eventDate") = :eventYear';

        $sqlVarArray = array(':eventYear' => $eventYear);

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $eventSQL = $stmt->fetchAll();
        var_dump($eventSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $eventSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

// Will handle site registrations.
function regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $participantSig, $participantSigDate, $guardianSig, $guardianSigDate){
    try {
        // Create a connection object using the phpmotors connection function
        $db = hhConnect();
        // The SQL statement

        $sql = 
        'INSERT INTO hhstake.registrants ("eventId", "participantName", "ward", "participantDOB", "participantAge", "primTel", "primTelType", "secTel", "secTelType", "participantAddress", "participantCity", "participantState", "emergencyContact", "emerPrimTel", "emerPrimTelType", "emerSecTel", "emerSecTelType", "specialDiet", "specialDietTxt", "allergies", "allergiesTxt", "medication", "selfMedicate", "medicationList", "chronicIllness", "chronicIllnessTxt", "serious", "seriousTxt", "limitations", "considerations", "participantSig", "participantSigDate", "guardianSig", "guardianSigDate")
        VALUES (:eventId, :participantName, :ward, :participantDOB, :participantAge, :primTel, :primTelType, :secTel, :secTelType, :participantAddress, :participantCity, :participantState, :emergencyContact, :emerPrimTel, :emerPrimTelType, :emerSecTel, :emerSecTelType, :specialDiet, :specialDietTxt, :allergies, :allergiesTxt, :medication, :selfMedicate, :medicationList, :chronicIllness, :chronicIllnessTxt, :serious, :seriousTxt, :limitations, :considerations, :participantSig, :participantSigDate, :guardianSig, :guardianSigDate)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // Build var array
        $sqlVarArray = array(
            ':eventId' => $eventId,
            ':participantName' => $participantName,
            ':ward' => $ward,
            ':participantDOB' => $participantDOB,
            ':participantAge' => $participantAge,
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
            ':guardianSigDate' => $guardianSigDate
        );
        // Insert the data
        $stmt->execute($sqlVarArray);
        // Ask how many rows changed as a result of our insert
        $regOutcome = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $regOutcome;
    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}
?>