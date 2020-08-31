function reviewSubmission(e) {
    idOfElem = e.id;
    
    var submitReviewTitleName = document.getElementById("submitReviewTitleName");
    submitReviewTitleName.innerHTML = idOfElem;
}