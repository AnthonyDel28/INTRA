// Importez la bibliothèque Lottie
import lottie from 'lottie-web';

// Chargez l'animation Lottie
const animationPath = 'images/gifs/success.json'; // Chemin vers votre fichier Lottie JSON
const animationContainer = document.getElementById('lottie-container');
const animation = lottie.loadAnimation({
    container: animationContainer,
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: animationPath
});
