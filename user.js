function submitTicket() {
    const type = document.getElementById("types").value;
    const date = document.getElementById("dateInput").value;
    const prix = document.getElementById("prixInput").value;
    const etat = "En attente de traitement";
    
    if (type && date && prix) {
        const newRow = document.getElementById("ticketBody").insertRow();
        
        newRow.insertCell(0).textContent = "";
        newRow.insertCell(1).textContent = etat;
        newRow.insertCell(2).textContent = type;
        newRow.insertCell(3).textContent = date;
        newRow.insertCell(4).textContent = prix;

        const cellModifier = newRow.insertCell(5);
        const btnModifier = document.createElement("button");
        btnModifier.textContent = "Modifier";
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
        // deleteCells(row, [2, 3, 4]);
        // modification(id);
    };
    togglePopup();
}

// function modification(id) {
//     const ligneTicket = document.getElementById(id);
//     if (ligneTicket) {
//         const cellules = ligneTicket.cells;
//         if (cellules.length >= 5) {
//             const nouveauType = document.getElementById("types").value;
//             const nouvelleDate = document.getElementById("dateInput").value;
//             const nouveauPrix = document.getElementById("prixInput").value;

//             cellules[2].textContent = nouveauType;
//             cellules[3].textContent = nouvelleDate;
//             cellules[4].textContent = nouveauPrix;
//         }
//     }
// }

// function deleteCells(row, indexes) {
//     indexes.forEach(index => {
//         row.deleteCell(index);
//     });
// }