<?php

require_once 'core.php';

$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM category WHERE categories_status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0){
    $activeCategories = "";

    while($row = $result->fetch_array()){
        $categoriesId = $row[0];
        // active
        if($row[2] == 1){
            // active categories
            $activeCategories = "<label class='label label-success'>Available</label>";
        } else {
            // not available categories
            $activeCategories = "<label class='label label-danger'>Not Available</label>";
        }

            $button = '
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"><i class="glyphicon glyphicon-edit"></i> Edit </a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" onclick="removeCategories('.$categoriesId.')"><i class="glyphicon glyphicon-trash"></i> Remove </a></li>
            </ul>
            </div>';

            $output['data'][] = array(
                $row[1],
                $activeCategories,
                $button
            ); 
    } // /while
} // /if num_rows

// /close database connection
$connect->close();

echo json_encode($output);