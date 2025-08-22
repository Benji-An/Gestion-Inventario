<?php
include '../db/config.php';
include '../includes/header.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso. Puedes iniciar sesión ahora.'); window.location.href='login.php';</script>";
    } elseif ($conn->errno == 1062) {
        $error = "El correo ya está registrado.";
    } elseif ($conn->errno == 1048) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($conn->errno == 1452) {
        $error = "Error de referencia, verifica los datos ingresados.";
    } elseif ($conn->errno == 2002) {
        $error = "Error de conexión a la base de datos.";
    } elseif ($conn->errno == 1045) {
        $error = "Error de autenticación en la base de datos.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="container">
        <div class="card shadow p-4 mx-auto" style="max-width: 400px;">
            <h3 class="text-center">Registro</h3>
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>
</body>

<?php
include '../includes/footer.php';
?>