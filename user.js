function submitTicket() {
    const type = document.getElementById("types").value;
    const date = document.getElementById("dateInput").value;
    const prix = document.getElementById("prixInput").value;
    const etat = "En attente de traitement";
    
    if (type && date && prix) {
        const tbody = document.getElementById("ticketBody");
        const newRow = tbody.insertRow()

        const cellId = newRow.insertCell(0);
        const cellEtat = newRow.insertCell(1);
        const celltype = newRow.insertCell(2);
        const celldate = newRow.insertCell(3);
        const cellprix = newRow.insertCell(4);
        const cellModifier = newRow.insertCell(5);

        // cellId.textContent = generateID();
        cellId.textContent = "";
        cellEtat.textContent = etat;
        celltype.textContent = type;
        celldate.textContent = date;
        cellprix.textContent = prix;

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
    const cell = row.cells;
    const id = cell[0].textContent;
    const etat = cell[1].textContent;
    const type = cell[2].textContent;
    const date = cell[3].textContent;
    const prix = cell[4].textContent;

    document.getElementById("types").value = type;
    document.getElementById("dateInput").value = date;
    document.getElementById("prixInput").value = prix;
    document.getElementById("btnModifier").textContent = "Modifier";
    // document.getElementById("btnModifier").onclick = function() {
    //     soumettreModifications(id);
    // };
    togglePopup();
}
