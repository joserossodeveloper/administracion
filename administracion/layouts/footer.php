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

    docRef.get().then(function(querySnapshot) {
            if (!querySnapshot.empty) {
                const userListContainer = document.getElementById("userListContainer");

                querySnapshot.forEach(function(doc) {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <th scope='row'>${doc.id}</th>
                        <td>${doc.data().name}</td>
                        <td>${doc.data().father_last_name}</td>
                        <td>${doc.data().mother_last_name}</td>
                        <td>${doc.data().birthday.toDate().toLocaleDateString()}</td>
                        <td>${doc.data().dni}</td>
                        <td>${doc.data().email}</td>
                        <td>${doc.data().password}</td>
                        <td>${doc.data().type}</td>
                        <td class='text-center'>
                            <div class='d-flex align-items-center justify-content-center'>
                                <div class='btn-group'>
                                    <!-- Ajusta las URL según tu estructura -->
                                    <a class='btn btn-secondary' href='/administracion/crud/update/update_user.php?id=${doc.id}'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href='/administracion/crud/delete/delete_user.php?id=${doc.id}'><i class='fa-solid fa-trash-can'></i></a>
                                </div>
                            </div>
                        </td>
                    `;
                    userListContainer.appendChild(row);
                });
            } else {
                console.error("No users found.");
            }
        }).catch(function(error) {
            console.error("Error getting documents: ", error);
        });
</script>
<script src="/administracion/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>