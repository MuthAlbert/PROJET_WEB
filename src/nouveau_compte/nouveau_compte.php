<?php   
//Paramètres de la connexion
$host = '127.0.0.1';
$db = 'torillec';
$user ='root';
$pass='';
$charset='utf8mb4';

$databaseDsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    // Active le mode d'erreur. Par défaut, il est désactivé.
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // Définit le mode de récupération par défaut pour les requêtes. Ici, il renvoie les résultats sous forme de tableau associatif.
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Désactive l'émulation des requêtes préparées. Utilise la préparation réelle du SGBD quand c'est possible.
    PDO::ATTR_EMULATE_PREPARES => false,
   ];
   try {
    $connection = new PDO($databaseDsn, $user, $pass, $options);
   } catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
   }

// Récupération des données de connexions 
if(isset($_POST['ok'])){
    $nom = ['nom'];
    $prenom = ['prenom'];
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $pwd = $_POST['pwd'];

    $requete = $bdd->prepare("INSERT INTO utilisateur VALUES (:nom, :prenom, :phone, :mail, :pwd, :username, 3)");
    $requete->execute(
        array(
            "nom" => $nom,
            "prenom" => $prenom,
            "mail" => $mail,
            "pwd" => $pwd,
            "username" => $username,
            "phone" => $phone,
        )
    );
    header("Location connexion.html");
    $reponse = $requete->fetchall(PDO::FETCH_ASSOC);
    var_dump($response);
}

echo('Création de compte réussi ! ')
?>  
