<style>
    .navbar {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        width: 79px;
        height: auto;
        margin-right: 10px;
        transition: transform 0.3s;
    }

    .navbar-brand:hover {
        transform: scale(1.03);
    }

    .nav-link {
        margin: 0 10px;
        transition: color 0.2s;
    }

    .nav-link:hover {
        color: #FFFFFF;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary animate__animated animate__slideInDown">
    <div class="container-fluid">
        <img class="navbar-brand animate__animated" src="../assets/images/vota_simple_logo.png" alt="Logotipo VotaSimple">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item animate__animated animate__fadeInLeft">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item animate__animated animate__fadeInLeft">
                    <a class="nav-link" href="#">Acerca de</a>
                </li>
                <li class="nav-item animate__animated animate__fadeInLeft">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
