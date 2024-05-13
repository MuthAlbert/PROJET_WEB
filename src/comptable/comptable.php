<div?php
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
    <link rel="stylesheet" type="text/css" href="../../index.css">
    <link rel="stylesheet" type="text/css" href="comptable.css">
    <link rel="icon" href="../../Images/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
           <a class="navbar-brand">TORILLEC</a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../deconnexion.php"><img src="../../Images/user.png" class="user"> Déconnexion</a></li>
                </ul>
            </div>
        </nav>

        <h1>Bienvenue !</h1>

        <table class="table"> <!-- Affichage dans un tableau -->
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ETAT</th>
                <th scope="col">DATE</th>
                <th scope="col">TYPE</th>
                <th scope="col">SOMME</th>
                <th scope="col">UTILISATEUR</th>
                <th scope="col">ACTIONS</th>
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
                <input type="submit" name="bouton" class="bouton_valider" value="Valider">
                <input type="submit" name="bouton" class="bouton_refuser" value="Refuser">
            </form>
            </td>';
        }
        echo "</tr>";

     ?>

    </tbody>
    </div>
    </body>
    </table>
</html>
