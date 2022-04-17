<?php 

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
    $supplierName = $_POST['editSupplierName'];
    $supplierStatus = $_POST['editSupplierStatus'];
    $supplierId = $_POST['supplierId'];

    $sql = "UPDATE suppliers SET supplier_name = '$supplierName', supplier_active = '$supplierStatus' WHERE supplier_id = '$supplierId'";

    if($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Updated";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while updating the supplier";
    }

    $connect->close();

    echo json_encode($valid);
}