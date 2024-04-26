function display_ticket() {
    const popup = document.getElementById("popup");
    const popupDetails = document.getElementById("popup-details");
    popupDetails.innerHTML = `
        <p><b>TICKET</b></p></br>
        <p><b>TYPE</b></p> <label for="choix">Types de frait*</label>
        <select id="choix">
          <option value="option1">RESTAURATION</option>
          <option value="option2">LOGEMENT</option>
          <option value="option3">TRANSPORT</option>
        </select>
        <p><b>DATE*</b></p> <textarea id="mon-textarea"></textarea>
        <p><b>PRIX*</b></p> <textarea id="mon-textarea"></textarea>
        <form>
            <input type="file" id="FILE" name="filename">
        </form>
        <button type="submit" onclick="fermerPopup();">submit</button>
        `;
    popup.style.display = "block";
    console.log("Bonjour depuis maFonction() !");
}

function fermerPopup() {
    const popup = document.getElementById("popup");
    popup.style.display = "none";
}
