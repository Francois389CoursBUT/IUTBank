<?php
//Vérifier si l'utilisateur est connecté
session_start();
include("../fonction/fonction.php");
estConnecterSinonRetourIndex();
?>
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
        <script defer src="../framework/fontawesome-free-6.2.1-web/js/all.js"></script>
        <script defer src="../framework/bootstrap-4.6.2-dist/js/bootstrap.js"></script>
        <title>IUT Bank - Liste des comptes</title>
    </head>
    <body>
    <?php

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

                <!-- Compte courant -->
                <div class="col-md-12 cell">
                    <div class="row">
                        <!-- Image TODO cacher lorsque xs -->
                        <div class="col-md-3 col-sm-6 d-none d-md-block d-sm-block">
                            <img class="imageCompte" src="../img/CompteCourant.jpg" alt="Image du compte courant">
                        </div>
                        <!-- Information -->
                        <div class="col-md-6 col-sm-6 centrerVerticalement">
                            <div class="row">
                                <div class="col-12"> <!-- Détaille du compte -->
                                    <h2>Compte No 123456789ABC - Type : Compte courant</h2>
                                </div>
                                <a class="col-12 centrerHorizontalement" href="compte1.php"> <!-- Bouton -->
                                    <div class="btn btn-primary boutonTexte">D&eacute;tail du compte <i
                                                class="fa-solid fa-list"></i></div>
                                </a>
                            </div>
                        </div>
                        <!-- Solde -->
                        <div class="col-md-3 col-sm-12 centrerVerticalement centrerHorizontalement">

                            <?php
                            $solde = 0;
                            foreach ($tabEcriture as $ligne) {
                                if ($ligne != $tabEcriture[0]) {
                                    if ($ligne[3] != '') $solde -= $ligne[3];
                                    if ($ligne[4] != '') $solde += $ligne[4];
                                }
                            }
                            echo '<p class="solde ';
                            echo $solde < 0 ? "negatif" : "positif";
                            echo '">' . number_format($solde, 2, ',', ' ') . ' €</p>';

                            ?>
                        </div>
                    </div>
                </div>

                <!-- Livret A -->
                <div class="col-12 cell">
                    <div class="row">
                        <!-- Image -->
                        <div class="col-md-3 col-sm-6 d-none d-md-block d-sm-block">
                            <img class="imageCompte" src="../img/LivretA.jpg" alt="Image du Livret A">
                        </div>
                        <!-- Informations -->
                        <div class="col-md-6 col-sm-3 centrerVerticalement">
                            <h2>Compte No 48657894RR - Type : Livret A</h2>
                        </div>
                        <!-- Solde -->
                        <div class="col-md-3 col-sm-12 centrerVerticalement centrerHorizontalement">
                            <p class="solde positif">1350,67&euro;</p>
                        </div>
                    </div>
                </div>

                <!-- LDD -->
                <div class="col-12 cell">
                    <div class="row">
                        <!-- Image -->
                        <div class="col-md-3 col-sm-6 d-none d-md-block d-sm-block">
                            <img class="imageCompte" src="../img/LDD.jpg" alt="Image du LDD">
                        </div>
                        <!-- Informations -->
                        <div class="col-md-6 col-sm-3 centrerVerticalement">
                            <h2>Compte No 6734567TRV - Type : LDD</h2>
                        </div>
                        <!-- Solde -->
                        <div class="col-md-3 col-sm-12 centrerVerticalement centrerHorizontalement">
                            <p class="solde positif">350,25&euro;</p>
                        </div>
                    </div>
                </div>

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
        <?php
    } catch (Exception $e) {
        // Affichage message d'erreur
        echo '<div class="alert alert-info" role="alert">';
        echo '<h2>Maintenance</h2>';
        //DEBUG echo '<p>' . $e->getMessage() . '</p>';
        echo '<p>La base de donn&eacute;e est cours de maintenance.</p>';
        echo '<p>Nous nous excusons pour la g&eacute;ne occasionner</p>';
        echo '</div>';
    }
    ?>
    </body>
</html>