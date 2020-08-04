<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Your order</title>
</head>

<body>
	<?php
		$donuts=$_POST['donuts'];
		$cookies=$_POST['cookies'];
		
		$cena = $donuts + 2*$cookies;
		echo $cena;
		echo "<br/>";
		echo '<a href="index.php">Back</a>';
	?>

</body>
</html>
