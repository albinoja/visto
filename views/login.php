<div class="container-fluid d-flex justify-content-center align-items-center"
    style="min-height: 100vh; margin: 0; paddin:0;">
    <div class="row w-100">
        <!-- Sección de la imagen -->
        <div class="col-md-4 d-flex align-items-center justify-content-center logo">
            <img class="img-fluid rounded" src="./public/img/logo.png" width="100%" alt="Logo">
        </div>

        <!-- Sección del formulario -->
        <div class="col-md-8 d-flex align-items-center justify-content-center ">
            <div>
                <h3>Iniciar Sesión</h3>
                <form action="./controllers/controllersLogin.php" method="post" style="width:300px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-user-group"></i>
                        </span>
                        <input type="text" class="form-control form-control-lg" placeholder="Ingrese Usuario"
                            name="usuario" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <input type="password" class="form-control form-control-lg" placeholder="Ingrese Contraseña"
                            name="clave" required autocomplete="off">
                    </div>
                    <button class="btn btn-primary" name="BtnLogin"><b>Acceder</b></button>
                </form>
            </div>
        </div>
    </div>
</div>