<?php

require_once 'php_action/db_connect.php';


if($_POST){
    //check if form is submitted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPass = $_POST['repeatPass'];

    //check whether the inputs fields are empty
    if(empty($username) || empty($password) || empty($repeatPass) || $password != $repeatPass){
        if($username==""){
            $errors[] = "Username is required";
        }

        if($password == ""){
            $errors[] = "Password is required";
        }

        if($repeatPass == ""){
            $errors[] = "Please repeat password";
        }
        //check whether password repeated correctly
        if($password != $repeatPass){
            $errors[] = "Passwords do not much";
        }

        
    } else {

        //if inputs are persist refer to DB for validation
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $connect->query($sql);

        if($result->num_rows == 1){
            $errors[] = "User already exists";
            

        } else {
            $password = md5($password);
            $sql1 = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $connect->query($sql1);
            $success[] = "Successfully registered";
        }
    }

    $connect->close();

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory Management System</title>
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- bootstrap theme -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-theme.min.css">
    <!-- font awasome -->
    <link rel="stylesheet" type="text/css" href="assets/font_awesome/css/fontawesome.min.css">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="custom/css/custom.css">
    <!-- jquery -->
    <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
    <!-- jqueryui -->
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui/jquery-ui.min.css">
    <script type="text/javascript" src="assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row vertical">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sing Up</h3>
                </div>
                    <div class="panel-body">

                    <div class = "message">
                        <?php 
                        
                        if($errors){
                            foreach($errors as $key => $value) {
                                echo '<div class="alert alert-warning" role="alert">
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    '.$value.'</div>';
                            }
                        }

                        if($success){
                            foreach($success as $key => $value) {
                                echo '<div class="alert alert-success" role="alert">
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    '.$value.'</div>';
                            }
                        }

                        ?>
                    </div>
                        
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="singUpForm">
                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-7">
                                <input type="username" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-7">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repeatPass" class="col-sm-4 control-label">Repeat Password</label>
                                <div class="col-sm-7">
                                <input type="password" class="form-control" id="repeatPass" name="repeatPass" placeholder="Repeat Password">
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-xs-7">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Sign up</button>
                                </div>
                            </div>

                            <div class="text-center">
                                <p>Already have account? <a href="index.php">Login here</a></p>
                            </div>
                        </form>

                    </div>
            </div>
        </div>
        <!-- /col-md-5 -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
    
</body>
</html>