<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthFee</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signup.css">
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
            <form action="process.php" method="POST" autocomplete="off">
                <h1>Login</h1>
                <p style="color: red;">Wrong Username or Email</p>
                <div class="login_input_fields">
                    <input name="email" type="text" placeholder="Email" />
                    <input name="password" type="password" placeholder="password" />
                    <button type="submit">Login</input>
                </div>
            </form>

            <div class="options">
                <p>Don't have an account?</p>
                <a href="signup.php">Register</a>
            </div>
        </div>


    </div>
</body>

</html>