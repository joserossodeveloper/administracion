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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/administracion/assets/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="/administracion/assets/favicon/sedachimbote-logo.ico">
    <title>Editar Usuario</title>
</head>

<body>

    <div class="container mt-2 d-flex justify-content-center">
        <main>
            <form id="editForm">
                <div class="mb-2 text-center">
                    <h5>Editar Usuario</h5>
                </div>
                <div class="mb-1">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label for="father_last_name">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="father_last_name" name="father_last_name" required>
                    </div>
                    <div class="col">
                        <label for="mother_last_name">Apellido Materno:</label>
                        <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" required>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="birthday">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div class="mb-1">
                    <label for="dni">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" required>
                </div>
                <div class="mb-1">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-1">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-1">
                    <label for="type">Tipo:</label>
                    <input type="text" class="form-control" id="type" name="type" readonly>
                </div>
                <button type="submit" class="w-100 btn btn-danger mb-1">Guardar Cambios</button>
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

        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('id');

        // Obtener referencia al documento del usuario
        const userRef = db.collection("users").doc(userId);

        // Obtener formulario y campos
        const editForm = document.getElementById("editForm");
        const nameInput = document.getElementById("name");
        const fatherLastNameInput = document.getElementById("father_last_name");
        const motherLastNameInput = document.getElementById("mother_last_name");
        const birthdayInput = document.getElementById("birthday");
        const dniInput = document.getElementById("dni");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const typeInput = document.getElementById("type");

        // Rellenar los campos del formulario con los datos actuales del usuario
        userRef.get().then(function(doc) {
            if (doc.exists) {
                const userData = doc.data();
                nameInput.value = userData.name || '';
                fatherLastNameInput.value = userData.father_last_name || '';
                motherLastNameInput.value = userData.mother_last_name || '';

                // Convertir Timestamp a una cadena de fecha legible por input de tipo date
                birthdayInput.value = userData.birthday ? userData.birthday.toDate().toISOString().split('T')[0] : '';
                dniInput.value = userData.dni || '';
                emailInput.value = userData.email || '';
                passwordInput.value = userData.password || '';
                typeInput.value = userData.type || '';
            } else {
                console.error("No se encontró el usuario con ID: ", userId);
            }
        }).catch(function(error) {
            console.error("Error obteniendo datos del usuario: ", error);
        });

        // Manejar el envío del formulario
        editForm.addEventListener("submit", function(event) {
            event.preventDefault();


            var fechaString = birthdayInput.value;
            var partesFecha = fechaString.split('-');
            var fecha = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);
            // Actualizar los campos del usuario con los nuevos valores
            userRef.update({
                name: nameInput.value,
                father_last_name: fatherLastNameInput.value,
                mother_last_name: motherLastNameInput.value,
                birthday: fecha,
                dni: dniInput.value,
                email: emailInput.value,
                password: passwordInput.value,
                type: typeInput.value
            }).then(function() {
                console.log("Usuario actualizado correctamente");

                // Redirigir a la página deseada después de editar
                window.location.href = "/administracion/index.php";
            }).catch(function(error) {
                console.error("Error actualizando el usuario: ", error);
            });
        });
    </script>

</body>

</html>