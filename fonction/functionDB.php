<?php
/**
 * @return PDO
 */
function getPDO(): PDO
{
    //Connexions à la BD
    $host = "localhost";
    $db = "iut_bank";
    $charset = "utf8mb4";
    $user = "root";
    $pwd = "root";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false];

    $dns = "mysql:host=$host;dbname=$db;charset=$charset";

    return new PDO($dns, $user, $pwd, $options);
}

function getEcritureFromDB(string $indentifiant, string $categorieFiltre, string $trieColonne): array
{
    $pdo = getPDO();

    $requete = "SELECT laDate, type, libelle, montantDebit, montantCredit
                    FROM ecritures
                    WHERE IdCompte = :IdCompte";
    if ($categorieFiltre != "Tous") {
        $requete = $requete .  " AND type = :type";
    }

    //switch
    switch ($trieColonne) {
        case "libelle-asc"; $requete = $requete . " ORDER BY libelle ASC"; break;
        case "libelle-desc"; $requete = $requete . " ORDER BY libelle DESC"; break;
        case "date-asc"; $requete = $requete . " ORDER BY laDate ASC"; break;
        case "date-desc"; $requete = $requete . " ORDER BY laDate DESC"; break;
        case "debit-asc"; $requete = $requete . " ORDER BY montantDebit ASC"; break;
        case "debit-desc"; $requete = $requete . " ORDER BY montantDebit DESC"; break;
        case "credit-asc"; $requete = $requete . " ORDER BY montantCredit ASC"; break;
        case "credit-desc"; $requete = $requete . " ORDER BY montantCredit DESC"; break;
    }
    $stmt = $pdo->prepare($requete);

    if ($categorieFiltre != "Tous") {
        $stmt->execute(['IdCompte' => $indentifiant, 'type' => $categorieFiltre]);
    } else {
        $stmt->execute(['IdCompte' => $indentifiant]);
    }

    return $stmt->fetchAll();
}


function getTypeEcritureFromDB(): array
{
    //TODO une seule connection
    $pdo = getPDO();

    $requete = "SELECT *
                FROM type_ecritures";

    $stmt = $pdo->prepare($requete);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getUserFromDB(): array
{
    $pdo = getPDO();

    $requete = "SELECT * FROM clients";

    $stmt = $pdo->prepare($requete);
    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * @param $IdClient
 * @return array La liste des comptes pour le client IdClient
 */
 function getComptesFromBD($IdClient) : array
    {
        $pdo = getPDO();

        $requete = "SELECT comptes.IdCompte, NoCompte, IdClient, comptes.libelle, image, sum(montantCredit) AS credit, sum(montantDebit) AS debit
                    FROM comptes JOIN ecritures e on comptes.IdCompte = e.IdCompte
                    WHERE IdClient = :IdClient
                    GROUP BY e.IdCompte";
        $stmt = $pdo->prepare($requete);
        $stmt->execute(['IdClient' => $IdClient]);

        return $stmt->fetchAll();
    }