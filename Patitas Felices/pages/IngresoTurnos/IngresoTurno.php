<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dates = $_POST['dates'];

    if (empty($dates)) {
        echo 'No se seleccionaron fechas.';
        exit;
    }

    foreach ($dates as $date) {
        $dateTime = new DateTime($date);
        $dateTime->setTime(0, 0); // Setear la hora a medianoche o la hora que desees

        $sql = "INSERT INTO Turnos (fecha, cliente_id, veterinario_id, estado) VALUES (?, ?, ?, 'pendiente')";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sii", $dateTime->format('Y-m-d H:i:s'), $_SESSION['cliente_id'], $_SESSION['veterinario_id']);
        
        if (!$stmt->execute()) {
            echo 'Error al guardar el turno: ' . $stmt->error;
            exit;
        }
    }
    echo 'Turnos guardados exitosamente.';
}

$conexion->close();
?>
