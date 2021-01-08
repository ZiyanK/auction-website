<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Main site Site</title>
</head>
<body>
    <?php 
        require('config.php'); 
        include("session.php");
    ?>
	<h2>Hello <?php echo $_SESSION['username']; ?>, here are the items you own.</h2>
    <a href="logout.php"><button>Log Out</button></a>
	<div class = "row">
		<div class='col'>
			<table border="1">
				<th>Item Name</th>
				<th>Item owner</th>
				<th>Highest bid</th>
				<th>Show Bids</th>
				<th>Add Bids</th>
				<?php
                $user = $_SESSION['username'];
				$sql = "SELECT * FROM `auction` WHERE itemowner='$user'";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
				
				foreach($row as $r) {
					echo "<tr>";
					foreach ($r as $i) {
						echo "<td>", $i, "</td>";
					}
					$item = $r["itemname"];
					$owner = $r["itemowner"];
					echo "<td><a href='delete-item.php?itemname=$item&itemowner=$owner'>Delete item</a></td>";
				} ?>
			</table>
			<?php
				echo "<a href='main.php?user=$user'><button class='btn'>Go back</button></a>"
			?>
		</div>
        
 	</div>
</body>
</html>