function addHour() {
    // Get the modal
    var modal = document.getElementById("add_h");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("ahp-close")[0];

    modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";

        // Reset the form and update selected file display
        document.getElementById("addForm").reset();
        showfiles();

        // Clear upload message
        var filemsg = document.getElementById("filemsg");
        if (filemsg) {
            filemsg.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";

            // Reset the form and update selected file display
            document.getElementById("addForm").reset();
            showfiles();

            // Clear upload message
            var filemsg = document.getElementById("filemsg");
            if (filemsg) {
                filemsg.style.display = "none";
            }
        }
        // Remove upload var
        history.pushState('dash', 'Gunn Volunteering | Dashboard', 'http://localhost/GunnVWamp/pages/dashboard.php');
    }
}