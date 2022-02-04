<?php
// Include config file

include('server.php');
include('header.php');
 
?>
 
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .login-form {
        width: 340px;
        margin: 50px auto;
        font-size: 15px;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    </style>
</head>
<body>
        <div class="login-form">
            <form method="post" action="register.php"> 
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>

                <?php include('errors.php'); ?>
                <div class="form-group mb-2">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="email" class="form-control" placeholder="Email" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="password" name="password_1" class="form-control" placeholder="Password" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="password" name="password_2" class="form-control" placeholder="Confirm Password" required="required">
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="reg_user">Register</button>
                
                </div>  
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
             </form>
        </div>    
</body>
</html>