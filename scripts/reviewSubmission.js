function reviewSubmission(e) {
    idOfElem = e.id;
    ffriInfo = e.getAttribute('data-fileID');
    
    var submitReviewTitleName = document.getElementById("submitReviewTitleName");
    var reviewNameToDisplay = idOfElem.split("-");
    var section = document.getElementById("rfSection");
    var fileForReviewInfo = document.getElementById("fileForReviewInfo");

    reviewNameToDisplay = reviewNameToDisplay[0] + " " + reviewNameToDisplay[1] + "'s " + reviewNameToDisplay[2];
    submitReviewTitleName.innerHTML = reviewNameToDisplay;
    section.style.display = "block";

    fileForReviewInfo.value = ffriInfo;
}