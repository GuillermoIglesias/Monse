<?php
    // Importamos la configuración
    require("config.php");
    
    // Leemos los valores que nos llegan por GET
    $id_arduino = mysqli_real_escape_string($con, $_GET['id_arduino']);
    $temperatura = mysqli_real_escape_string($con, $_GET['temperatura']);
    $humedad = mysqli_real_escape_string($con, $_GET['humedad']);
    $gas = mysqli_real_escape_string($con, $_GET['gas']);
    $estado = mysqli_real_escape_string($con, $_GET['estado']);
    
    // Esta es la instrucción para insertar los valores
    $query = "INSERT INTO arduino(id_arduino, temperatura, humedad, gas, estado) VALUES('$id_arduino','$temperatura','$humedad','$gas','$estado')";

    // Ejecutamos la instrucción
    mysqli_query($con, $query);
    mysqli_close($con);

    echo $id_arduino, $temperatura, $humedad, $gas, $estado;
?>