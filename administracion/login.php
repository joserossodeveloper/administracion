<?php
session_start();
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["type"])) {
    if ($_POST["type"] === "admin") {
        $_SESSION["user"]["type"] = $_POST["type"];
    } else {
        $_SESSION["login_error"] = "El usuario no pertenece al grupo de administradores";
        header("Location: login.php");
        exit;
    }
    $_SESSION["user"]["email"] = $_POST["email"];
    $_SESSION["user"]["password"] = $_POST["password"];
    $_SESSION["user"]["name"] = $_POST["name"];
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="/administracion/assets/dist/css/bootstrap.min.css">
</head>

<style type="text/css">
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }
</style>

<body>
    <div class="container">
        <div class="mt-auto d-flex justify-content-center align-items-center">
            <form class="form-container" style="width: 350px;">
                <h1 class="text-center">Login Admin</h1>
                <div class="mb-4 text-center text-danger">
                    <h6>
                        <?php
                        echo isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : "";
                        unset($_SESSION["login_error"])
                        ?>
                    </h6>
                </div>
                <div class="mb-3">
                    <label for="emailtextfield" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="emailtextfield" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="passwordfield" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="passwordfield">
                </div>
                <button type="submit" class="w-100 btn btn-primary" id="submit_btn">Submit</button>
            </form>
        </div>
    </div>
    <script src="/administracion/assets/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Firebase CDN -->
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

        const docRef = db.collection("users");
        const emailField = document.querySelector("#emailtextfield");
        const passwordField = document.querySelector("#passwordfield");
        const submitButton = document.querySelector("#submit_btn");

        submitButton.addEventListener("click", function() {
            event.preventDefault();
            const email = emailField.value;
            const passworddata = passwordField.value;

            console.log("I am going to authenticate: " + email + " and " + passworddata + " to Firestore database.");

            docRef.where("email", "==", email)
                .where("password", "==", passworddata)
                .get()
                .then(function(querySnapshot) {
                    if (!querySnapshot.empty) {
                        // Si se encontraron documentos, la autenticación es exitosa
                        querySnapshot.forEach(function(doc) {
                            console.log("Authentication successful!");
                            console.log("User type: ", doc.data().type);

                            const form = document.createElement("form");
                            form.method = "post";
                            form.action = ""; // Establece la URL correcta de tu página aquí

                            // Agregar campos al formulario
                            const emailInput = document.createElement("input");
                            emailInput.type = "hidden";
                            emailInput.name = "email";
                            emailInput.value = email;
                            form.appendChild(emailInput);

                            const passwordInput = document.createElement("input");
                            passwordInput.type = "hidden";
                            passwordInput.name = "password";
                            passwordInput.value = passworddata;
                            form.appendChild(passwordInput);

                            // Agregar el campo type al formulario
                            const typeInput = document.createElement("input");
                            typeInput.type = "hidden";
                            typeInput.name = "type";
                            typeInput.value = doc.data().type; // Assuming 'type' is a field in your Firestore document
                            form.appendChild(typeInput);

                            // Agregar el campo type al formulario
                            const nameInput = document.createElement("input");
                            nameInput.type = "hidden";
                            nameInput.name = "name";
                            nameInput.value = doc.data().name; // Assuming 'name' is a field in your Firestore document
                            form.appendChild(nameInput);

                            // Agregar el formulario al cuerpo del documento
                            document.body.appendChild(form);

                            // Enviar el formulario
                            form.submit();
                        });
                    } else {
                        alert("Usuario y/o contraseña invalidos");
                        // Si no se encontraron documentos, la autenticación falla
                        console.error("Invalid credentials. Authentication failed.");
                    }
                })
                .catch(function(error) {
                    console.error("Error getting documents: ", error);
                });
        });
    </script>

</html>