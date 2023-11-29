<?php
//Vérifier si l'utilisateur est connecté
session_start();
include("../fonction/fonction.php");
include("../fonction/functionDB.php");
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
            /**
             * @param $ligne
             * @param $solde
             * @param $assocTypeEcriture
             * @param $typeFiltre
             * @return mixed
             */
            function affichageEntree(string $date, string $type, string $libelle,  $debit,  $credit)
            {
//Calcul du solde
                global $assocTypeEcriture, $typeFiltre, $solde;


                if ($debit != '') {
                    $solde -= $debit;
                    $debit = number_format((int)$debit, 2, ',', ' ');
                }
                if ($credit != '') {
                    $solde += $credit;
                    $credit = number_format((int)$credit, 2, ',', ' ');
                }
                echo '<tr>';
                echo '<td>' . date("d/m/Y", strtotime($date)) . '</td>';                        //Date
                echo '<td>' . $assocTypeEcriture[$type] . '</td>'; //Type
                echo '<td>' . $libelle . '</td>';                        //Libellé
                echo '<td class="negatif AHDroite">' . $debit . '</td>';       //Débit
                echo '<td class="positif AHDroite">' . $credit . '</td>';        //Crédit
                //Si aucun filtre n'est sélectionné, on affiche le solde
                if ($typeFiltre == "Tous") {
                    echo '<td class="AHDroite ';
                    echo $solde < 0 ? "negatif" : "positif";
                    echo '">' . number_format($solde, 2, ',', ' ') . '</td>';
                }
                echo '</tr>';
            }

            try {



                if (isset($_POST['idCompte'])) $_SESSION['idCompte'] = $_POST['idCompte'];
                if (isset($_POST['numeroCompte'])) $_SESSION['numeroCompte'] = $_POST['numeroCompte'];
                if (isset($_POST['typeCompte'])) $_SESSION['typeCompte'] = $_POST['typeCompte'];

                $tabTypeEcriture = getTypeEcritureFromDB();

                $assocTypeEcriture = tabToAssoc($tabTypeEcriture);
                $tabCodeType = array();
                $i = 0;
                foreach ($tabTypeEcriture as $ligne) {
                    $tabCodeType[$i] = $ligne['type'];
                    $i++;
                }
                $typeFiltre = isset($_GET['type']) && in_array($_GET['type'], $tabCodeType) ? $_GET['type'] : "Tous";

                $argumentTrie = isset($_GET['trie']) ? $_GET['trie'] : "";

                $tabEcriture = getEcritureFromDB($_SESSION['idCompte'], $typeFiltre, $argumentTrie);
                var_dump("POST");
                var_dump($_POST);
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
                            <?php echo '<h2 > Compte No ' . $_SESSION['numeroCompte'] . ' - Type : ' . $_SESSION['typeCompte'] . ' </h2 >'; ?>
                        </div>
                    </div>
                </div>

                <!-- Liste transaction -->
                <div class="col-12 cell">
                    <form action="detailCompte.php" method="get">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>
                                    <label>Date</label>
                                    <button name="trie" class="btn btn-primary" type="submit" value="date-asc"><i class="fa-solid fa-arrow-up-1-9"></i></button>
                                    <button name="trie" class="btn btn-primary" type="submit" value="date-desc"><i class="fa-solid fa-arrow-down-9-1"></i></button>
                                </th>
                                <th>
                                    <label for="type">Type</label><br>
                                    <select name="type" id="type">
                                        <?php
                                        echo '<option value="Tous">Tous</option>';
                                        //Création des options avec les types
                                        foreach ($tabTypeEcriture as $ligne) {
                                            afficherOption($ligne['type'], $ligne['libelle'], $ligne['type'] == $typeFiltre);
                                        }
                                        ?>
                                    </select>
                                    <input class="btn btn-primary" type="submit" value="Filtrer">
                                </th>
                                <th>
                                    <label>Libell&eacute;</label>
                                    <button name="trie" class="btn btn-primary" type="submit" value="libelle-asc"><i class="fa-solid fa-arrow-up-a-z"></i></button>
                                    <button name="trie" class="btn btn-primary" type="submit" value="libelle-desc"><i class="fa-solid fa-arrow-down-z-a"></i></button>
                                </th>
                                <th>
                                    <label>D&eacute;bit</label>
                                    <button name="trie" class="btn btn-primary" type="submit" value="debit-asc"><i class="fa-solid fa-arrow-up-1-9"></i></button>
                                    <button name="trie" class="btn btn-primary" type="submit" value="debit-desc"><i class="fa-solid fa-arrow-down-9-1"></i></button>
                                </th>
                                <th>
                                    <label>Cr&eacute;dit</label>
                                    <button name="trie" class="btn btn-primary" type="submit" value="credit-asc"><i class="fa-solid fa-arrow-up-1-9"></i></button>
                                    <button name="trie" class="btn btn-primary" type="submit" value="credit-desc"><i class="fa-solid fa-arrow-down-9-1"></i></button>
                                </th>
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
                                affichageEntree($ligne['laDate'], $ligne['type'], $ligne['libelle'], $ligne['montantDebit'], $ligne['montantCredit']);
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

                    <!-- Bouton retour -->
                    <div class="col-3 centrerVerticalement">
                        <a href="comptes.php">
                            <div class="btn btn-primary btn-block boutonTexte">Retour &agrave; la liste des comptes <i
                                        class="fa-solid fa-arrow-left"></i></div>
                        </a>
                    </div>

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