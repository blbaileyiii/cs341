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
        $eventSQL = $stmt->fetchAll();

        // The next line closes the interaction with the database 
        $stmt->closeCursor();

        return $eventSQL;

    } catch(PDOException $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

?>