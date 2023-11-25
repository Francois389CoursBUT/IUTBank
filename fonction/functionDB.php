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

function getEcritureFromDB(string $indentifiant): array
{
    $pdo = getPDO();

    $requete = "SELECT laDate, type, libelle, montantDebit, montantCredit
                FROM ecritures
                WHERE IdCompte = :IdCompte";

    $stmt = $pdo->prepare($requete);
    $stmt->execute(['IdCompte' => $indentifiant]);

    return $stmt->fetchAll();
}


function getTypeEcritureFromDB(): array
{
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