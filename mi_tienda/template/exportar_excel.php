<?php
include '../db/config.php';

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="inventario.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, ['Producto', 'Total Comprado', 'Total Vendido', 'Stock'], ';');

$query = $conn->query("
    SELECT 
        c.producto, 
        SUM(c.cantidad) AS total_comprado,
        IFNULL((SELECT SUM(v.cantidad) FROM ventas v WHERE v.producto = c.producto), 0) AS total_vendido
    FROM compras c
    GROUP BY c.producto
");


while($row = $query->fetch_assoc()) {
    $stock = $row['total_comprado'] - $row['total_vendido'];
    fputcsv($output, [
        $row['producto'], 
        $row['total_comprado'], 
        $row['total_vendido'], 
        $stock
    ], ';');
}

fclose($output);
exit;
?>