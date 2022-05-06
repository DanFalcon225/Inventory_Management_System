<?php 

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];
    $brandName = $_POST['brandName'];
    $categoryName = $_POST['categoryName'];
    $supplierName = $_POST['supplierName'];
    $productStatus = $_POST['productStatus'];

    //for product image

    $type = explode('.', $_FILES['productImage']['name']);
    $type = $type[count($type) - 1];
    $url = '../assets/images/stock/'.uniqid(rand()).'.'.$type;

    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))){
        if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {
            if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {

                //insert into database
                $sql = "INSERT INTO products (product_name, product_image, brand_id, categories_id, supplier_id, quantity, rate, active, status) 
				VALUES ('$productName', '$url', '$brandName', '$categoryName', $supplierName, '$quantity', '$rate', '$productStatus', 1)";

                if($connect->query($sql) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Added";
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while adding the product";
                }
                
            } else {
                return false;
            }
        }
    }

    // close connection with database
    $connect->close();
    echo json_encode($valid);

} // /if $_POST

