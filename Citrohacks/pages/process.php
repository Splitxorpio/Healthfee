<?php
session_start();
include 'db.php';
$email = $_POST['email'];
$password = $_POST['password'];


$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' and password = '$password'")
    or die("Failed to query database" . mysqli_error($link));
$row = mysqli_fetch_array($result);

// echo "<script>localStorage.setItem('user' , JSON.stringify({ email: '$email', password: '$password' }))</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <form style="text-align: center; display: flex; flex-direction: column; align-items:center; justify-content:center;">
                <img style="width: 75px; height: 75px; border-radius: 100px; border: 2px solid #E66677; padding: 15px;" src="https://avatars.dicebear.com/api/bottts/<?php echo $row['email'] ?>.svg" alt="" />
                <div class="input_fields">
                    <h1>
                        <?php
                        if ($row['email'] == $email && $row['password'] == $password) {
                            echo $row['email'];
                        } else {
                            header('location: wronglogin.php');
                        }
                        ?>
                    </h1>
                    <br>
                    <hr>
                    <br>
                    <h1 id="location">
                        <?php 
                        function getUserIpAddr()
                        {
                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                //ip from share internet
                                $ip = $_SERVER['HTTP_CLIENT_IP'];
                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                //ip pass from proxy
                                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                            } else {
                                $ip = $_SERVER['REMOTE_ADDR'];
                                
                            }
                            return $ip;
                        }

                        // echo getUserIpAddr();
                        $myip =  getUserIpAddr();
                        $data =  unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$myip"));

                        echo $data['geoplugin_city'].', '.$data['geoplugin_countryName']; 
                        ?>
                    </h1>
                    <br>
                    <hr>
                    <br>
                    <a class="mapp" href="closest.php">Find Hospitals/Pharmacies near your location!</a>
                </div>
            </form>
            <div class="options">
                <p>Done for today?</p>
                <a href="index.php">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>