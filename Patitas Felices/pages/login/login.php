<?php
session_start();
include '../conexion.php';

// Recibir datos del formulario
$email = $_POST['email'];
$contra = $_POST['password'];

// Verificar que no haya campos vacíos
if (empty($email) || empty($contra)) {
    header('Location: ../paginas/error.html?error=campos_vacios');
    exit;
}

// Consultar el usuario en la base de datos
$stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($contra, $usuario['contrasena'])) {
        // Iniciar sesión
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol']; // 'usuario' en este caso
        header('Location: ../paginas/dashboard.html'); // Redirigir a la página del usuario
    } else {
        header('Location: ../paginas/error.html?error=contrasena_incorrecta');
    }
} else {
    header('Location: ../paginas/error.html?error=usuario_no_encontrado');
}

$stmt->close();
$conexion->close();
?>
