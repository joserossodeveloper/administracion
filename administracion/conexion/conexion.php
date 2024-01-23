<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-analytics.js";
  import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/10.7.2/firebase-firestore.js';

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

  // Instancia de la bd
  const db = getFirestore(app);

</script>