// Fonction permettant d'ajouter un ticket dans la fenêtre de l'utilisateur ainsi que dans la base de donnée
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
}

function togglePopup() {
    let popup = document.querySelector("#popup-overlay");
    popup.classList.toggle("open");
    if (!popup.classList.contains("open")) {
        reset_popup();
        location.reload();
    }
}

function reset_popup() {
    document.getElementById("types").value = "";
    document.getElementById("dateInput").value = "";
    document.getElementById("prixInput").value = "";
}

function displayTicket(row) {
    const cellules = row.cells;
    const id_facture = cellules[0].textContent;

    document.getElementById("types").value = cellules[2].textContent;
    document.getElementById("dateInput").value = cellules[3].textContent;
    document.getElementById("prixInput").value = cellules[4].textContent;

    const btnModifier = document.getElementById("btnModifier");
    btnModifier.onclick = function() {
        // row.remove();
        modification(id_facture);
    };
    togglePopup();
}

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
        }
    };
    var params = "id_facture=" + id_facture + "&type=" + nouveauType + "&date=" + nouvelleDate + "&somme=" + nouveauPrix;
    xhr.send(params);
    togglePopup();
}

document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-modifier")) {
        let row = event.target.closest("tr");
        displayTicket(row);
    }
});
