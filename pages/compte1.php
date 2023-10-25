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
    <?php

    /**
     * @return array
     * @throws Exception
     */
    function getTabFromFile($chemin)
    {
        $nomFichierTypes = $chemin;
        if (!file_exists($nomFichierTypes)) throw new Exception('Fichier ' . $nomFichierTypes . ' non trouvé.');

        $tabTypes = file($nomFichierTypes, FILE_IGNORE_NEW_LINES);
        $i = 0;
        $tab = array();
        foreach ($tabTypes as $ligne) {
            $tab[$i] = explode(";", $ligne);
            $i++;
        }
        return $tab;
    }

    try {
        $tabEcriture = getTabFromFile("../FichiersDonnees/Ecritures.csv");
        $tabTypeEcriture = getTabFromFile("../FichiersDonnees/TypeEcritures.csv");

        $i = 0;
        foreach ($tabTypeEcriture as $ligne) {
            $tabCodeType[$i] = $ligne[0];
            $i++;
        }
        $typeFiltre = isset($_GET['type']) && in_array($_GET['type'], $tabCodeType) ? $_GET['type'] : "Tous";
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
                    <h1>-- Bienvenue M.Hubert Delaclasse --</h1>
                    <h2>Vous pourrez gr&acirc;ce &agrave; cette interface voir les d&eacute;tails de vos comptes et
                        faire
                        toutes vos op&eacute;rations &agrave; distance</h2>
                </div>

                <!-- Compte ouvert -->
                <div class="col-12 cell">
                    <div class="row">
                        <!-- Image TODO cacher lorsque xs -->
                        <div class="col-md-3 col-sm-6 d-none d-md-block d-sm-block">
                            <img class="imageCompte" src="../img/CompteCourant.jpg" alt="Image du compte courant">
                        </div>
                        <!-- Information -->
                        <div class="col-md-6 col-sm-6 centrerVerticalement">
                            <h2>Compte No 123456789ABC - Type : Compte courant</h2>
                        </div>
                    </div>
                </div>

                <!-- Liste transaction -->
                <div class="col-12 cell">
                    <form action="compte1.php" method="get">
                        <table class="table table-bordered">
                            <tr>
                                <th>Date</th>
                                <th>
                                    Type</br>
                                    <select name="type" id="type">

                                        <?php
                                        echo '<option value="Tous">Tous</option>';
                                        foreach ($tabTypeEcriture as $ligne) {
                                            if ($ligne != $tabTypeEcriture[0]) {
                                                echo '<option value="' . $ligne[0] . '" ';
                                                if ($ligne[0] == $typeFiltre) echo 'selected';
                                                echo '>' . $ligne[1] . '</option>';
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
                            foreach ($tabEcriture as $ligne) {
                                if ($ligne != $tabEcriture[0] && ($typeFiltre == "Tous" || $typeFiltre == $ligne[1])) {
                                    $solde += $ligne[4] - $ligne[3]; //Crédit
                                    echo '<tr>';
                                    echo '<td>' . $ligne[0] . '</td>'; //Date
                                    echo '<td>' . $ligne[1] . '</td>'; //Type
                                    echo '<td>' . $ligne[2] . '</td>'; //Libellé
                                    echo '<td class="negatif">' . $ligne[3] . '</td>'; //Débit
                                    echo '<td class="positif">' . $ligne[4] . '</td>'; //Crédit
                                    if ($typeFiltre == "Tous") {
                                        echo '<td class="';
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
            </div>
        </div>
        <?php
    } catch (Exception $e) {
        // Affichage message d'erreur
        echo '<div class="alert alert-info" role="alert">';
        echo '<h2>Maintenance</h2>';
        //DEBUG echo '<p>' . $e->getMessage() . '</p>';
        echo '<p>La base de donnée est cours de maintenance.</p>';
        echo '<p>Nous nous excusons pour la géne occasionner</p>';
        echo '</div>';
    }
    ?>


    </body>
</html>