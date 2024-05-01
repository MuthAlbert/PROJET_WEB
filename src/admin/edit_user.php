<!doctype html>
<html lang="en">
<head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style_admin.css">
</head>

<body>
  <script  src="admin_js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php    
$id=$_GET['id'];
?>

    <form class="marge"action="edit_user.php" method="post">
    <h2 class="texte">Nom :</h2>
    <input type="text" id="prenom" name="prenom" class="form-control"><br>
    <h2 class="texte">Prénom:</h2>
    <input type="mail" id="nom" name="nom" class="form-control"><br>
    <h2 class="texte">Mail:</h2>
    <input  type="text" id="mail" name="mail" class="form-control"><br>
    <h2 class="texte">Mot de passe :</h2>
    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control"><br>
    


<?php
    

      // Connexion à la base de données
      $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

      // Récupération des rôles depuis la base de données
      $requete = $db->query("SELECT * FROM roles")->fetchAll();

      // Vérification s'il y a des résultats
      if ($requete) {
          echo '<div class="mb-3">';
          echo '<label for="role" class="form-label">Choisir un rôle</label>';
          echo '<select id="role" name="role" class="form-control">';
          // Parcours des résultats et création des options de la liste déroulante
          foreach ($requete as $row) {
              echo '<option value="' . $row['id_role'] . '">' . $row['role_nom'] . '</option>';
          }
          echo '</select>';
          echo '</div>';
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST"){

        if (isset($_POST['nom']) 
            && isset($_POST['prenom']) 
            && isset($_POST['mail']) 
            && isset($_POST['mot_de_passe']) 
            && isset($_POST['role'])) {

              $nom = $_POST['nom'];
              $prenom = $_POST['prenom'];
              $mail = $_POST['mail']; 
              $mot_de_passe = $_POST['mot_de_passe'];
              $role = $_POST['role']; 
              
              $stmt = $db->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, role = :role, mail = :mail, mot_de_passe = :mot_de_passe WHERE id_user = :id");
              $stmt->bindParam(":prenom",$prenom);
              $stmt->bindParam(":nom",$nom);
              $stmt->bindParam(":role",$role);
              $stmt->bindParam(":mot_de_passe",$mot_de_passe);
              $stmt->bindParam(":mail",$mail);
              $stmt->bindParam(":id",$id);
              $stmt->execute();
              exit();
        }}    
    ?>
    <br>
    <input type="submit" value="Modifier">
    <br>
    </div>



</form>




</body>
</html>