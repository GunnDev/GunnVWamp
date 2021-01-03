function expandedSearchMenu() {
    // Get the modal
    var modal = document.getElementById("expandedSearchModal");

    // Get the save/close button
    var close = document.getElementById("saveAdvancedSearchBtn");

    modal.style.display = "block";

    // When the user clicks save
    close.onclick = function(event) {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function removeSearch() {
    window.location.href = "http://localhost/GunnVWamp/pages/students.php"; 
}