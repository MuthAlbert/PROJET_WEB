function fermerPopup(event) {
    event.preventDefault();
    const popup = document.getElementById("popup");
    popup.style.display = "none";
}

function submitTicket() {
    const type = document.getElementById("types").value;
    const date = document.getElementById("dateInput").value;
    const prix = document.getElementById("prixInput").value;
    
    if (type && date && prix) {
        const tbody = document.getElementById("ticketBody");
        const newRow = tbody.insertRow()

        const cellId = newRow.insertCell(0);
        const cellEtat = newRow.insertCell(1);
        const celltype = newRow.insertCell(2);
        const celldate = newRow.insertCell(3);
        const cellprix = newRow.insertCell(4);

        cellId.textContent = "";
        cellEtat.textContent = "";
        celltype.textContent = type;
        celldate.textContent = date;
        cellprix.textContent = prix;
    } else {
        alert("Veuillez remplir tous les champs !");
    }
}

function display_ticket() {
    const popup = document.getElementById("popup");
    const popupDetails = document.getElementById("popup-details");
    popupDetails.innerHTML = `
    <div id="popup-details" class="container">
    <h2 class="mb-4"><b>AJOUTER UN TICKET</b></h2>
        <div class="mb-3">
            <label for="choix" class="form-label">Types de frais*</label>
            <select id="types" class="form-select">
                <option value="RESTAURATION">RESTAURATION</option>
                <option value="LOGEMENT">LOGEMENT</option>
                <option value="TRANSPORT">TRANSPORT</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dateInput" class="form-label">Date*</label>
            <input type="date" id="dateInput" class="form-control">
        </div>
        <div class="mb-3">
            <label for="prixInput" class="form-label">Prix*</label>
            <input type="number" id="prixInput" class="form-control">
        </div>
        <button onClick="submitTicket()" class="btn btn-primary mt-3 me-2">Soumettre</button>
        <button onClick="fermerPopup()" class="btn btn-secondary mt-3">Annuler</button>
    </div>
    `;
    popup.style.display = "block";
}
