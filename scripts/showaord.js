function showAOrD() { 
    var app_article = document.getElementsByName('approvedArticle');
    var dec_article = document.getElementsByName('declinedArticle');
    
    if(document.getElementById('approveSub').checked) {
        console.log('a');
    } else if(document.getElementById('declineSub').checked) {
        console.log('d');
    }
}