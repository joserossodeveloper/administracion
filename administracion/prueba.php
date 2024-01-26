<?php

if (isset($_POST["email"])) {
    echo "Bien hecho has iniciado sesion ".$_POST["email"];
	exit;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity></script>
</head>

<style type="text/css">

</style>

<body>
    <section class="container-fluid bg">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3">
                <form class="form-container">
                  <div class="form-group">
                    <label for="codeidtextfield">Code ID:</label>
                    <input type="text" class="form-control" id="codeidtextfield" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Code ID's are provided by the Higher Ups. You must request first if you don't have one.</small>
                  </div>
                  <div class="form-group">
                    <label for="passwordfield">Password:</label>
                    <input type="password" class="form-control" id="passwordfield">
                  </div>
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" id="submit_btn">Submit</button>
                </form>
            </section>
        </section>
    </section>
</body>
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
    const codeidField = document.querySelector("#codeidtextfield");
    const passwordField = document.querySelector("#passwordfield");
    const submitButton = document.querySelector("#submit_btn");

    submitButton.addEventListener("click", function(){
        event.preventDefault();
        const codeid = codeidField.value;
        const passworddata = passwordField.value;

        console.log("I am going to authenticate: "+codeid+" and "+passworddata+" to Firestore database.");

        docRef.where("email", "==", codeid)
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
                        form.action = "";  // Establece la URL correcta de tu página aquí

                        // Agregar campos al formulario
                        const codeIDInput = document.createElement("input");
                        codeIDInput.type = "hidden";
                        codeIDInput.name = "email";
                        codeIDInput.value = codeid;
                        form.appendChild(codeIDInput);

                        const passwordInput = document.createElement("input");
                        passwordInput.type = "hidden";
                        passwordInput.name = "password";
                        passwordInput.value = passworddata;
                        form.appendChild(passwordInput);

                        // Agregar el formulario al cuerpo del documento
                        document.body.appendChild(form);

                        // Enviar el formulario
                        form.submit();
                    });
                } else {
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