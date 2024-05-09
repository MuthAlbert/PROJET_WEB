<?php
session_start();
if(isset($_SESSION['logComptable']) != true || $_SESSION['logComptable'] != true) {
  echo "Acces Refusé";
  header("Location: ../../deconnexion.php");
  exit();
}
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
            <th scope="col">Utilisateur</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
    
     <?php

       $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
       $data = $db->query("SELECT * FROM factures");


       
   
    
            foreach ($data as $data_facture){
            echo "<tr>";
            echo "<td>".$data_facture["id_facture"]."</td>";
            echo "<td>".$data_facture["etat"]."</td>";
            echo "<td>".$data_facture["date"]."</td>";
            echo "<td>".$data_facture["type"]."</td>";
            echo "<td>".$data_facture["somme"]."</td>";
            echo "<td>".$data_facture["nom_utilisateur"]."</td>";
            echo '<td>
            <form action="traitement.php" method="post">
                <input type="hidden" name="id_facture" value="'.$data_facture['id_facture'].'">
                <input type="submit" name="bouton" value="Valider">
                <input type="submit" name="bouton" value="Refuser">
            </form>
            </td>';
        }
        echo "</tr>";

     ?>

    </tbody>
    </body>
    </table>
</html>
