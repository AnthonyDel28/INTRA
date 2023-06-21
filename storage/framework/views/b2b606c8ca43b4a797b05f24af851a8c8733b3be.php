<link rel="stylesheet" href="<?php echo e(asset('css/pages/about.css')); ?>">
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 about_header">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6 text-center">
            <h1 class="about_title">Bienvenue sur Intra!</h1>
            <img src="<?php echo e(asset('images/assets/intra_character.png')); ?>" alt="" class="character">
        </div>
        <div class="col-5 mt-5">
            <h3 class="about_title">Présentation</h3>
            <hr>
            <p class="simple_text text-light">
                Intra est une application permettant aux développeurs de communiquer et collaborer. Issue d'un projet de fin d'études,
                cette application reprend l'essentiel de ce qu'un développeur peut avoir besoin durant son apprentissage.
                <br>
                <br>
                L'interface a été pensée de manière à rendre toutes les tâches simplifiées, comme la communication ou encore le partage
                d'informations. La force essentielle de cette application réside sur la communauté, en effet les utilisateurs peuvent
                s'entraider pour trouver des solutions à leurs problèmes, mais ils peuvent également intéragir avec les multiples
                fonctionnalités mises à disposition.
                <br>
                <br>
                Au travers de cette page, vous trouverez une explication de toutes les rubriques présentes sur Intra, ce qui vous
                permettra de mieux comprendre le but réel de cette application.
            </p>
        </div>
    </div>
    <div class="row mt-5 justify-content-between">
        <div class="col-5">
            <h3 class="about_title">Démarrage</h3>
            <hr>
            <p class="simple_text text-light">
                Lors de la création de votre compte vous recevrez un email de confirmation de votre inscription. Une fois votre
                inscription terminée, vous pourrez vous rendre sur toutes les parties de l'application.
                <br><br>
                Rendez-vous sur votre page profil, vous pourrez modifier vos informations comme votre @Username, vos données
                d'utilisateur (nom, prénom, email, ect...).
                <br><br>
                Vous aurez également l'occasion de consulter votre avancement dans
                la progression intégrée dans Intra en vous référant à vos badges obtenus, ces badges seront affichés sur votre page
                de profil et seront visibles par les autres utilisateurs.
                <br>
                <img src="<?php echo e(asset('images/assets/about_profile.png')); ?>" alt="" class="about_profile mt-5">
            </p>
        </div>
        <div class="col-5">
            <h3 class="about_title">Niveaux & Succès</h3>
            <hr>
            <p class="simple_text text-light">
                Lors de votre aventure sur Intra, vos actions vous permettront de gagner des points d'expérience qui vous permettront
                de grimper en niveau et d'obtenir des badges, ce qui vous permettra de mettre en valeur votre contribution à la communauté.
                <br><br>
                <img src="<?php echo e(asset('images/assets/header_badges.png')); ?>" alt="" class="about_badges mt-5" style="display: block; margin: 0 auto;">
                <br><br>
                Plusieurs moyens pour gagner de l'expérience: <br>
                -  Publier un post   <br>
                - Publier un commentaire  <br>
                - Jouer à l'un des jeux du GameHub <br>
                - Valider vos données <br>
                - Monter en niveau
            </p>
        </div>
    </div>
    <div class="row mt-5 justify-content-between">
        <div class="col-5">
            <h3 class="about_title">Publication de code</h3>
            <hr>
            <p class="simple_text text-light">
                Lorsque vous publiez un post, vous avez le choix de n'y mettre que du texte pour demander par exemple un conseil
                ou alors pour partager un avis, mais vous avez également l'occasion d'ajouter du code à votre post.
                <br>
                De cette façon, vous pouvez partager du code pour que les autres utilisateurs puissent vous venir en aide en le
                corrigeant ou alors en vous donnant des astuces.
                <br>
                <br>
                Grâce à sa librairie d'intégration hyper puissante, Intra vous permet de publier du code dans pas moins de 38
                langages de programmation différents (JS, PHP, C, C#, HTML, Python, ect...).
                <br><br>
                Exemple:
                <br>
            </p>
            <pre style="padding: 0; background-color: #011627; border: none; border-radius: 25px;">
                <code class="language-javascript" id="code_insert">
                              function reverseString(str) {

    try {
        // Check if the argument is a string
        if (typeof str !== "string") {
            throw new TypeError("Input must be a string");
        }

        // Reverse the string and return it
        return str.split("").reverse().join("");
    } catch (error) {
        // Log the error
        console.error(error);
        return "";
    }
}
                </code>
            </pre>
        </div>
        <div class="col-5">
            <h3 class="about_title">Intra Messenger</h3>
            <hr>
            <p class="simple_text text-light">
                Intra est doté d'un système de messagerie simple et performant qui vous permettra de dialoguer avec les autres
                utilisateurs en leur envoyant des messages mais aussi des fichiers ou des images par exemple.
                <br><br>
                La fonctionnalité d'envoi instantané des messages vous permet donc d'envoyer et de recevoir des messages de la part
                de vos amis de manière directe.
                <br><br>
                <img src="<?php echo e(asset('images/assets/about_messenger.jpg')); ?>" alt="" class="about_messenger mt-5" style="display: block; margin: 0 auto;">
            </p>
            <h3 class="about_title">Autres fonctionnalités</h3>
            <hr>
            <p class="simple_text text-light">L'application vous permet égalemement de publier des rapports pour que vous puissiez nous faire part des bugs
            que vous avez pu éventuellement rencontrer.
                <br>
            Vous avez également la possibilité de consulter et de contribuer au dépot Github officiel de l'application, ce qui
                vous donnera une idée de la façon dont ce projet a été créé.
            </p>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/other/about.blade.php ENDPATH**/ ?>