<?php
        //Connexion à la base
        $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

        // Récupération des données ajouter à ajouter dans la bdd
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['type']) && isset($_POST['etat'] && isset($_POST['somme'] && isset($_POST['date'])){
        $date = $_POST['date'];
        $type = $_POST['type'];
        $somme = $_POST['somme'];
        $etat = $_POST['etat'];
        }
            //Accès a la base
            $req = $connexion->query("INSERT INTO facture (type, etat, somme, date) VALUES ('$type', '$etat', '$somme', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "Nouvelle facture insérée avec succès.";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
?>
