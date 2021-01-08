<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <style>
        input {
            margin: 0.5em 0.25em;
        }
    </style>
</head>
<body>
<?php
    require('config.php');
    session_start();
    if (isset($_POST['username'])) {
        echo $_POST['username'];
        $username = stripslashes($_REQUEST['username']);
        $password = stripslashes($_REQUEST['password']);

        $query = "SELECT * FROM `Users` WHERE USERNAME='$username' AND PASSWORD_HASH='" . md5($password) . "'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            echo $username;
            $_SESSION['username'] = $username;
            header("Location: main.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/><br />
        <input type="password" class="login-input" name="password" placeholder="Password"/><br />
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="signup.php">Go to Sign up</a></p>
        <p class="link"><a href="reset-password.php">Reset password</a></p>
        <p class="link"><a href="change-password.php">Change password</a></p>
    </form>
<?php
    }
?>
</body>
</html>