
<?php
$host = "localhost";
$user = "root";
$pass = "";
$bd = "ventas";

$conn = new mysqli($host, $user, $pass, $bd);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}
?>