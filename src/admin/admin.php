<!doctype html>
<html lang="en">
<head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

<h1 class="title "> Ajouter un produit</h1><br>
<form class="marge"action="admin.php" method="post">
    <h2 class="texte">Nom produit:</h2>
    <input type="text" id="nom_produit" name="nom_produit" class="form-control"><br>

    <h2 class="texte">Description:</h2>
    <input type="text" id="description" name="description" class="form-control"><br>

    <h2 class="texte">Prix HT :</h2>
    <input type="int" id="prix_ht" name="prix_ht" class="form-control"><br>

    <h2 class="texte">Prix TTC :</h2>
    <input type="int" id="prix_ttc" name="prix_ttc" class="form-control"><br>

    <h2 class="texte">Stock</h2>
    <input  type="int" id="stock" name="stock" class="form-control"><br>
    
    <div class="mb-3"><br>
        <label for="categorie" class="form-label">Catégorie</label>

        <select name="categorie">
        <?php
            $db = new PDO("mysql:host=localhost;dbname=produit;charset=utf8mb4","root","");
            $data = $db->query("SELECT * FROM utilsateur")->fetchAll();
            foreach ($data as $utilisateur) {
              echo "<option value=".$utilisateur['id'].">".$utilisateur['mail'].">".$utilisateur['prenom'].">".$utilisateur['nom'].">".$utilisateur['role']."</option>";
            }
        ?>
        </select>
        <br>
        <input type="submit" value="Ajouter">
        <input type="reset" value="Effacer">
        <br>
</form><br>

<?php //vérifie que l'utilisateur a tout rentrer dans les champs 
    if (isset($_POST['nom_produit']) && isset($_POST['description']) && isset($_POST['prix_ht']) && isset($_POST['prix_ttc']) && isset($_POST['stock'])&& isset($_POST['categorie'])) {
        $nom_produit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $prix_ht = $_POST['prix_ht']; 
        $prix_ttc = $_POST['prix_ttc'];
        $stock = $_POST['stock']; 
        $categorie = $_POST['categorie'];   
        $db = new PDO('mysql:host=localhost;dbname=produit;charset=utf8mb4', 'root', '');//insere et stock les valeurs que l'user a rentrer
        $stmt = $db->prepare("INSERT INTO produit (nom_produit, description, prix_ht, prix_ttc, stock, categorie) VALUES (:nom_produit, :description, :prix_ht, :prix_ttc, :stock, :categorie)");
        $stmt->bindParam(":nom_produit", $nom_produit);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":prix_ht", $prix_ht);
        $stmt->bindParam(":prix_ttc", $prix_ttc);
        $stmt->bindParam(":stock", $stock); 
        $stmt->bindParam(":categorie", $categorie);     
        $stmt->execute();   
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>C est nickel</strong> L ajout est OK.
          <button type="button" class="btn-close" data-bs-dismiss="alert"
              aria-label="Close"></button> 
          </div>';
    }
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">Nom produit</th>
        <th scope="col">Description</th>
        <th scope="col">Prix HT</th>
        <th scope="col">Prix TTC</th>
        <th scope="col">Stock</th>
        <th scope="col">Catégorie</th>
        <th scope="col">Supprimer le produit</th>
    </tr>
    </thead>

    <tbody>
    <?php
        if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=='delete'){
            $id=$_GET['id']; 
            $db = new PDO("mysql:host=localhost;dbname=produit;charset=utf8mb4","root","");
            $stmt=$db->prepare("DELETE FROM utilisateur WHERE id=:id");
            $stmt->bindParam (":id",$id);   
            $stmt->execute();   
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong></strong> Utilisateur supprimé
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button> 
            </div>';
        }     
        $db = new PDO("mysql:host=localhost;dbname=produit;charset=utf8mb4","root","");
        $data = $db->query("SELECT * FROM produit")->fetchAll();

        foreach ($data as $row){
            echo "<tr>";
            echo "<td>".$row["nom_produit"]."</td>";
            echo "<td>".$row["description"]."</td>";
            echo "<td>".$row["prix_ht"]."</td>";
            echo "<td>".$row["prix_ttc"]."</td>";
            echo "<td>".$row["stock"]."</td>"; 
            echo "<td>".$row["categorie"]."</td>";
            echo "<td><a type='button' href=admin.php?id=".$row["id"]."&action=delete>Supprimer</a></td>";
            echo "</tr>";
        }
    ?>
    </div>    
    </tbody>
</table>
</html>