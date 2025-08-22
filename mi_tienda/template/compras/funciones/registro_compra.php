<?php
include '../../../db/config.php';

// Función para definir el valor de stock
function definirStock($cantidad) {
    return $cantidad;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = trim($_POST["producto"]);
    $precio = floatval($_POST["precio"]);
    $cantidad = intval($_POST["cantidad"]);
    $proveedor = trim($_POST["proveedor"]);
    $fecha = $_POST["fecha"];
    
    // Calcular el total
    $total = $precio * $cantidad;

    // Definir el valor de stock
    $stock = definirStock($cantidad);

    // Insertar datos en la tabla compras
    $stmt = $conn->prepare("INSERT INTO compras (producto, precio, cantidad, proveedor, fecha, total, stock_actual) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdissdi", $producto, $precio, $cantidad, $proveedor, $fecha, $total, $stock);

    if ($stmt->execute()) {
        header("Location: ../registrar_compra.php?compra=exitosa");
        exit();
    } else {
        echo "Error al registrar la compra.";
    }

    $stmt->close();
}
?>
