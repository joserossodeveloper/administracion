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
    <title>Eliminar Usuario</title>
</head>

<body>

    <div class="container mt-2 d-flex justify-content-center">
        <main>
            <!-- Formulario con botón de eliminación -->
            <form id="deleteForm">
                <div class="mb-2 text-center">
                    <h5>Eliminar Usuario</h5>
                </div>
                <p class="mb-1">¿Estás seguro de que deseas eliminar este usuario?</p>
                <button type="button" class="w-100 btn btn-danger mb-1" onclick="deleteUser()">Eliminar Usuario</button>
                <a class="w-100 btn btn-secondary mb-1" href="/administracion/index.php">Cancelar</a>
                
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

        // Inicializar Firestore
        const db = firebase.firestore();

        // Función para eliminar el usuario
        function deleteUser() {
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('id');

            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                // Eliminar usuario de la base de datos
                const docRef = db.collection("users").doc(userId);

                docRef.delete().then(function () {
                    alert("Usuario eliminado exitosamente.");
                    // Redirigir o realizar otras acciones después de la eliminación
                    window.location.href = "/administracion/index.php";
                }).catch(function (error) {
                    console.error("Error al eliminar el usuario: ", error);
                });
            }
        }
    </script>
</body>

</html>
