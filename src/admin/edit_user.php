<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <script  src="admin_js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<div class="cadre1">
    <h1 class="text-center">Modifier utilisateur</h1>
    
<?php
    if(isset($_GET['id']) 
        && isset($_POST['nom']) 
        && isset($_POST['prenom']) 
        && isset($_POST['mail']) 
        && isset($_POST['mot_de_passe']) 
        && isset($_POST['role'])) {
            $id = $_GET['id'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $mail = $_POST['mail'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $role = $_POST['role'];

    $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
    $stmt = $db->prepare("UPDATE utilisateur SET prenom = :prenom, nom = :nom, mail = :mail, mot_de_passe = :mot_de_passe, role = :role WHERE id_user = :id");
    
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":mail", $mail);
    $stmt->bindParam(":mot_de_passe", $mot_de_passe);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":id", $id);

    if($stmt->execute()) {
        echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
    } else {
        echo "Une erreur s'est produite lors de la mise à jour des informations de l'utilisateur.";
    }
} 
?>
    <?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE id_user = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user) {
            ?>
            <!-- Formulaire pour modifier l'utilisateur -->
            <form style=""cadre1 action="edit_user.php?id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $user['nom']; ?>">
                </div>
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $user['prenom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail :</label>
                    <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $user['mail']; ?>">
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" value="<?php echo $user['mot_de_passe']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle :</label>
                    <select id="role" name="role" class="form-control">

                    <?php
                    // Récupère les rôles depuis la base de données
                    $requete = $db->query("SELECT * FROM roles")->fetchAll();
                    foreach ($requete as $row) {
                        $selected = ($user['role'] == $row['id_role']) ? 'selected' : '';
                        echo '<option value="' . $row['id_role'] . '" ' . $selected . '>' . $row['role_nom'] . '</option>';
                    }
                    ?>

                    </select>
                </div>
                <button type="submit" class="bouton">Modifier</button>
                <button type="" class="bouton"> <a href="admin.php">Retour</a></button>
            </form>
            <?php
        } else {
            echo "<p>Utilisateur introuvable.</p>";
        }
    } else {
        echo "<p>Identifiant de l'utilisateur non spécifié.</p>";
    }
    ?>
</div>

</body>
</html>
