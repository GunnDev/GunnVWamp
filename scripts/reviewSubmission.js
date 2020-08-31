function reviewSubmission(e) {
    idOfElem = e.id;
    
    var submitReviewTitleName = document.getElementById("submitReviewTitleName");
    var reviewNameToDisplay = idOfElem.split("-");
    reviewNameToDisplay = reviewNameToDisplay[0] + " " + reviewNameToDisplay[1] + "'s " + reviewNameToDisplay[2];
    submitReviewTitleName.innerHTML = reviewNameToDisplay;
}