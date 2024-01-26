  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-analytics.js";
  import { getFirestore, collection, getDocs, addDoc } from 'https://www.gstatic.com/firebasejs/10.7.2/firebase-firestore.js';

  const firebaseConfig = {
    apiKey: "AIzaSyAH6XzRQRFowknMC_-QdouFJYtnlzwMMD8",
    authDomain: "puntualo-9ae06.firebaseapp.com",
    projectId: "puntualo-9ae06",
    storageBucket: "puntualo-9ae06.appspot.com",
    messagingSenderId: "245683378554",
    appId: "1:245683378554:web:cdfddd466bc52f635adec3",
    measurementId: "G-B3DD3TYB9S"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

  const db = getFirestore(app);

  const getUsers = async () => {
    const querySnapshot = await getDocs(collection(db, "users"));
    
    querySnapshot.forEach((doc) => {
        const userData = doc.data();
        
        // Verificar si el documento tiene los campos de email y password
        if (userData.email && userData.password) {
        const email = userData.email;
        const password = userData.password;
        
        // Hacer algo con el email y la contraseña, como imprimirlos en la consola
        console.log(`Email: ${email}, Password: ${password}`);
        } else {
        console.log(`El documento ${doc.id} no contiene email y/o password`);
        }
    });
    };

    // Llamar a la función para obtener y procesar los usuarios
    getUsers();