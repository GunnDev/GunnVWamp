function deleteHour() {
    // Get the modal
    var modal = document.getElementById("dtfm");

    // Get the <span> element that closes the modal
    var cancelBtn = document.getElementById("cancelFileDelete");

    modal.style.display = "block";

    // When the user clicks on cancel, close the modal
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}