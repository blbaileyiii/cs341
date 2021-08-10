<?php
/*
 * Master Controller
 */
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/connections.php';
// Get validation, etc fx
require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/fx.php';
// Get the registration model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/query-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'getEvents':
        // GET
        $unlocked = false;
        echo getEventsJSON();
        break;
    case 'getEquipment':
        // GET
        $reg_id = filter_input(INPUT_GET, 'reg_id', FILTER_SANITIZE_NUMBER_INT);
        $reg_id = checkInt($reg_id);
        
        //IF REG_ID IS NULL THAT IS OK.
        echo getEquipmentJSON($reg_id);
        break;
    case 'getItems':
        // GET
        $reg_id = filter_input(INPUT_GET, 'reg_id', FILTER_SANITIZE_NUMBER_INT);
        $reg_id = checkInt($reg_id);
        
        echo getInventoryByPId($reg_id);
        
        break;
    case 'getParticipant':
        // GET
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $id = checkInt($id);

        echo getParticipantById($id);
        break;
    case 'getParticipants':
        // GET
        //$ids = filter_input(INPUT_GET, 'ids', FILTER_SANITIZE_STRING);
        $ids = array();

        foreach($_GET['ids'] as $id){
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                array_push($ids, $id);
            }
        }
        echo getParticipantsByIds($ids);
        break;
    case 'getRegistrants':
        // Similar to getParticipants but a master list...
        echo getRegistrants();
        break;
    case 'getSig':
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);

        if(empty($id || empty($type))){
            exit;
        }

        if($type == 'p' || $type =='g'){
            getSig($id, $type);
        } else {
            exit;
        }

        // Add the appropriate line to the position to call...
        // <img src="https://www.hhscamps.com/query/?action=getSig&id=224&type=p">
        // <img src="https://www.hhscamps.com/query/?action=getSig&id=224&type=g">

        
        break;
    case 'postItem':
        // POST
        // ?SECURE THIS BY CREATING THE SESSION VARIABLE TO MATCH THE LOCALSTORAGE ARRAY?
        $reg_id = filter_input(INPUT_POST, 'reg_id', FILTER_SANITIZE_NUMBER_INT);
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
        $owned = filter_input(INPUT_POST, 'owned', FILTER_SANITIZE_STRING);
        $pur_price = filter_input(INPUT_POST, 'pur_price', FILTER_SANITIZE_NUMBER_FLOAT);
        
        $reg_id = checkInt($reg_id);
        $item_id = checkInt($item_id);
        $owned = checkBool($owned);
        $pur_price = checkFloat($pur_price);

        if(empty($reg_id) || empty($item_id) || empty($owned)){
            $returnSQL = "{}";
            echo json_encode($returnSQL);
            exit;
        }
        echo postItemJSON($reg_id, $item_id, $owned, $pur_price);
        break;
    case 'postCheckedIn':
        $p_id = filter_input(INPUT_POST, 'p_id', FILTER_SANITIZE_NUMBER_INT);
        $isChecked = filter_input(INPUT_POST, 'isChecked', FILTER_SANITIZE_STRING);

        $p_id = checkInt($p_id);
        $isChecked = checkBool($isChecked);

        // echo json_encode("{'p_id': $p_id, 'checked': $isChecked}");

        if(empty($p_id) || empty($isChecked)){
            $returnSQL = "{}";
            echo json_encode($returnSQL);
            exit;
        }
        echo postCheckedIn($p_id, $isChecked);
        break;
    case 'postReviewed':
        $p_id = filter_input(INPUT_POST, 'p_id', FILTER_SANITIZE_NUMBER_INT);
        $reviwed = filter_input(INPUT_POST, 'reviwed', FILTER_SANITIZE_STRING);

        $p_id = checkInt($p_id);
        $reviewed = checkBool($reviewed);

        // echo json_encode("{'p_id': $p_id, 'reviewed': $reviewed}");
        
        if(empty($p_id) || empty($reviewed)){
            $returnSQL = "{}";
            echo json_encode($returnSQL);
            exit;
        }
        echo postReviewed($p_id, $reviewed);
        break;

    default:
        break;
}
?>