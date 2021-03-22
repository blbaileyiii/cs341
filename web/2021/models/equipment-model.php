<?php
/*
 * HHSCAMPS Equipment Model
 */

function getEquipment() {
    try {
        $db = hhConnect();

        $sql = 
        'SELECT *
        FROM hhstake.equipment AS e
        ORDER BY e.category, e.equipmentname';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $equipmentSQL = $stmt->fetchAll();

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $equipmentSQL;

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