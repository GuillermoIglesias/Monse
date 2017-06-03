<?php
	require("config.php"); 
	// Set the JSON header
	header("Content-type: text/json");

	$sql = "SELECT temperatura, fecha FROM arduino ORDER BY fecha DESC LIMIT 1";
	$result = mysqli_query($con, $sql);

	$final = mysqli_fetch_assoc($result);
	
	$y = (float)$final["temperatura"];
	$x = strtotime($final["fecha"]) * 1000;

	mysqli_close($con);
	
	// Create a PHP array and echo it as JSON
	$ret = array($x, $y);
	echo json_encode($ret);

?>