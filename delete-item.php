<?php
include("config.php");
include("session.php");
$item = $_GET["itemname"];
$owner = $_GET["itemowner"];
$user = $_SESSION['username'];
$error = "";
$success = "";

if($owner == $user) {
    $sql = "DELETE FROM `auction` WHERE itemname='$item' AND itemowner='$owner'";
    $result = mysqli_query($link,$sql);
    if($result) {
        echo "Item deleted!<br/>";
        echo "<a href='showmyitems.php'>Go back</a>";
    } else {
        echo "Something went wrong<br/>";
        echo "<a href='showmyitems.php'>Go back</a>";
    }
}
?>
