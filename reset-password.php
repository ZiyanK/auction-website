<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <style>
        input {
            margin: 0.5em 0.25em;
        }
    </style>
</head>
<body>
<?php
    require('config.php');

    function generatePassword() { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*'; 
        $randomString = ''; 
        for ($i = 0; $i < 10; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    } 
    
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $phone = stripslashes($_REQUEST['phone']);
        $query = "SELECT * FROM `Users` WHERE USERNAME='$username' AND PHONE='$phone' ";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $newPassword = generatePassword();
            $query = "UPDATE `Users` SET PASSWORD_HASH ='" . md5($newPassword) . "' WHERE USERNAME='$username' ";
            $result = mysqli_query($link, $query) or die(mysql_error());
            echo "<div>
                    <p>Your new password is $newPassword. Kindly remember this for future use.</p>
                    <p class='link'>Click here to <a href='login.php'>Login</a>.</p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>No user exists with given username and phone number</h3><br/>
                  <p class='link'>Click here to <a href='reset-password.php'>reset</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Reset password</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required /><br />
        <input type="text" class="login-input" name="phone" placeholder="Phone number" required><br />
        <input type="submit" name="submit" value="Reset password" class="reset-button">
        <p class="link"><a href="login.php">Go to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>