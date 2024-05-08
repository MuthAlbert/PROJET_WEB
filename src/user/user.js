// Cette fonction envoie les données d'un nouveau ticket au serveur, les ajoute à la table HTML, puis recharge la page pour afficher les mises à jour
function submitTicket() {
    const type = document.getElementById("types").value;
    const date = document.getElementById("dateInput").value;
    const somme = document.getElementById("prixInput").value;
    const etat = "En attente de traitement";
    var xhr = new XMLHttpRequest();
    var url = "ajout_ticket.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP si nécessaire
            console.log(xhr.responseText);
            location.reload();
        }
    };
    xhr.send("type=" + type + "&date=" + date + "&somme=" + somme + "&etat=" + etat); // Envoyer les données au script PHP

    if (type && date && somme) {
        const newRow = document.getElementById("ticketBody").insertRow();
        
        newRow.insertCell(0).textContent = "";
        newRow.insertCell(1).textContent = etat;
        newRow.insertCell(2).textContent = type;
        newRow.insertCell(3).textContent = date;
        newRow.insertCell(4).textContent = somme;
        
        const cellModifier = newRow.insertCell(5);
        const btnModifier = document.createElement("button");
        btnModifier.textContent = "Modifier";
        btnModifier.onclick = function() {
            displayTicket(newRow);
            location.reload();
        };
        cellModifier.appendChild(btnModifier);
        togglePopup();
    } else {
        alert("Veuillez remplir tous les champs !");
    }
    location.reload();
}

// Cette fonction envoie les données d'un nouveau ticket au serveur, les ajoute à la table HTML, puis recharge la page pour afficher les mises à jour
function togglePopup() {
    let popup = document.querySelector("#popup-overlay");
    popup.classList.toggle("open");
    if (!popup.classList.contains("open")) {
        reset_popup();
        // location.reload();
    }
}

// Réinitialise les champs du formulaire de la fenêtre contextuelle à leurs valeurs par défaut
function reset_popup() {
    document.getElementById("types").value = "";
    document.getElementById("dateInput").value = "";
    document.getElementById("prixInput").value = "";
}

// Affiche les détails d'un ticket existant dans la fenêtre contextuelle pour modification, récupérant les données de la ligne de la table HTML sélectionnée
function displayTicket(row) {
    const cellules = row.cells;
    const id_facture = cellules[0].textContent;

    document.getElementById("types").value = cellules[2].textContent;
    document.getElementById("dateInput").value = cellules[3].textContent;
    document.getElementById("prixInput").value = cellules[4].textContent;

    const btnModifier = document.getElementById("btnModifier");
    btnModifier.onclick = function() {
        modification(id_facture);
    };
    togglePopup();
}

//  Envoie les modifications d'un ticket existant au serveur via une requête AJAX et affiche le ticket mis à jour après une mise à jour réussie.
function modification(id_facture) {
    const nouveauType = document.getElementById("types").value;
    const nouvelleDate = document.getElementById("dateInput").value;
    const nouveauPrix = document.getElementById("prixInput").value;

    var xhr = new XMLHttpRequest();
    var url = "update_ticket.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            displayTicket()
            location.reload();
        }
    };
    var params = "id_facture=" + id_facture + "&type=" + nouveauType + "&date=" + nouvelleDate + "&somme=" + nouveauPrix;
    xhr.send(params);
    togglePopup();
    location.reload();
}

//  Écoute les clics sur la page pour détecter si l'utilisateur souhaite modifier un ticket existant, déclenchant alors l'affichage des détails du ticket dans la fenêtre contextuelle.
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-modifier")) {
        let row = event.target.closest("tr");
        displayTicket(row);
    }
});
