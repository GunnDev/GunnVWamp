function showAOrD() { 
    var app_article = document.getElementById('approvedArticle');
    var dec_article = document.getElementById('declinedArticle');
    
    if(document.getElementById('approveSub').checked) {
        app_article.style.display = "block";
        dec_article.style.display = "none";
    } else if(document.getElementById('declineSub').checked) {
        dec_article.style.display = "block"
        app_article.style.display = "none";
    }
}