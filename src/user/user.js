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
        btnModifier.onclick = function() {
            displayTicket(newRow);
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
}

function displayTicket(row) {
    const cellules = row.cells;
    const id = cellules[0].textContent;

    document.getElementById("types").value = cellules[2].textContent;
    document.getElementById("dateInput").value = cellules[3].textContent;
    document.getElementById("prixInput").value = cellules[4].textContent;

    const btnModifier = document.getElementById("btnModifier");
    btnModifier.textContent = "Modifier";
    btnModifier.onclick = function() {
        row.remove();
        modification(row);
    };
    togglePopup();
}

function modification(row) {
    if (row) {
        const cellules = row.cells;
        if (cellules.length >= 5) {
            const nouveauType = document.getElementById("types").value;
            const nouvelleDate = document.getElementById("dateInput").value;
            const nouveauPrix = document.getElementById("prixInput").value;

            cellules[2].textContent = nouveauType;
            cellules[3].textContent = nouvelleDate;
            cellules[4].textContent = nouveauPrix;
            submitTicket();
        }
    }
}
