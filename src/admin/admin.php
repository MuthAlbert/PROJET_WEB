<!doctype html>
<html lang="en">
<head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <?php
        session_start();
        // Connexion à la base
            $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
            $data = $db->query("SELECT * FROM utilisateur");
        ?>
        </select>
<br>

<table class="table table-bordered"> <!-- Affichage dans un tableau -->
    <thead>
    <tr>
        <th scope="col">Id utilisateur</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Rôle</th>
        <th scope="col">Mot de Passe</th>
    </tr>
    </thead>
    <?php
    //Affichage des données
    while($ligne = $data->fetch(PDO::FETCH_NUM)){
        echo"<tr>";
        foreach ($ligne as $data_utilisateur){
            echo "<td>$data_utilisateur</td>";
        }
        echo "</tr>";
    }
    ?>
    </div>    
</body>
</table>
</html>
