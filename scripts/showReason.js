function showReason(reason) {
    // Get the modal
    var modal = document.getElementById("showDeclineMessage");
    var textBox = document.getElementById("pToShowReason");

    // Show the modal
    modal.style.display = "block";

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    textBox.innerHTML = "\"" + reason + "\"";
}