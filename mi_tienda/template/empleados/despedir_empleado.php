<?php

include('../../db/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $fecha_despido = date('Y-m-d H:i:s');
    $sql = "UPDATE empleados SET estado = 'despedido', fecha_despido = ? WHERE id = ?";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $fecha_despido, $id);  
        if ($stmt->execute()) {
            header("Location: ../ver_empleados.php?mensaje=Empleado despedido con éxito");
        } else {
            echo "Error al eliminar el empleado";
        }
    } else {
        echo "Error al preparar la consulta";
    }

    $conn->close();
} else {
    echo "No se ha recibido el ID del empleado";
}
?>
