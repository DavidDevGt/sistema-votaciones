<?php 
include 'header.php';
include 'navbar.php';
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
                    <form action="/controllers/auth/AuthController.php" method="post">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                            <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block animate__animated animate__pulse animate__infinite">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include 'footer.php';
?>
