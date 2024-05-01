<?php 
session_start();

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


if($_SERVER["REQUEST_METHOD"] = "POST"){

    if(isset($_POST['mail']) && isset($_POST['pwd'])){
    $mail = $_POST['mail'];
    $mot_de_passe = $_POST['pwd'];
    $_SESSION['mail'] = $mail;
    $_SESSION['pwd'] = $mot_de_passe;

    }
    if($mail != "" && $mot_de_passe != ""){
        //Connexion a la base
        $req = $connection->query("SELECT * FROM utilisateur WHERE mail = '$mail' AND mot_de_passe = '$mot_de_passe'");
        $rep = $req->fetch();
        if($rep['id_user'] != false){
            // c'est ok !   
            $_SESSION['id'] = $rep['id_user'];
            if ($rep ['role'] == '1') {
                header("Location: ../admin/admin.php");
                echo 'Connexion réussie';
            } 
            if ($rep ['role'] == "2") {
                header("Location: ../comptable/comptable.php");
                echo 'Connexion réussie';
            } 
            if ($rep ['role'] == '3') {
                header("Location: ../user/user.php");
                echo 'Connexion réussie';
            } 
        }
        else{
            $error_msg = "Wrong username or password !";
        }
    }
}
?>
