<?php 

//contains database connection and checking whether the user is in system
require_once 'core.php';

//array for passing messages into json format
$valid['success'] = array('success' => false, 'messages' => array());

//scrip to check whether the values entered and insert them to database
if($_POST){
    $brandName = $_POST['brandName'];
    $brandStatus = $_POST['brandStatus'];

    $sql = "INSERT INTO brands (brand_name, brand_active, brand_status) VALUES ('$brandName', '$brandStatus', 1)";

    if($connect->query($sql) === TRUE){
        $valid['success'] = true;
        $valid['messages'] = 'Successfully Added';
    } else {
        $valid['success'] = false;
        $valid['messages'] = 'Error while adding the brand';
    }

    $connect->close();

    echo json_encode($valid);

} // /if $_POST

