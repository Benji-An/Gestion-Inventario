<?php
include '../../../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = intval($_POST['producto_id']);
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);
    $cliente = trim($_POST['cliente']);
    $fecha = $_POST['fecha'];

    // Obtener información del producto
    $query = $conn->prepare("SELECT producto, stock_actual FROM compras WHERE id = ?");
    $query->bind_param("i", $producto_id);
    $query->execute();
    $result = $query->get_result();
    $producto_data = $result->fetch_assoc();

    if (!$producto_data) {
        die("❌ Producto no encontrado.");
    }

    $producto_nombre = $producto_data['producto'];
    $stock_actual = $producto_data['stock_actual'];

    if ($cantidad > $stock_actual) {
       echo "<script>alert('❌ No hay suficiente stock disponible.');</script>";
       echo "<script>window.location.href = '../registrar_venta.php';</script>";
        exit();
    }

    $total = $precio * $cantidad;

    // Insertar en ventas
    $stmt = $conn->prepare("INSERT INTO ventas (producto, precio, cantidad, cliente, fecha, total) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdissd", $producto_nombre, $precio, $cantidad, $cliente, $fecha, $total);

    if ($stmt->execute()) {
        // Actualizar stock
        $nuevo_stock = $stock_actual - $cantidad;
        $update_stock = $conn->prepare("UPDATE compras SET stock_actual = ? WHERE id = ?");
        $update_stock->bind_param("ii", $nuevo_stock, $producto_id);
        $update_stock->execute();

        header("Location: ../registrar_venta.php?venta=exitosa");
        exit();
    } else {
        echo "❌ Error al registrar la venta.";
    }

    $stmt->close();
}
?>