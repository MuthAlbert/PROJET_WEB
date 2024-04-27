function togglePopup() {
    let popup = document.querySelector("#popup-overlay");
    popup.classList.toggle("open");
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
        togglePopup();
    } else {
        alert("Veuillez remplir tous les champs !");
    }
}
