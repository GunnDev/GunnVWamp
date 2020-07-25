showfiles = function() {
    var input = document.getElementById('fileInput');
    var output = document.getElementById('show_file_list');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<ul>'+children+'</ul>';
}