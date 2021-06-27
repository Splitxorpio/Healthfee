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
            <form action="register.php" method="POST">
                <h1>Create an account</h1>

                <div class="input_fields">
                    <div class="name">
                        <input name="f_name" type="text" placeholder="First Name" />
                        <input name="l_name" type="text" placeholder="Last Name" />
                    </div>


                    <input name="email" type="text" placeholder="Email" />
                    <input name="password" type="password" placeholder="password" />
                    <button name="register" type="submit">Register</input>
                </div>
            </form>

            <div class="options">
                <p>Already have an account?</p>
                <a href="login.php">Login</a>
            </div>
        </div>


    </div>
</body>

</html>