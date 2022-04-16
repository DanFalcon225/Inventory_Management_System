<?php 

//contains database connection and checking whether the user is in system
require_once 'core.php';

//array for passing messages into json format
$valid['success'] = array('success' => false, 'messages' => array());

//scrip to check whether the values entered and insert them to database
if($_POST){
    $supplierName = $_POST['supplierName'];
    $supplierStatus = $_POST['supplierStatus'];

    $sql = "INSERT INTO suppliers (supplier_name, supplier_active, supplier_status) VALUES ('$supplierName', '$supplierStatus', 1)";

    if($connect->query($sql) === TRUE){
        $valid['success'] = true;
        $valid['messages'] = 'Successfully Added';
    } else {
        $valid['success'] = false;
        $valid['messages'] = 'Error while adding the supplier';
    }

    $connect->close();

    echo json_encode($valid);

} // /if $_POST

