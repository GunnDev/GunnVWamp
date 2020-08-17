// Keep the add hours modal open

jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=max") > -1) {
        addHour();
    }
    if(window.location.href.indexOf("?upload=success") > -1) {
        addHour();
    }
    if(window.location.href.indexOf("?upload=err") > -1) {
        addHour();
    }
    if(window.location.href.indexOf("?upload=toobig") > -1) {
        addHour();
    }
    if(window.location.href.indexOf("?upload=ftype") > -1) {
        addHour();
    }
    if(window.location.href.indexOf("?upload=err") > -1) {
        addHour();
    }
});

// Keep the delete hours modal open

jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?delete=pass") > -1) {
        var fileID = getQueryVariable('req');
        deleteHour(fileID);
    }
    if(window.location.href.indexOf("?delete=failure") > -1) {
        var fileID = getQueryVariable('req');
        deleteHour(fileID);
    }
});

jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?deleteAll=err") > -1) {
        deleteAllFiles();
    }
    if(window.location.href.indexOf("?deleteAll=pass") > -1) {
        deleteAllFiles();
    }
    if(window.location.href.indexOf("?deleteAll=failure") > -1) {
        deleteAllFiles();
    }
});

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
    }
    return(false);
}