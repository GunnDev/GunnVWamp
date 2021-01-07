function deleteUser(btnID) {
    var span = document.getElementById("usersIDToDelete");
    var modal = document.getElementById("dum");
    var cancel = document.getElementById("cancelDeletionOfUser");
    var passField = document.getElementById("deleteUserPassField");

    // Display ID of student that the user wants to delete
    span.innerHTML = btnID;

    // Open the modal
    modal.style.display = "block";

    cancel.onclick = function() {
        modal.style.display = "none";
        passField.value = "";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            passField.value = "";
        }
    }
}