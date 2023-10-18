<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Feuille de style -->
    <link rel="stylesheet" href="../css/style.css"/>
    <!-- Feuille de style bootstrap -->
    <link rel="stylesheet" href="../framework/bootstrap-4.6.2-dist/css/bootstrap.css"/>
    <!-- fontawesome -->
    <link rel="stylesheet" href="../framework/fontawesome-free-6.2.1-web/css/all.css"/>
    <script defer src="../framework/fontawesome-free-6.2.1-web/js/all.js" ></script>
    <title>IUT Bank - Nous contacter</title>
</head>
<body>
<div class="container">
    <div class="row">

        <!-- En-tête -->
        <div class="col-12">
            <div class="row">
                <div class="col-md-4 col-sm-12 enTete">
                    <p><img src="../img/Logo.jpg" alt="Logo du site" class="logoSite"/></p>
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
            <h2>Merci de remplir le formulaire ci-apr&egrave;s</h2>
        </div>

        <!-- Formulaire de contact -->
        <div class="col-12 cell">
            <form method="post">
                <div class="row">
                    <!-- Nom et prénom -->
                    <div class="col-12 labelInputDiv centrerHorizontalement">
                        <label for="nom" class="noir">Nom et pr&eacute;nom :</label>
                    </div>
                    <div class="col-12">
                        <input class="form-control inputPlaceholder" name="identifiant" id="nom" placeholder="Tapez votre nom et prénom">
                    </div>

                    <!-- Adresse email -->
                    <div class="col-12 labelInputDiv centrerHorizontalement">
                        <label for="email" class="noir">Adresse email :</label>
                    </div>
                    <div class="col-12">
                        <input class="form-control inputPlaceholder" name="identifiant" id="email" placeholder="Tapez votre adresse email">
                    </div>

                    <!-- Message -->
                    <div class="col-12 labelInputDiv centrerHorizontalement">
                        <label for="message" class="noir">Voter message :</label>
                    </div>
                    <div class="col-12">
                        <textarea class="form-control inputPlaceholder"
                                  name="message" id="message"
                                  placeholder="Tapez le contenue de votre message"></textarea>
                    </div>

                    <!-- Bouton -->
                    <div class="col-12">
                        <div class="btn btn-block btn-light boutonTexte">Envoyer</div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="col-12 cell">
            <div class="row">
                <!-- Vide pour centrer -->
                <div class="col-7"></div>

                <div class="col-3 centrerVerticalement">
                    <a href="../index.php">
                        <div class="btn btn-danger btn-block boutonTexte">Acceuil <i class="fa-solid fa-eject"></i></div>
                    </a>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-12"><p class="textLogo">R&eacute;aliser par</p></div>
                        <div class="col-12 centrerHorizontalement"><img class="logoIUT" src="../img/LogoIut.png" alt="Le logo de l'IUT de Rodez"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>