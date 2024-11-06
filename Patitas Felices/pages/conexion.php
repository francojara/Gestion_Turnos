<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $base_de_datos = "petshop";

    $conexion = new mysqli($server, $user, $password, $base_de_datos) or die("Error " . mysqli_connect_error());
?>