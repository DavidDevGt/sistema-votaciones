<?php
//session_start();
include 'header.php';
include 'navbar.php';

// Generar un token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.005);
    }

    .form-label {
        font-weight: 600;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Inicio de sesión</h4>
                </div>
                <div class="card-body">
                    <form action="login/entrar" method="post" id="loginForm">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                            <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario"
                                placeholder="Nombre de usuario" required pattern="[a-zA-Z0-9]+">
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" id="contrasena"
                                placeholder="Contraseña" required>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <input type="hidden" name="action" value="login">
                        </div>
                        <button type="submit"
                            class="btn btn-primary btn-block animate__animated animate__tada animate__delay-1s">Iniciar
                            sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

<script src="assets/js/login.js"></script>