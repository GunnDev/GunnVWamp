function reviewSubmission(e) {
    idOfElem = e.id;
    
    var submitReviewTitleName = document.getElementById("submitReviewTitleName");
    var reviewNameToDisplay = idOfElem.split("-");
    var section = document.getElementById("rfSection");

    reviewNameToDisplay = reviewNameToDisplay[0] + " " + reviewNameToDisplay[1] + "'s " + reviewNameToDisplay[2];
    submitReviewTitleName.innerHTML = reviewNameToDisplay;
    section.style.display = "block";
}