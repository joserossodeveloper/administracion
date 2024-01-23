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

  const db = getFirestore(app);

  // Get a list of cities from your database
  async function getCities(db) {
    const citiesCol = collection(db, 'users');
    const citySnapshot = await getDocs(citiesCol);
    const cityList = citySnapshot.docs.map(doc => doc.data());
    return cityList;
  }

  const citiesList = await getCities(db);

  // Ahora puedes trabajar con citiesList sin necesidad de volver a llamar la función
  console.log(citiesList);

</script>