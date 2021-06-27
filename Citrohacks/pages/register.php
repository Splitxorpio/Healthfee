<?php
include "db.php";
if (isset($_POST['register'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "INSERT INTO users (email, first_name, last_name, password) VALUES ('$email','$fname','$lname','$password')";
    mysqli_query($conn, $sql);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <ul>
        <div>
            <a href="index.php">
                <img style="height: 75px; width: 75px;" src="../images/logo.png">
            </a>
        </div>
        <div class="nav_link">

        </div>
    </ul>
    <div class="signup_container">
        <div class="form_container">
            <form style="text-align: center;">
                <div class="input_fields">
                    <h1>Congrats! You are registered! Go below and log in!</h1>
                </div>
            </form>
            <div class="options">
                <p>You are now registered!</p>
                <a href="login.php">Login</a>
            </div>
        </div>


    </div>
</body>

</html>