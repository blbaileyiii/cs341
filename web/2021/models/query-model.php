<?php
/*
 * HHSCAMPS JSON Model
 */

function getParticipantById($id) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.registrants AS p
        WHERE p.id = :id
        ORDER BY p.id';

        $sqlVarArray = array(
            ':id' => $id
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getParticipantsByIds($ids) {
    $len = count($ids);

    $idArr = array();
    for($i = 0; $i < $len; $i++){
        $idArr[] = ":id$i";
    }

    try {
        $db = hhConnect();

        $sql = 
        'SELECT p.id,p.event_id
        FROM hhstake.registrants AS p
        WHERE p.id IN ('.implode(',', $idArr) .')
        ORDER BY p.id';

        $sqlVarArray = array();
        for($i = 0; $i < $len; $i++){
            $sqlVarArray[":id$i"] = $ids[$i];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        //var_dump($ids);
        echo "<br>" . $sql . "<br>" . $ex->getMessage();
    }
}

function getRegistrants() {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT e.name, r.p_ward, r.p_name, r.p_age, r.email, r.tele_one, r.tele_one_type, r.emer_name, r.emer_tele_one, r.emer_tele_one_type, r.inactivated
        FROM hhstake.registrants AS r
        LEFT JOIN hhstake.events AS e ON r.event_id = e.id
        ORDER BY e.name, r.p_ward, r.p_name';
        // WHERE r.inactivated = false

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getPaperwork($event) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT e.id AS "eventid", e.key AS "event_key", e.name AS "event_name", e.date_start, e.date_end, e.desc AS "event_desc", e.stake, e.l_name, e.l_phone, e.l_email, e.meet_time, e.meet_loc, e.camp_name, e.camp_address, e.camp_city, e.camp_state, e.camp_zip, e."min_DOB", r.id AS "p_id", r.event_id, r.p_name, r.paid, r.p_ward, r.p_dob, r.p_age, r.email, r.tele_one, r.tele_one_type, r.tele_two, r.tele_two_type, r.p_address, r.p_city, r.p_state, r.emer_name, r.emer_tele_one, r.emer_tele_one_type, r.emer_tele_two, r.emer_tele_two_type, r.diet, r.diet_txt, r.allergies, r.allergies_txt, r.medication, r.self_medicate, r.medication_txt, r.chronic, r.chronic_txt, r.serious, r.serious_txt, r.limitations_txt, r.considerations_txt, r.p_sig, r.p_sig_date, r.g_sig, r.g_sig_date, r.adult, r.contact, r.permission, r.responsibility, r.p_esig, r.g_esig, r.created
        FROM hhstake.registrants AS r
        LEFT JOIN hhstake.events AS e ON r.event_id = e.id
        WHERE e.key = :event AND r.inactivated = false
        ORDER BY e.name, r.p_ward, r.p_name';

        $sqlVarArray = array(
            ':event' => $event
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getEventsJSON($eventYear) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.events AS e
        WHERE EXTRACT(YEAR FROM e.date_start) = :eventYear
        ORDER BY e.id';

        $sqlVarArray = array(':eventYear' => $eventYear);

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getEquipmentJSON($reg_id) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT e.category, e.ywcamp, e.ymcamp, e.trek, i.owned, e.id, e.quantity, e.name, e.avg_price, i.pur_price 
        FROM hhstake.equipment AS e
        LEFT JOIN hhstake.inventory AS i ON e.id = i.item_id AND i.reg_id = :reg_id
        ORDER BY e.category, e.name';
        /*
        'SELECT *
        FROM hhstake.equipment AS e
        ORDER BY e.category, e.name';
        */

        $sqlVarArray = array(
            ':reg_id' => $reg_id
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getInventoryByPId($reg_id) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.inventory AS i
        WHERE i.reg_id = :reg_id
        ORDER BY i.reg_id';

        $sqlVarArray = array(
            ':reg_id' => $reg_id
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function postItemJSON($reg_id, $item_id, $owned, $pur_price) {
    try {
        $db = hhConnect();

        $sql = 
        'INSERT INTO hhstake.inventory (reg_id, item_id, owned, pur_price)
        VALUES (:reg_id, :item_id, :owned, :pur_price)
        ON CONFLICT ON CONSTRAINT uq_reg_id_item_id
        DO UPDATE
        SET reg_id = :reg_id,
            item_id = :item_id,
            owned = :owned,
            pur_price = :pur_price';
        
        $sqlVarArray = array(
            ':reg_id' => $reg_id,
            ':item_id' => $item_id,
            ':owned' => $owned,
            ':pur_price' => $pur_price
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->rowCount();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        //echo $sql . "<br>" . $ex->getMessage();
    }
}

function postESig2($img) {

    try {
        $db = hhConnect();

        $sql = 
        'INSERT INTO hhstake.esig (img)
        VALUES (:img)';
        
        $sqlVarArray = array(
            ':img' => $img
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->rowCount();
        $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        // echo $sql . "<br>" . $ex->getMessage();
    }

}

function postESig(){
    try {
        $db = hhConnect();

        $pathToFile = $_SERVER['DOCUMENT_ROOT'] . '/2021/images/gw2.jpg';
        $mimeType = 'image/jpg';
        $fileName = 'gw2.jpg';

        if (!file_exists($pathToFile)) {
            throw new \Exception("File %s not found.");
        }

        $sql = 
        'INSERT INTO hhstake.esig(mime_type,file_name,file_data)
        VALUES(:mime_type,:file_name,:file_data)';

        $db->beginTransaction();
        
        // create large object
        $fileData = $db->pgsqlLOBCreate();
        $stream = $db->pgsqlLOBOpen($fileData, 'w');
        
        // read data from the file and copy the the stream
        $fh = fopen($pathToFile, 'rb');
        stream_copy_to_stream($fh, $stream);
        //
        $fh = null;
        $stream = null;

        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':mime_type' => $mimeType,
            ':file_name' => $fileName,
            ':file_data' => $fileData,
        ]);

        // commit the transaction
        $db->commit();
    } catch (\Exception $e) {
        $db->rollBack();
        throw $e;
    }

    return $db->lastInsertId('esig_id_seq');
    
}

function getESig($id) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT img
        FROM hhstake.esig AS e
        WHERE e.id = :id
        ORDER BY e.id';

        $sqlVarArray = array(
            ':id' => $id
        );

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $returnSQL = $stmt->fetchAll();
        // $returnSQL = json_encode($returnSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $returnSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

/* NOTES:
INSERT INTO the_table (id, column_1, column_2) 
VALUES (1, 'A', 'X'), (2, 'B', 'Y'), (3, 'C', 'Z')
ON CONFLICT (id) DO UPDATE 
  SET column_1 = excluded.column_1, 
      column_2 = excluded.column_2;
*/

?>