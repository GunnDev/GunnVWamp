function deleteUser(btnID) {
    var span = document.getElementById("usersIDToDelete");
    span.innerHTML = btnID;
    
    // Get the modal
    var modal = document.getElementById("dum");

    // Open the modal
    modal.style.display = "block";

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}