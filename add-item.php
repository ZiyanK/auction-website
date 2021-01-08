<?php
	include("session.php");
	include("config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		
		$item = $_POST['item'];
		$close = $_POST['closedate']; 
		$user = $_SESSION['username'];

		$sql = "INSERT INTO `auction` VALUES('$item','$user', 0, '', '$close')";
		
		$result = mysqli_query($link,$sql);
		
		if($result) {
			echo "Item Successfully Added";
		}  
		else {
			echo "An error occured.";
		} 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add item</title>
</head>
<body>
    <form action="" method="POST">
        <h3>Add an Item</h3>
        <input type="text" name="item" placeholder="Item Name" required/>
        <input type="date" name="closedate" required/>
        <input type="submit" value="ADD"/>
    </form>
	<a href="main.php">Go to main page</a>
</body>
</html>