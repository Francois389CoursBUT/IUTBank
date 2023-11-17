<?php
//Vérifier si l'utilisateur est connecté
session_start();
include("../fonction/fonction.php");
estConnecterSinonRetourIndex();
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
        <title>IUT Bank - Détails du compte</title>
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
                <h1>-- Bienvenue M.Hubert Delaclasse --</h1>
                <h2>Vous pourrez gr&acirc;ce &agrave; cette interface voir les d&eacute;tails de vos comptes et
                    faire
                    toutes vos op&eacute;rations &agrave; distance</h2>
            </div>

            <?php
            try {

                $tabEcriture = getTabFromFile("../FichiersDonnees/Ecritures.csv");
                $tabTypeEcriture = getTabFromFile("../FichiersDonnees/TypeEcritures.csv");
                $tabTypeEcritureAssoc = tabToAssoc($tabTypeEcriture);
                $tabCodeType = array();

                $i = 0;
                foreach ($tabTypeEcriture as $ligne) {
                    $tabCodeType[$i] = $ligne[0];
                    $i++;
                }
                $typeFiltre = isset($_GET['type']) && in_array($_GET['type'], $tabCodeType) ? $_GET['type'] : "Tous";
                ?>
                <!-- Compte ouvert -->
                <div class="col-12 cell">
                    <div class="row">
                        <!-- Image -->
                        <div class="col-md-3 d-none d-md-block d-sm-none">
                            <img class="imageCompte" src="../img/CompteCourant.jpg" alt="Image du compte courant">
                        </div>
                        <!-- Information -->
                        <div class="col-md-6 col-sm-12 centrerVerticalement">
                            <h2>Compte No 123456789ABC - Type : Compte courant</h2>
                        </div>
                    </div>
                </div>

                <!-- Liste transaction -->
                <div class="col-12 cell">
                    <form action="compte1.php" method="get">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Date</th>
                                <th>
                                    <label for="type">Type</label><br>
                                    <select name="type" id="type">
                                        <?php
                                        echo '<option value="Tous">Tous</option>';
                                        //Création des options avec les types
                                        foreach ($tabTypeEcriture as $ligne) {
                                            if ($ligne != $tabTypeEcriture[0]) {
                                                afficherOption($ligne[0], $ligne[1], $ligne[0] == $typeFiltre);
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input class="btn btn-primary" type="submit" value="Filtrer">
                                </th>
                                <th>Libell&eacute;</th>
                                <th>D&eacute;bit</th>
                                <th>Cr&eacute;dit</th>
                                <?php
                                if ($typeFiltre == "Tous") {
                                    echo '<th>Solde</th>';
                                }
                                ?>
                            </tr>
                            <?php
                            $solde = 0;
                            //Affichage des lignes
                            foreach ($tabEcriture as $ligne) {
                                if ($ligne != $tabEcriture[0] && ($typeFiltre == "Tous" || $typeFiltre == $ligne[1])) {
                                    //Calcul du solde
                                    if ($ligne[3] != '') {
                                        $solde -= $ligne[3];
                                        $ligne[3] = number_format((int)$ligne[3], 2, ',', ' ');
                                    }
                                    if ($ligne[4] != '') {
                                        $solde += $ligne[4];
                                        $ligne[4] = number_format((int)$ligne[4], 2, ',', ' ');
                                    }
                                    echo '<tr>';
                                    echo '<td>' . $ligne[0] . '</td>';                        //Date
                                    echo '<td>' . $tabTypeEcritureAssoc[$ligne[1]] . '</td>'; //Type
                                    echo '<td>' . $ligne[2] . '</td>';                        //Libellé
                                    echo '<td class="negatif AHDroite">' . $ligne[3] . '</td>';       //Débit
                                    echo '<td class="positif AHDroite">' . $ligne[4] . '</td>';        //Crédit
                                    //Si aucun filtre n'est sélectionné, on affiche le solde
                                    if ($typeFiltre == "Tous") {
                                        echo '<td class="AHDroite ';
                                        echo $solde < 0 ? "negatif" : "positif";
                                        echo '">' . number_format($solde, 2, ',', ' ') . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </table>
                    </form>
                </div>

                <?php
            } catch (Exception $e) {
                // Affichage message d'erreur
                echo '<div class="col-12 alert alert-info" role="alert">';
                echo '<h2>Maintenance</h2>';
                //DEBUG echo '<p>' . $e->getMessage() . '</p>';
                echo '<p>La base de donn&eacute;e est cours de maintenance</p>';
                echo '<p>Nous nous excusons pour la g&egrave;ne occasionner</p>';
                echo '</div>';
            }
            ?>
            <div class="col-12 cell cell-footer">
                <div class="row">
                    <div class="col-3 centrerVerticalement">
                        <a href="contact.php">
                            <div class="btn btn-primary btn-block boutonTexte">Nous contacter <i
                                        class="fa-solid fa-envelope"></i></div>
                        </a>
                    </div>

                    <div class="col-3"></div> <!-- Vide pour centrer -->

                    <!-- Bouton déconnexion -->
                    <div class="col-3 centrerVerticalement">
                        <form action="deconnexion.php" method="post">
                            <button type="submit" class="btn btn-danger btn-block boutonTexte">D&eacute;connexion <i
                                        class="fa-solid fa-circle-xmark"></i></button>
                        </form>
                    </div>

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