<?php
    // Credenciales
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "monse";
    // Conexión con la base de datos
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$con) {
    	die("Connection failed: " . mysqli_connect_error());
	}
?>