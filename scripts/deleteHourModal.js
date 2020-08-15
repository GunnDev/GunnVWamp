function deleteHour(ele) {
    // Show the filename the user is deleting
    var btnID = ele.id;
    
    var file = document.getElementById(btnID);
    var fileName = file.getAttribute("data-ffname");
    if (fileName.length > 15){
        fileName = fileName.substring(0, 23) + '...';
    }

    var fileNameDisplay = document.getElementById("deleteFileHeading");
    var title = "";
    fileNameDisplay.innerHTML = title.concat(fileName, "?");

    // Submit the file we want to delete through the form
    var f = document.getElementById("deletingFile");
    f.value = btnID;

    // Get the modal
    var modal = document.getElementById("dtfm");

    // Get the <span> element that closes the modal
    var cancelBtn = document.getElementById("cancelFileDelete");

    // Show the modal
    modal.style.display = "block";

    // When the user clicks on cancel, close the modal
    cancelBtn.onclick = function() {
        modal.style.display = "none";
        document.getElementById("deleteForm").reset();
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            document.getElementById("deleteForm").reset();
        }
    }
}