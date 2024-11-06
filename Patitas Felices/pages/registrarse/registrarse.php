<?php
session_start();
include '../conexion.php';

$nombre = $_POST['nombre'];
$contra = $_POST['password'];
$mail = $_POST['email'];
$telefono = $_POST['telefono'];

if (empty($nombre) || empty($contra) || empty($mail) || empty($telefono)) {
    header('Location: ../paginas/error.html?error=campos_vacios');
    exit;
}

$result = $conexion->query("SELECT * FROM Usuarios WHERE email = '$mail'");
if ($result->num_rows > 0) {
    header('Location: ../paginas/error.html?error=email_existente');
    exit;
}

$hashed_contra = password_hash($contra, PASSWORD_DEFAULT);

$conexion->query("INSERT INTO Usuarios (nombre, email, contrasena, telefono, rol) VALUES ('$nombre', '$mail', '$hashed_contra', '$telefono', 'usuario')");
$usuario_id = $conexion->insert_id;

$conexion->query("INSERT INTO Clientes (usuario_id) VALUES ($usuario_id)");

$_SESSION['nombre'] = $nombre;
$_SESSION['rol'] = 'usuario';
header('Location: ../login/login.html');

$conexion->close();
?>
