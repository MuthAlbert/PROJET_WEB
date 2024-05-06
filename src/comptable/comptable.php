<?php
session_start();
if(isset($_SESSION['logComptable']) != true || $_SESSION['logComptable'] != true) {
  echo "Acces Refusé";
  header("Location: ../../deconnexion.php");
  exit();
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TORILLEC - Comptable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="comptable.css">
</head>
<body>
    <li style="float:right"><a class="login" href="../../deconnexion.php"><button>Log out</button></a></li>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <table class="table table-bordered "> <!-- Affichage dans un tableau -->
        <thead>
        <tr >
            <th scope="col">ID</th>
            <th scope="col">etat</th>
            <th scope="col">date</th>
            <th scope="col">type</th>
            <th scope="col">somme</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
    
     <?php

       $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
       $data = $db->query("SELECT * FROM factures");


       
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier quel bouton a été cliqué
        if (isset($_POST["valider"])) {
            // Si le bouton "Valider" a été cliqué, mettre à jour l'état à 1 dans la table Factures
            $stmt = $db->prepare("UPDATE Factures SET etat = 1 WHERE id_facture = :id");
            $stmt->bindParam(":id", $_POST["id_facture"]);
            $stmt->execute();
            echo "La facture a été validée avec succès.";
        }
        elseif (isset($_POST["refuser"])) {
            // Si le bouton "Refuser" a été cliqué, mettre à jour l'état à 0 dans la table Factures
            $stmt = $db->prepare("UPDATE Factures SET etat = 0 WHERE id_facture = :id");
            $stmt->bindParam(":id", $_POST["id_facture"]);
            $stmt->execute();
            echo "La facture a été refusée.";
    }
}

    
        // while ($row = $data->fetch(PDO::FETCH_NUM)){
            foreach ($data as $data_facture){
            echo "<tr>";
            echo "<td>".$data_facture["id_facture"]."</td>";
            echo "<td>".$data_facture["etat"]."</td>";
            echo "<td>".$data_facture["date"]."</td>";
            echo "<td>".$data_facture["type"]."</td>";
            echo "<td>".$data_facture["somme"]."</td>";
            echo '<td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" id="valider">Valider</a></li>
                        <li><a class="dropdown-item" id="refuser">Refuser</a></li>
                        
                    </ul>
                </div>
            </td>';
        }
        echo "</tr>";

        //  }

     ?>

    </tbody>
    </body>
    </table>

<!--- pour update les données--->

<script>

    function confirmModify(etat){
        if (confirm("Voulez vous changer l'état de cette facture?")) {
            window.location.href = "admin.php?id=" + etat + "&action=edit";
        }
    }

</script>

 <?php
// Vérifier si une requête de mise à jour a été soumise
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_user'])) {
    // Récupérer les valeurs des champs du formulaire
    $id = $_POST['user_id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $role = $_POST['role'];
    $mail = $_POST['mail'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

    // Préparer la requête de mise à jour
    $stmt = $db->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, role = :role, mail = :mail, mot_de_passe = :mot_de_passe WHERE id_user = :id");

    // Liaison des valeurs
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":mail", $mail);
    $stmt->bindParam(":mot_de_passe", $mot_de_passe);

    // Exécuter la requête de mise à jour
    $stmt->execute();

    // Rediriger l'utilisateur vers une autre page après la mise à jour
    header("Location: admin.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>

</html>