<?php

/**
 * Vérifie si les identifiants de connexion sont corrects
 * @return bool
 * @throws Exception
 */
function verifierLogin(): bool
{
    if (isset($_POST['identifiant']) && isset($_POST['mdp'])) {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $tab = getTabFromFile('FichiersDonnees/Logins.csv');
        foreach ($tab as $ligne) {
            if ($ligne != $tab[0]) {
                if ($ligne[0] == $identifiant && $ligne[1] == $mdp) {
                    return true;
                }
            }
        }
    }
    return false;
}

/**
 * @throws Exception
 */
function connexion()
{
    if (verifierLogin()) {
        session_start();
        $_SESSION['identifiant'] = $_POST['identifiant'];
        $_SESSION['nom'] = getNomFrom($_POST['identifiant'], $_POST['mdp']);
        header("Location: pages/comptes.php");
        exit();
    }
}

/**
 * @throws Exception
 */
function getNomFrom(string $identifiant, string $mdp): string
{
    $tab = getTabFromFile('FichiersDonnees/Logins.csv');
    foreach ($tab as $ligne) {
        if ($ligne[0] == $identifiant && $ligne[1] == $mdp) {
            return $ligne[2];
        }
    }
    throw new Exception('Identifiant ou mot de passe incorrect');
}

/**
 * @return void
 */
function estConnecterSinonRetourIndex()
{
    if (!isset($_SESSION['identifiant'])) {
        header('Location: ../index.php');
        exit();
    }
}


/**
 * @param $chemin string Chemin du fichier
 * @return array Un tableau contenant un sous tableau pour chaque ligne du fichier
 * @throws Exception Si le fichier n'existe pas
 */
function getTabFromFile(string $chemin): array
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

/**
 * Transforme un tableau de tableau en tableau associatif
 * @param array $tabTypeEcriture : tableau à transformer
 * @return array : tableau associatif
 */
function tabToAssoc(array $tabTypeEcriture): array
{
    $tabTypeEcritureAssoc = array();
    foreach ($tabTypeEcriture as $ligne) {
        $tabTypeEcritureAssoc[$ligne[0]] = $ligne[1];
    }
    return $tabTypeEcritureAssoc;
}

/**
 * Fonction qui affiche une option dans un select
 * Si l'option est sélectionnée, on ajoute l'attribut selected
 * @param $value : valeur de l'option
 * @param $textDisplay : texte affiché dans l'option
 * @param bool $isSelected : booléen qui indique si l'option est sélectionnée
 */
function afficherOption(string $value, string $textDisplay, bool $isSelected = false)
{
    echo '<option value="' . $value . '"';
    if ($isSelected) echo ' selected';
    echo '>' . $textDisplay . '</option>';
}