<?php

require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])){
    header('location: http://localhost/daniilss18019262_project/dashboard.php');
 }

$errors = array();

if($_POST){
    //check if form is submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check whether the inputs fields are empty
    if(empty($username) || empty($password)){
        if($username==""){
            $errors[] = "Username is required";
        }

        if($password == ""){
            $errors[] = "Password is required";
        }
    } else {

        //if inputs are persist refer to DB for validation
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $connect->query($sql);

        if($result->num_rows == 1){
            $password = md5($password);
            //exists
            $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $mainResult = $connect->query($mainSql);

            if($mainResult -> num_rows == 1){
                $value = $mainResult->fetch_assoc();
                $user_id = $value['user_id'];

                // set session
                $_SESSION['userId'] = $user_id;

                header('location: http://localhost/daniilss18019262_project/dashboard.php');

            } else {
                $errors[] = "Incorrect username/password";
            }

        } else {
            $errors[] = "Username does not exists";
        }
    }

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
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sing In</h3>
                </div>
                    <div class="panel-body">

                    <div class = "message">
                        <?php if($errors){
                            foreach($errors as $key => $value) {
                                echo '<div class="alert alert-warning" role="alert">
                                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                                    '.$value.'</div>';
                            }
                        }


                        ?>
                    </div>
                        
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="loginForm">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                <input type="username" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-xs-6">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i> Sign in</button>
                                </div>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Do not have account? <a href="registrationForm.php">Register</a></p>
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