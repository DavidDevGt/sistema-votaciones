<?php 
include 'header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Registro</div>
                <div class="card-body">
                    <form action="/controllers/auth/AuthController.php" method="post">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                            <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo_electronico" class="form-label">Correo electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" id="correo_electronico" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include 'footer.php';
?>