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
    
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $current_password = stripslashes($_REQUEST['current-password']);
        $new_password = stripslashes($_REQUEST['new-password']);
        
        $query = "SELECT * FROM `Users` WHERE USERNAME='$username' AND PASSWORD_HASH='" . md5($current_password) . "'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $query = "UPDATE `Users` SET PASSWORD_HASH ='" . md5($new_password) . "' WHERE USERNAME='$username' ";
            $result = mysqli_query($link, $query) or die(mysql_error());
            echo "<div>
                    <p>Your new password is $new_password. Kindly remember this for future use.</p>
                    <p class='link'>Click here to <a href='login.php'>Login</a>.</p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click <a href='change-password.php'>here</a> to try again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Change password</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required /><br />
        <input type="password" class="login-input" name="current-password" placeholder="Current Password" required/><br />
        <input type="password" class="login-input" name="new-password" placeholder="New Password" required/><br />
        <input type="submit" name="submit" value="Change password" class="reset-button">
        <p class="link"><a href="login.php">Go to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>