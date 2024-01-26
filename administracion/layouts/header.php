<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /administracion/login.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/administracion/assets/dist/css/bootstrap.min.css">
    <title>CRUD de usuarios</title>
    <link rel="icon" type="image/x-icon" href="/administracion/assets/favicon/administracion.ico">
    <link rel="stylesheet" href="/administracion/assets/fontawesome/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
        }

        .seleccionable {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #e3f2fd;">

        <div class="container-fluid">
            <a class="navbar-brand" href="/administracion/index.php">
                <img src="/administracion/assets/brand/administracion-logo.jpg" alt="" width="30" height="auto" class="d-inline-block align-text-top">
                Administracion
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
               
                <ul class="navbar-nav ms-auto me-xl-4 border" style="min-width: 200px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/administracion#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/administracion/assets/profile/user.png" style="width: 30px;height: auto;"><?= $_SESSION["user"]["name"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarProfile">
                            <!--<li><a class="dropdown-item" href="/administracion/change_password.php">Cambiar contraseña</a></li>
                            <li class="dropdown-divider"></li>-->
                            <li><a class="dropdown-item" href="/administracion/logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>