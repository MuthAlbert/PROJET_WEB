<?php
        //Connexion à la base
        $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

        //Vérification de la connexion
        if ($db === false) {
            die("Erreur dans la connexion à la db !");
        }

        // Récupération des données ajouter à ajouter dans la bdd
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['type']) && isset($_POST['etat']) && isset($_POST['somme']) && isset($_POST['date'])){
        $date = $_POST['date'];
        $type = $_POST['type'];
        $somme = $_POST['somme'];
        $etat = $_POST['etat'];
        }
            //Accès a la base
            $req = $db->prepare( query: "INSERT INTO factures (type, etat, somme, date) VALUES (:type, :etat, :somme, :date)");
            $req->bindParam(':type', $type);
            $req->bindParam(':etat', $etat);
            $req->bindParam(':somme', $somme);
            $req->bindParam(':date', $date);

            if ($req->execute()) {
                echo "Nouvelle facture insérée avec succès.";
            } else {
                echo "Erreur dans l'insertion !";
            }
        }
?>
