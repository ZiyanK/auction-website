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
        $password = stripslashes($_REQUEST['password']);
        $phone = stripslashes($_REQUEST['phone']);
        $query = "INSERT into `Users` (USERNAME, PASSWORD_HASH, PHONE) VALUES ('$username', '" . md5($password) . "', '$phone')";
        $result   = mysqli_query($link, $query);
        if ($result) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = TRUE;
            header("Location: main.php");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required /><br />
        <input type="text" class="login-input" name="phone" placeholder="Phone number" required><br />
        <input type="password" class="login-input" name="password" placeholder="Password" required><br />
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>
