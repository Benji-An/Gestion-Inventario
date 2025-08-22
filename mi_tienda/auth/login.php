<?php
session_start();
include '../db/config.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $hashed_password);
    
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION["usuario"] = $nombre;
            $_SESSION["id"] = $id;
            header("Location: ../index.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}
?>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="container">
        <div class="card shadow-lg p-5 mx-auto border-0" style="max-width: 400px; border-radius: 20px; background: linear-gradient(135deg, #ffffff, #f8f9fa);">
            <h3 class="text-center mb-4 text-primary fw-bold">Bienvenido</h3>
            <p class="text-center text-muted mb-4">Por favor, inicia sesión para continuar</p>
            <?php if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso'): ?>
                <div class="alert alert-success text-center">Registro exitoso. Inicia sesión.</div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Correo</label>
                    <input type="email" name="email" class="form-control form-control-lg shadow-sm" placeholder="Ingresa tu correo" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg shadow-sm" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow">Iniciar Sesión</button>
            </form>
            <div class="text-center mt-4">
                <a href="forgot_password.php" class="text-decoration-none text-secondary d-block mb-2">¿Olvidaste tu contraseña?</a>
                <a href="register.php" class="text-decoration-none text-secondary">¿No tienes cuenta? <span class="text-primary fw-bold">Regístrate</span></a>
            </div>
        </div>
    </div>
</body>

<?php
include '../includes/footer.php';
?>
