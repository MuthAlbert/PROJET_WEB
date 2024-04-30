<?php 
//Paramètres de la connexion
$host = '127.0.0.1';
$db = 'utilisateur';
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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['username']) && isset($_POST['pwd'])){
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    }
    if($username != "" && $password != ""){
        //Connexion a la base
        $req = $connection->query("SELECT * FROM utilisateur WHERE username = '$username' AND pwd = '$password'");
        $rep = $req->fetch();
        if($rep['id_utilisateur'] != false){
            // c'est ok !   
            if ($rep ['role'] == '1') {
                header("Location: admin.php");
                echo 'Connexion réussie';
            } 
            if ($rep ['role'] == "2") {
                header("Location: comptable.html");
                echo 'Connexion réussie';
            } 
            if ($rep ['role'] == '3') {
                header("Location: user.html");
                echo 'Connexion réussie';
            } 
        }
        else{
            $error_msg = "Wrong username or password !";
        }
    }
}
?>
