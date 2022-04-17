<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$supplierId = $_POST['supplierId'];

if($supplierId){

    $sql = "UPDATE suppliers SET supplier_status = 2 WHERE supplier_id = {$supplierId}";

    if($connect->query($sql) === TRUE){

        $valid['success'] = true;
        $valid['messages'] = "Successfully Removed";

    } else {

        $valid['success'] = false;
        $valid['messages'] = "Error while removing the supplier";

    }

    $connect->close();
    echo json_encode($valid);
}



?>