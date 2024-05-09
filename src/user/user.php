<?php
session_start();
if(isset($_SESSION['logUser']) != true || $_SESSION['logUser'] != true) {
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
    <title>TORILLEC</title>
    <link rel="stylesheet" type="text/css" href="../../index.css">
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="icon" href="../../Images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body">
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
           <a href="../../deconnexion.php" class="navbar-brand">TORILLEC</a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../deconnexion.php"><img src="../../Images/user.png" class="user"> Log out</a></li>
                </ul>
            </div>
        </nav>
        <!-- Fin navbar -->
        <h1>Bienvenue !</h1>

        <div class="centered-block">
            <button onclick="togglePopup()" class="btn btn-primary mt-3 me-2 animate-pop">Ajouter un ticket</button>
        </div>

        <!-- popup overlay -->
        <div id="popup-overlay">
            <div class="popup-content">
                <h2 class="mb-4"><b>AJOUTER UN TICKET</b></h2>
                <!-- fraits -->
                <div class="mb-3">
                    <label for="choix" class="form-label">Types de frais*</label>
                    <select id="types" class="form-select">
                        <option value="RESTAURATION">RESTAURATION</option>
                        <option value="LOGEMENT">LOGEMENT</option>
                        <option value="TRANSPORT">TRANSPORT</option>
                    </select>
                    <small class="text-muted">Veuillez sélectionner le type de frais associé à ce ticket.</small>
                </div>
                <!-- Date -->
                <div class="mb-3">
                    <label for="dateInput" class="form-label">Date*</label>
                    <input type="date" id="dateInput" class="form-control">
                </div>
                <!-- Prix -->
                <div class="mb-3">
                    <label for="prixInput" class="form-label">Prix*</label>
                    <input type="number" id="prixInput" class="form-control" min="0">
                </div>
                <!-- Bouton pour joindre un fichier -->
                <div class="mb-3">
                    <label for="fileInput" class="form-label">Joindre un fichier</label>
                    <input type="file" id="fileInput" class="form-control">
                    <small class="text-muted">Formats acceptés : PDF, JPEG, PNG, etc.</small>
                </div>
                <!-- Boutons Soumettre et Annuler -->
                <button id="btnModifier" onclick="submitTicket()" class="btn btn-primary mt-3 me-2">Soumettre</button>
                <button onclick="togglePopup()" class="btn btn-secondary mt-3">Annuler</button>
                <a href="javascript:void(0)" onclick="togglePopup()" class="popup-exit">X</a>
            </div>
        </div>
        <!-- fin popup overlay -->
        <!-- Création de la table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ETAT</th>
                    <th scope="col">TYPE</th>
                    <th scope="col">DATE</th>
                    <th scope="col">PRIX</th>
                    <th scope="col" class="text-center" >MODIFICATION</th>
                    <th scope="col" class="text-center">SUPPRIMER</th>
                </tr>
            </thead>
            <!-- l'affichage des tickets dynamiquement-->
            <tbody id="ticketBody">
                <?php
                $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
                $data = $db->query("SELECT * FROM factures");
                foreach ($data as $data_facture) {
                    echo "<tr>";
                    echo "<td>".$data_facture["id_facture"]."</td>";
                    echo "<td>".$data_facture["etat"]."</td>";
                    echo "<td>".$data_facture["date"]."</td>";
                    echo "<td>".$data_facture["type"]."</td>";
                    echo "<td>".$data_facture["somme"]."</td>"; 
                    echo '<td class="text-center"><button class="btn btn-primary btn-modifier " data-ticket-id="' . $data_facture["id_facture"] . '">Modifier</button></td>';
                    // echo '<td><button onclick="deleteTicket(\''.$data_facture["id_facture"].'\')" class="btn btn-danger">Supprimer</button></td>';
                    echo '<td class="text-center"><button onclick="deleteTicket(\''.$data_facture["id_facture"].'\')"><img src="../../images/corbeil.jpg" alt=""></button></td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- fin de la table -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>
    <script src="user.js"></script>
</body>
</html>