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
	<h2>Hello <?php echo $_SESSION['username']; ?>, Welcome to the auction site.</h2>
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
				$sql = "SELECT * FROM `auction`";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
				
				foreach($row as $r) {
					echo "<tr>";
					foreach ($r as $i) {
						echo "<td>", $i, "</td>";
					}
					$item = $r["itemname"];
					$owner = $r["itemowner"];
					echo "<td><a href='add-bid.php?itemname=$item&itemowner=$owner'>Add</a></td>";
				} ?>
			</table><br/>
			<?php
				$user = $_SESSION['username'];
				echo "<a href='showmyitems.php?user=$user'><button class='btn'>Show my items</button></a><br/><br/>";
				echo "<a href='add-item.php'><button class='btn'>Add item</button></a>"
			?>
		</div>
        
 	</div>
</body>
</html>