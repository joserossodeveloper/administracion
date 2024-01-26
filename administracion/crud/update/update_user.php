<?php
echo "lo lograste";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>

    <h1>Editar Usuario</h1>

    <form id="editForm">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="father_last_name">Apellido Paterno:</label>
        <input type="text" id="father_last_name" name="father_last_name" required><br>

        <label for="mother_last_name">Apellido Materno:</label>
        <input type="text" id="mother_last_name" name="mother_last_name" required><br>

        <label for="birthday">Fecha de Nacimiento:</label>
        <input type="date" id="birthday" name="birthday" required><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="type">Tipo:</label>
        <input type="text" id="type" name="type" readonly><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.5.2/firebase-firestore.js"></script>
    <script>
        //This config data are fine, I just removed it for the sake of privacy i guess.
        var config = {
            apiKey: "AIzaSyAH6XzRQRFowknMC_-QdouFJYtnlzwMMD8",
            authDomain: "puntualo-9ae06.firebaseapp.com",
            projectId: "puntualo-9ae06",
            storageBucket: "puntualo-9ae06.appspot.com",
            messagingSenderId: "245683378554",
            appId: "1:245683378554:web:cdfddd466bc52f635adec3",
            measurementId: "G-B3DD3TYB9S"
        };
        // Initialize Firebase
        var app = firebase.initializeApp(config);
        // Initialize Cloud Firestore through Firebase
        const db = firebase.firestore(app);
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
        // ...

        // Rellenar los campos del formulario con los datos actuales del usuario
        userRef.get().then(function(doc) {
            if (doc.exists) {
                const userData = doc.data();
                nameInput.value = userData.name || '';
                fatherLastNameInput.value = userData.father_last_name || '';
                motherLastNameInput.value = userData.mother_last_name || '';

                // Convertir Timestamp a una cadena de fecha legible por input de tipo date
                birthdayInput.value = userData.birthday ? userData.birthday.toDate().toISOString().split('T')[0] : '';
                console.log(userData.birthday)

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

        // ...

        // Manejar el envío del formulario
        editForm.addEventListener("submit", function(event) {
            event.preventDefault();

            // Actualizar los campos del usuario con los nuevos 
            window.alert(birthdayInput.value);
            var fechaString = birthdayInput.value;
            var partesFecha = fechaString.split('-');
            console.log("Año:", partesFecha[0]);
            console.log("Mes:", partesFecha[1] - 1);
            console.log("Día:", partesFecha[2]);

            var fecha = new Date(partesFecha[0], partesFecha[1] - 1, partesFecha[2]);

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