<?php
    session_start();
    if(session_destroy()) {
        $_SESSION['loggedin'] = FALSE;
        setcookie("user", "", time() - 3600);
        header("Location: login.php");
    }
?>