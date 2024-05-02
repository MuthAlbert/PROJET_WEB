<?php
session_start();
if (!$_SESSION(['id']){
    header("Location : ../connexion/connexion.html");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TORILLEC</title>
    <link rel="stylesheet" type="text/css" href="../../index.css">
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="icon" href="../../Images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
</head>

<body style="background-color: #335686;">
    <div class="container">
        <ul>
            <li><a class="active" href="user.php">TORILLEC COMPANY</a></li>
            <li style="float:right"><a class="login" href="../connexion/connexion.html">Log out</a></li>
        </ul>
        <div class="centered-block">
            <button onclick="togglePopup()">Ajouter un ticket</button>
        </div>
        <div id="popup-overlay">
            <div class="popup-content">
                <h2 class="mb-4"><b>AJOUTER UN TICKET</b></h2>
                <div class="mb-3">
                    <label for="choix" class="form-label">Types de frais*</label>
                    <select id="types" class="form-select">
                        <option value="RESTAURATION">RESTAURATION</option>
                        <option value="LOGEMENT">LOGEMENT</option>
                        <option value="TRANSPORT">TRANSPORT</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dateInput" class="form-label">Date*</label>
                    <input type="date" id="dateInput" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prixInput" class="form-label">Prix*</label>
                    <input type="number" id="prixInput" class="form-control">
                </div>
                <button id="btnModifier" onclick="submitTicket()" class="btn btn-primary mt-3 me-2">Soumettre</button>
                <button onclick="togglePopup()" class="btn btn-secondary mt-3">Annuler</button>
                <a href="javascript:void(0)" onclick="togglePopup()" class="popup-exit">X</a>
            </div>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ETAT</th>
                <th scope="col">TYPE</th>
                <th scope="col">DATE</th>
                <th scope="col">PRIX</th>
                <th scope="col">MODIFICATION</th>
              </tr>
            </thead>
            <tbody id="ticketBody">
            </tbody>
        </table>
    </div>
    <?php

    //Connexion db
    $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
    $data = $db->query("SELECT * FROM utilisateur");

    //Récupération des information de l'utilisateur
    $id = $_SESSION['id'];

    //Echange avec la base de données
    $requete = "SELECT * FROM utilisateur";
    $result = $db -> query($requete);

    if (!$result){
        echo "La récupération des données a échoué !";
    }  else {
        $utilisateurs = $result->fetchAll(PDO::FETCH_ASSOC); 
        $idExiste = false;
        foreach ($utilisateurs as $utilisateur) {
            if ($id === $utilisateur['id_user']) {
                $idExiste = true;
                break;
            }
        }
    }

    if ($idExiste === true) {

        while($ligne = $result->fetch(PDO::FETCH_NUM)) {
            echo"<tr>";
            foreach ($ligne as $valeur) {
                echo "<td>$valeur</td>";
            }
            echo "</tr>";
        };    
    };

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>
    <script src="user.js"></script>
</body>
</html>
