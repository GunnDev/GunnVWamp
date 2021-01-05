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
    window.location.href = "http://localhost/GunnVWamp/pages/students.php?&g1=1&g2=1&g3=1&g4=1&adv=t"; 
}

window.onload = function() {
    var url_string = window.location.href;
    var url = new URL(url_string);

    var sT = url.searchParams.get("st");
    var g1 = url.searchParams.get("g1");
    var g2 = url.searchParams.get("g2");
    var g3 = url.searchParams.get("g3");
    var g4 = url.searchParams.get("g4");

    if(g1 == 1) {
        document.getElementById('grade1').checked = true;
    } else {
        document.getElementById('grade1').checked = false;
    }

    if(g2 == 1) {
        document.getElementById('grade2').checked = true;
    } else {
        document.getElementById('grade2').checked = false;
    }

    if(g3 == 1) {
        document.getElementById('grade3').checked = true;
    } else {
        document.getElementById('grade3').checked = false;
    }

    if(g4 == 1) {
        document.getElementById('grade4').checked = true;
    } else {
        document.getElementById('grade4').checked = false;
    }

    console.log(sT);

    if(sT == "F") {
        document.getElementById('alphabeticalF').checked = true;
    } else if (sT == "L") {
        document.getElementById('alphabeticalL').checked = true;
    }
}