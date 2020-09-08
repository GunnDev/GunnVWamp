function reviewSubmission(e) {
    idOfElem = e.id;
    ffriInfo = e.getAttribute('data-fileID');
    
    var submitReviewTitleName = document.getElementById("submitReviewTitleName");
    var reviewNameToDisplay = idOfElem.split("-");
    var section = document.getElementById("rfSection");
    var fileForReviewInfoApprove = document.getElementById("fileForReviewInfoApprove");
    var fileForReviewInfoDecline = document.getElementById("fileForReviewInfoDecline");

    reviewNameToDisplay = reviewNameToDisplay[0] + " " + reviewNameToDisplay[1] + "'s " + reviewNameToDisplay[2];
    submitReviewTitleName.innerHTML = reviewNameToDisplay;
    section.style.display = "block";

    fileForReviewInfoApprove.value = ffriInfo;
    fileForReviewInfoDecline.value = ffriInfo;
}

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;

    key = String.fromCharCode( key );

    var regex = /[0-9]|\./;

    if(!regex.test(key)) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function validateTwo(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;

  key = String.fromCharCode( key );

  var regex = /[A-Za-z0-9@ ]|\./;

  if(!regex.test(key)) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}