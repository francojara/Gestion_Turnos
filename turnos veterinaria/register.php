<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$correo = $_POST["correo"];
$mascota = $_POST["mascota"];
$contanos = $_POST["contanos"];
$telefono = $_POST["telefono"];
//Consulta para insertar
$insertar = "INSERT INTO tb_usuarios(nombre, apellidos, correo, mascota, contanos, telefono) VALUES ('$nombre', '$apellidos', '$correo', '$mascota', '$contanos', '$telefono')";
//Ejecutar consulta
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
	echo 'Error al registrarse';
}else{
	echo 'Usuario registrado exitosamente';
}
//Cerrrar conexion
mysqli_close($conexion);