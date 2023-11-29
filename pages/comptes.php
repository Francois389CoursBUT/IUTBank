<?php
session_start();
include("../fonction/fonction.php");
//Vérifier si l'utilisateur est connecté
estConnecterSinonRetourIndex();
include("../fonction/functionDB.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <!-- Feuille de style -->
        <link rel="stylesheet" href="../css/style.css"/>
        <!-- Feuille de style bootstrap -->
        <link rel="stylesheet" href="../framework/bootstrap-4.6.2-dist/css/bootstrap.css"/>
        <!-- fontawesome -->
        <link rel="stylesheet" href="../framework/fontawesome-free-6.2.1-web/css/all.css"/>
        <script defer src="../framework/fontawesome-free-6.2.1-web/js/all.js"></script>
        <script defer src="../framework/bootstrap-4.6.2-dist/js/bootstrap.js"></script>
        <title>IUT Bank - Liste des comptes</title>
    </head>
    <body>
    <?php

    function afficheCompte(string $nomImage, string $numeroCompte, int $idCompte, string $typeCompte, float $solde)
    {
        $classSolde = $solde < 0 ? "negatif" : "positif";

        echo '<div class="col-12 cell" >';
        echo '<div class="row" >';

        //Image
        echo '<div class="col-md-3 col-sm-6 d-none d-md-block d-sm-block" >';
        echo '<img class="imageCompte" src = "../img/' . $nomImage . '" alt = "Image du compte" >';
        echo '</div >';

        //Informations
        echo '<div class="col-md-6 col-sm-3 centrerVerticalement" >';
        echo '    <div class="row" >';
        echo '        <div class="col-12"> <!-- Détaille du compte -->';
        echo '            <h2 > Compte No ' . $numeroCompte . ' - Type : ' . $typeCompte . ' </h2 >';
        echo '        </div >';

        echo '        <div class="col-12 centrerHorizontalement"> <!-- Bouton -->';
        echo '            <form action="detailCompte.php" method="post">';
        echo '                <input hidden name="idCompte" value="' . $idCompte . '">';
        echo '                <input hidden name="typeCompte" value="' . $typeCompte . '">';
        echo '                <input hidden name="numeroCompte" value="' . $numeroCompte . '">';
        echo '                <button class="btn btn-primary boutonTexte" type="submit">D&eacute;tail du compte <i class="fa-solid fa-list"></i>';
        echo '                </button>';
        echo '            </form>';
        echo '        </div>';

        echo '    </div>';
        echo '</div >';

        //Solde
        echo '<div class="col-md-3 col-sm-12 centrerVerticalement centrerHorizontalement" >';
        echo '<p class="solde '. $classSolde .'" > ' . number_format($solde, 2,'.', ' ') . ' &euro;</p >';
        echo '</div >';
        echo '</div >';
        echo '</div >';
    }

    try {
    $tabEcriture = getTabFromFile("../FichiersDonnees/Ecritures.csv");

    ?>
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
                <h1>-- Bienvenue <?php echo $_SESSION['nom'] ?> --</h1>
                <h2>Vous pourrez gr&acirc;ce &agrave; cette interface voir les d&eacute;tails de vos comptes et
                    faire
                    toutes vos op&eacute;rations &agrave; distance</h2>
            </div>

            <?php
            $tableComptes = getComptesFromBD($_SESSION['IdClient']);

            foreach ($tableComptes as $compte) {
                $solde = 0.0;
                if ($compte['credit'] == null) $compte['credit'] = 0.0;
                if ($compte['debit'] == null) $compte['debit'] = 0.0;

                $solde = $compte['credit'] - $compte['debit'];

                afficheCompte($compte['image'], $compte['NoCompte'], $compte['IdCompte'], $compte['libelle'], $solde);
            }

            ?>


            <?php
            } catch (Exception $e) {
                // Affichage message d'erreur
                echo '<div class="alert alert-info" role="alert">';
                echo '<h2>Maintenance</h2>';
                //DEBUG echo '<p>' . $e->getMessage() . '</p>';
                echo '<p>La base de donn&eacute;e est cours de maintenance.</p>';
                echo '<p>Nous nous excusons pour la g&eacute;ne occasionner</p>';
                echo '</div>';
                var_dump($e);
            }
            ?>

            <!-- Bas de page -->
            <div class="col-12 cell cell-footer">
                <div class="row">
                    <!-- Nous contacter -->
                    <div class="col-3 centrerVerticalement">
                        <a href="contact.php">
                            <div class="btn btn-primary btn-block boutonTexte">Nous contacter <i
                                        class="fa-solid fa-envelope"></i></div>
                        </a>
                    </div>

                    <!-- Vide pour centrer -->
                    <div class="col-3"></div>

                    <!-- Bouton déconnexion -->
                    <div class="col-3 centrerVerticalement">
                        <form action="deconnexion.php" method="post">
                            <button type="submit" class="btn btn-danger btn-block boutonTexte">D&eacute;connexion <i
                                        class="fa-solid fa-circle-xmark"></i></button>

                        </form>
                    </div>


                    <!-- Réaliser par -->
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12"><p class="textLogo">R&eacute;aliser par</p></div>
                            <div class="col-12 centrerHorizontalement"><img class="logoIUT" src="../img/LogoIut.png"
                                                                            alt="Le logo de l'IUT de Rodez"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>