<?php
/*
 * HHSCAMPS Registration Model
 */

// TODO ENSURE THAT REGISTRATION IS NOT LOCKED PRIOR TO ALLOWING INSERT...

// Will handle site registrations.
function regParticipant($eventId, $participantName, $ward, $participantDOB, $participantAge, $email, $primTel, $primTelType, $secTel, $secTelType, $participantAddress, $participantCity, $participantState, $emergencyContact, $emerPrimTel, $emerPrimTelType, $emerSecTel, $emerSecTelType, $specialDiet, $specialDietTxt, $allergies, $allergiesTxt, $medication, $selfMedicate, $medicationList, $chronicIllness, $chronicIllnessTxt, $serious, $seriousTxt, $limitations, $considerations, $adult, $contact, $permission, $responsibility, $participantESig, $participantSigDate, $guardianESig, $guardianSigDate){
    try {
        // Create a connection object using the phpmotors connection function
        $db = hhConnect();

        $hostname = gethostname();

        // The SQL statement
        $sql = 
        'INSERT INTO hhstake.registrants (event_id, p_name, p_ward, p_dob, p_age, email, tele_one, tele_one_type, tele_two, tele_two_type, p_address, p_city, p_state, emer_name, emer_tele_one, emer_tele_one_type, emer_tele_two, emer_tele_two_type, diet, diet_txt, allergies, allergies_txt, medication, self_medicate, medication_txt, chronic, chronic_txt, serious, serious_txt, limitations_txt, considerations_txt, adult, contact, permission, responsibility)
        VALUES (:eventId, :participantName, :ward, :participantDOB, :participantAge, :email, :primTel, :primTelType, :secTel, :secTelType, :participantAddress, :participantCity, :participantState, :emergencyContact, :emerPrimTel, :emerPrimTelType, :emerSecTel, :emerSecTelType, :specialDiet, :specialDietTxt, :allergies, :allergiesTxt, :medication, :selfMedicate, :medicationList, :chronicIllness, :chronicIllnessTxt, :serious, :seriousTxt, :limitations, :considerations, :adult, :contact, :permission, :responsibility)
        RETURNING id';

        // 'INSERT INTO hhstake.registrants (event_id, p_name, p_ward, p_dob, p_age, email, tele_one, tele_one_type, tele_two, tele_two_type, p_address, p_city, p_state, emer_name, emer_tele_one, emer_tele_one_type, emer_tele_two, emer_tele_two_type, diet, diet_txt, allergies, allergies_txt, medication, self_medicate, medication_txt, chronic, chronic_txt, serious, serious_txt, limitations_txt, considerations_txt, adult, contact, permission, responsibility, p_esig, p_esig_date, g_esig, g_esig_date, userhost)
        // VALUES (:eventId, :participantName, :ward, :participantDOB, :participantAge, :email, :primTel, :primTelType, :secTel, :secTelType, :participantAddress, :participantCity, :participantState, :emergencyContact, :emerPrimTel, :emerPrimTelType, :emerSecTel, :emerSecTelType, :specialDiet, :specialDietTxt, :allergies, :allergiesTxt, :medication, :selfMedicate, :medicationList, :chronicIllness, :chronicIllnessTxt, :serious, :seriousTxt, :limitations, :considerations, :adult, :contact, :permission, :responsibility, :participantESig, :participantSigDate, :guardianESig, :guardianSigDate, :userhost)
        // RETURNING id';

        $db->beginTransaction();

        // create large object
        $pESigData = $db->pgsqlLOBCreate();
        $stream = $db->pgsqlLOBOpen($pESigData, 'w');
        
        // read data from the file and copy the the stream
        $fh = fopen($participantESig, 'rb');
        stream_copy_to_stream($fh, $stream);
        //
        $fh = null;
        $stream = null;

        // create large object
        $gESigData = $db->pgsqlLOBCreate();
        $stream = $db->pgsqlLOBOpen($gESigData, 'w');
        
        // read data from the file and copy the the stream
        $fh = fopen($guardianESig, 'rb');
        stream_copy_to_stream($fh, $stream);
        //
        $fh = null;
        $stream = null;

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // Build var array
        
        // $sqlVarArray = array(
        //     ':eventId' => $eventId,
        //     ':participantName' => $participantName,
        //     ':ward' => $ward,
        //     ':participantDOB' => $participantDOB,
        //     ':participantAge' => $participantAge,
        //     ':email' => $email,
        //     ':primTel' => $primTel,
        //     ':primTelType' => $primTelType,
        //     ':secTel' => $secTel,
        //     ':secTelType' => $secTelType,
        //     ':participantAddress' => $participantAddress,
        //     ':participantCity' => $participantCity,
        //     ':participantState' => $participantState,
        //     ':emergencyContact' => $emergencyContact,
        //     ':emerPrimTel' => $emerPrimTel,
        //     ':emerPrimTelType' => $emerPrimTelType,
        //     ':emerSecTel' => $emerSecTel,
        //     ':emerSecTelType' => $emerSecTelType,
        //     ':specialDiet' => $specialDiet,
        //     ':specialDietTxt' => $specialDietTxt,
        //     ':allergies' => $allergies,
        //     ':allergiesTxt' => $allergiesTxt,
        //     ':medication' => $medication,
        //     ':selfMedicate' => $selfMedicate,
        //     ':medicationList' => $medicationList,
        //     ':chronicIllness' => $chronicIllness,
        //     ':chronicIllnessTxt' => $chronicIllnessTxt,
        //     ':serious' => $serious,
        //     ':seriousTxt' => $seriousTxt,
        //     ':limitations' => $limitations,
        //     ':considerations' => $considerations,
        //     ':adult' => $adult,
        //     ':contact' => $contact,
        //     ':permission' => $permission,
        //     ':responsibility' => $responsibility,
        //     ':participantESig' => $pESigData,
        //     ':participantSigDate' => $participantSigDate,
        //     ':guardianESig' => $gESigData,
        //     ':guardianSigDate' => $guardianSigDate,
        //     ':userhost' => $hostname
        // );

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
            ':adult' => $adult,
            ':contact' => $contact,
            ':permission' => $permission,
            ':responsibility' => $responsibility
        );
        
        // Insert the data
        $stmt->execute($sqlVarArray);
        //$stmt->execute();
        
        // commit the transaction
        $db->commit();

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