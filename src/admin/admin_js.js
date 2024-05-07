//suppimer un user popup
function confirmDelete(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "admin.php?id=" + userId + "&action=delete";
    }
}

function editUser(userId) {
    window.location.href = "edit_user.php?id=" + userId;
}


// Obtenir la référence à tous les boutons "Supprimer"
var deleteButtons = document.querySelectorAll('.deleteBtn');

// Attacher un gestionnaire d'événement à chaque bouton "Supprimer"
deleteButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var userId = this.dataset.userId;
    var modal = document.getElementById("myModal_" + userId);
    modal.style.display = "block";
  });
});

// Fermer la boîte de dialogue lorsque l'utilisateur clique sur l'icône de fermeture (X) ou le bouton "Annuler"
var closeButtons = document.querySelectorAll('.close, .cancelBtn');
closeButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var modal = this.closest('.modal');
    modal.style.display = "none";
  });
});

// Gérer la logique de suppression lorsque l'utilisateur clique sur le bouton "Confirmer"
var confirmButtons = document.querySelectorAll('.confirmBtn');
confirmButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    // Insérer ici la logique de suppression
    var userId = this.closest('.modal').id.replace('myModal_', '');
    window.location.href = "admin.php?id=" + userId + "&action=delete";
  });
});


//Pop up modification réussie 
function UserModifier() {
  alert("Les informations de l'utilisateur ont été mises à jour avec succès.");
}