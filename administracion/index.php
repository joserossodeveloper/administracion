<?php

require "layouts/header.php";

?>

<div class="container-fluid">
    <div class="container-fluid mb-1 mt-1">
        <div class="row justify-content-between">
            <div class="col-12 col-md-4 border border-warning border-1 rounded-3 py-0 mb-1">
                <h3 class="text-center">Detalle de usuario</h3>
            </div>
            <div class="col-12 col-md-2 mb-1">
                <a class="btn btn-outline-primary w-100" href="/administracion/crud/create/create_user.php">Agregar</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="table-responsive-xxl">
            <table class="table table-sm table-bordered" style="min-width: 1024px;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Tipo</th>
                        <th class="text-center" scope="col" style="width: 50px;">Opciones</th>
                </thead>
                <tbody id="userListContainer">
                    <!-- Aquí se generará la lista de usuarios dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php require "layouts/footer.php" ?>