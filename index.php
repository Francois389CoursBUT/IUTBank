<?php
include("fonction/fonction.php");



try {
    connexion();
    $loginCorrect = false;
    $erreurServeur = false;
} catch (Exception $e) {
    $erreurServeur = true;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Feuille de style -->
        <link rel="stylesheet" href="css/style.css"/>

        <!-- bootstrap -->
        <link rel="stylesheet" href="framework/bootstrap-4.6.2-dist/css/bootstrap.css"/>

        <!-- fontawesome -->
        <link rel="stylesheet" href="framework/fontawesome-free-6.2.1-web/css/all.css"/>
        <script defer src="framework/fontawesome-free-6.2.1-web/js/all.js"></script>

        <title>IUT Bank</title>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <!-- En-tête -->
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 enTete">
                        <p><img src="img/Logo.jpg" alt="Logo du site" class="logoSite"/></p>
                    </div>
                    <div class="col-md-8 col-sm-12 enTete">
                        <h1>Ma Banque en ligne</h1>
                        <h1>IUT BANK ONLINE</h1>
                    </div>
                </div>
            </div>
            <!-- Message de bienvenue -->
            <div class="col-12 cell">
                <h1>-- Bienvenue sur le site de l'IUT BANK --</h1>
                <h2>Vous pourrez gr&acirc;ce &agrave; cette interface voir les d&eacute;tails de vos comptes
                    et faire toutes vos orations distance</h2>
            </div>

            <?php
            if (!$erreurServeur) {
                ?>
                <!-- Formulaire de connexion -->
                <div class="col-12 cell">
                    <form method="post" action="index.php">
                        <div class="row">
                            <?php
                            if (isset($_POST['identifiant']) && isset($_POST['mdp']) && !$loginCorrect) {
                                ?>
                                <div class="col-12">
                                    <p class="text-danger">Identifiant ou mot de passe incorrect</p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-md-6 col-sm-12 order-md-1 order-sm-1 order-xs-1 labelInputDiv centrerHorizontalement">
                                <label for="identifiant">Identifiant :</label>
                                <input class="form-control inputPlaceholder" name="identifiant" id="identifiant"
                                       <?php
                                       if (isset($_POST['identifiant'])) echo ' value="'.$_POST['identifiant'].'" '
                                       ?>
                                       placeholder="Tapez votre numéro de compte">
                            </div>
                            <div class="col-md-6 col-sm-12 order-md-2 order-sm-3 order-xs-3 labelInputDiv centrerHorizontalement">
                                <label for="mdp">Mot de passe :</label>
                                <input class="form-control inputPlaceholder" name="mdp" id="mdp"
                                       <?php
                                       if (isset($_POST['mdp'])) echo ' value="'.$_POST['mdp'].'" '
                                       ?>
                                       placeholder="Tapez votre mot de passe">
                            </div>

                            <div class="col-12 order-sm-5 order-md-5 order-xs-5">
                                <input class="btn btn-block btn-primary boutonTexte" type="submit" value="Me connecter">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            } else {
                ?>

                <!-- Message d'erreur -->
                <div class="col-12 cell">
                    <h1>Probl&egrave;me serveur, authentification impossible actuellement</h1>
                    <h2>Merci de r&eacute;essayer ult&eacute;rieurement</h2>
                </div>

            <?php } ?>
            <!-- Footer -->
            <div class="col-12 cell cell-footer">
                <div class="row">
                    <div class="col-3 centrerVerticalement">
                        <a href="pages/contact.php">
                            <div class="btn btn-primary btn-block boutonTexte">Nous contacter <i
                                        class="fa-solid fa-envelope"></i></div>
                        </a>
                    </div>

                    <div class="col-6"></div> <!-- Vide pour centrer -->

                    <div class="col-3">
                        <div class="row">
                            <div class="col-12"><p class="textLogo">R&eacute;aliser par</p></div>
                            <div class="col-12 centrerHorizontalement"><img class="logoIUT" src="img/LogoIut.png"
                                                                            alt="Le logo de l'IUT de Rodez"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </body>
</html>