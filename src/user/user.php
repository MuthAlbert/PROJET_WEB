<?php
session_start();
//Connexion a la db
$host = '127.0.0.1';
$db = 'utilisateur';
$user ='root';
$pass='';
$charset='utf8mb4';

$databaseDsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    ];
try {
    $connexion = new PDO($databaseDsn, $user, $pass, $options);
    } catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

//Récupération des information de l'utilisateur
$id = $_SESSION['id'];

//Echange avec la base de données
$requete = "SELECT * FROM utilisateur";
$result = $bddPDO -> query($requete);

if(!result){
    echo "La récupération des données a échoué !";
}
if($id === $result['id']){
    while($ligne = $result->fetch(PDO::FETCH_NUM)){
        echo"<tr>";
        foreach ($ligne as $valeur){
            echo "<td>$valeur</td>;
        }
        echo "</tr>";
    }
}
    };
};
?>
