<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /administracion/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/administracion/assets/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="/administracion/assets/favicon/sedachimbote-logo.ico">
    <link rel="stylesheet" href="/administracion/assets/fontawesome/css/all.min.css">
    <title>Sistema de control de inventario</title>
</head>

<body>
    <div class="container">
        <div class="mt-2 d-flex justify-content-center">
            <main>
                <form id="createUserForm" method="post">
                    <div class="mb-2 text-center">
                        <h5>Crear Usuario</h5>
                    </div>
                    <div class="mb-1">
                        <label for="name" class="form-label">Nombres:</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label for="father_last_name" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="father_last_name" required>
                        </div>
                        <div class="col">
                            <label for="mother_last_name" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="mother_last_name" required>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="birthday" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="birthday" required>
                    </div>
                    <div class="mb-1">
                        <label for="dni" class="form-label">DNI:</label>
                        <input type="text" class="form-control" id="dni" required>
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-1">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-1">
                        <label for="type" class="form-label">Tipo:</label>
                        <select id="type" class="form-select" required>
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="button" class="w-100 btn btn-danger mb-1" onclick="createUser()">Crear Usuario</button>
                    <a class="w-100 btn btn-secondary" href="/administracion/index.php">Cancelar</a>
                </form>
            </main>
        </div>

        <script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-firestore.js"></script>
        <script>
            // Configuración de Firebase
            var config = {
                apiKey: "AIzaSyAH6XzRQRFowknMC_-QdouFJYtnlzwMMD8",
                authDomain: "puntualo-9ae06.firebaseapp.com",
                projectId: "puntualo-9ae06",
                storageBucket: "puntualo-9ae06.appspot.com",
                messagingSenderId: "245683378554",
                appId: "1:245683378554:web:cdfddd466bc52f635adec3",
                measurementId: "G-B3DD3TYB9S"
            };

            // Inicializar Firebase
            firebase.initializeApp(config);
            // Inicializar Cloud Firestore a través Firebase
            const db = firebase.firestore();

            // Función para crear un nuevo usuario
            function createUser() {
                const name = document.getElementById('name').value;
                const fatherLastName = document.getElementById('father_last_name').value;
                const motherLastName = document.getElementById('mother_last_name').value;
                const birthday = document.getElementById('birthday').value;
                const dni = document.getElementById('dni').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const type = document.getElementById('type').value;

                // Convertir la fecha de nacimiento a un objeto de fecha

                var partesFecha = birthday.split('-');

                var birthdayDate = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);

                // Agregar un nuevo usuario a la base de datos
                db.collection("users").add({
                        name: name,
                        father_last_name: fatherLastName,
                        mother_last_name: motherLastName,
                        birthday: birthdayDate,
                        dni: dni,
                        email: email,
                        password: password,
                        type: type
                    })
                    .then(function(docRef) {
                        console.log("Usuario creado con ID: ", docRef.id);
                        alert("Usuario creado exitosamente.");
                        // Redirigir a la página deseada después de crear el usuario
                        window.location.href = "/administracion/index.php";
                    })
                    .catch(function(error) {
                        console.error("Error al crear usuario: ", error);
                    });
            }
        </script>

</body>

</html>