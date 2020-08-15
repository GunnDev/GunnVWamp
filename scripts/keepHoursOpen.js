// Keep the add hours modal open

jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=max") > -1) {
        addHour();
    }
});
jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=success") > -1) {
        addHour();
    }
});
jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=toobig") > -1) {
        addHour();
    }
});
jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=err") > -1) {
        addHour();
    }
});
jQuery(document).ready(function($) {
    if(window.location.href.indexOf("?upload=ftype") > -1) {
        addHour();
    }
});