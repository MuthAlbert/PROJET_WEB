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


    <!--  On ajoute un utilisateur ici -->
  <div class="cadre">
  <h1 class="title "> Ajouter un utilisateur</h1><br>
  <form class="marge"action="admin.php" method="post">
    <h2 class="texte">Nom:</h2>
    <input type="text" id="nom" name="nom" class="form-control"><br>
    <h2 class="texte">Prénom:</h2>
    <input type="text" id="prenom" name="prenom" class="form-control"><br>
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
              
              $stmt=$db->prepare("INSERT INTO utilisateur (prenom,nom,role,mot_de_passe,mail) VALUES(:prenom,:nom,:role,:mot_de_passe,:mail)");
              $stmt->bindParam(":prenom",$prenom);
              $stmt->bindParam(":nom",$nom);
              $stmt->bindParam(":role",$role);
              $stmt->bindParam(":mot_de_passe",$mot_de_passe);
              $stmt->bindParam(":mail",$mail);
              $stmt->execute();
              header("Location: admin.php");
              exit();
        }}    
    ?>
    <br>
    <input type="submit" value="Ajouter">
    <input type="reset" value="Effacer">
    <br>
    </div>
  </form>

<!---afficher les données de tout les users, supprimer les users--->

<table class="table table-bordered cadre"> <!-- Affichage dans un tableau -->
    <thead>
    <tr >
        <th scope="col">Id utilisateur</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Rôle</th>
        <th scope="col">Mail</th>
        <th scope="col">Mot de Passe</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

 <?php
   if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=='delete'){
     $id=$_GET['id']; 
     $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
     $stmt=$db->prepare("DELETE FROM utilisateur WHERE id_user=:id");
     $stmt->bindParam (":id",$id);

     $stmt->execute();
     header("Location: admin.php");
     exit();

   }     
   $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
   $data = $db->query("SELECT * FROM utilisateur")->fetchAll();

    foreach ($data as $row){
      echo "<tr>";
      echo "<td>".$row["id_user"]."</td>";
      echo "<td>".$row["nom"]."</td>";
      echo "<td>".$row["prenom"]."</td>";
      echo "<td>".$row["role"]."</td>";
      echo "<td>".$row["mail"]."</td>"; 
      echo "<td>".$row["mot_de_passe"]."</td>";
      echo '<td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Actions
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="edit_user.php?id='.$row['id_user'].'">Modifier</a></li>
                    <li><a class="dropdown-item" href="#" onclick="confirmDelete('.$row['id_user'].')">Supprimer</a></li>
                </ul>
            </div>
        </td>';
    echo "</tr>";
}
 ?>

</div>
</tbody>
</body>
</table>



<!-- Pour update les données-->








</html>
