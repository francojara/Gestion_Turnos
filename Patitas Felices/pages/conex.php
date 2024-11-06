<?php
session_start();
include 'conexion.php'; // Asegúrate de que este archivo esté configurado correctamente

// Verificar si el usuario ya está conectado
if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
    // Redirigir a la página de reservas si el usuario ya ha iniciado sesión
    header('Location: ./reserva/reserva.html');
    exit; // Asegura que el script se detenga aquí
} else {
    // Redirigir a la página de registro si el usuario no está conectado
    header('Location: ./login/login.html');
    exit; // Asegura que el script se detenga aquí
}
?>
