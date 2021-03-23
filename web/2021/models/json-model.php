<?php
/*
 * HHSCAMPS JSON Model
 */

function getEventsJSON($eventYear) {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.events AS e
        WHERE EXTRACT(YEAR FROM e."eventDate") = :eventYear
        ORDER BY e."eventId"';

        $sqlVarArray = array(':eventYear' => $eventYear);

        $stmt = $db->prepare($sql);
        $stmt->execute($sqlVarArray);
        $eventSQL = $stmt->fetchAll();
        $eventSQL = json_encode($eventSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $eventSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function getEquipmentJSON() {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.equipment AS e
        ORDER BY e.category, e.equipmentname';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $equipmentSQL = $stmt->fetchAll();
        $equipmentSQL = json_encode($equipmentSQL);

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $equipmentSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

?>