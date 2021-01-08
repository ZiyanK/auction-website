
<?php
include("config.php");
include("session.php");
$item = $_GET["itemname"];
$owner = $_GET["itemowner"];
$user = $_SESSION['username'];
$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$bid = $_POST['bid'];
	
	$query = "SELECT itembid FROM `auction` WHERE itemname='$item' AND itemowner='$owner'";
	$res = mysqli_query($link, $query);

	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);

	$max_bid = array_values($row)[0];
		
	if($bid > $max_bid) {
		$sql = "UPDATE `auction` SET itembid='$bid', itembidder='$user'  WHERE itemname='$item' AND itemowner='$owner'";
		$result = mysqli_query($link,$sql);
		if($result) {
			$success="Bid Added!";
		} else {
			$error="Something went wrong";
			echo $result;
		}
	} else {
		$error="Enter a bid larger than $max_bid";
	}
}

?>
<html>
<head>
	<title>Add Bid</title>
</head>
<body>
	<form action = "" method="post">
		<h3>Add Bid for: <?php echo $item ?></h3><br>
        <label>Enter bid: </label>
		<input type="number" name="bid" required/><br>
		<input type="submit" value="Bid"/>
	</form>
		<div><?php echo $error; ?></div>
		<div><?php echo $success; ?></div>
		<a href="main.php">Go to main page</a>
	<br>
</body>
</html>
