showfiles = function() {
    var input = document.getElementById('fileInput');
    var output = document.getElementById('show_file_list');
    var selectedFiles = document.getElementById('selFTitle');

    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '' + input.files.item(i).name + ', <br>';
    }

    selectedFiles.innerHTML = 'Selected Files: ';
    output.innerHTML = '<p style="margin-top: 5px; padding: 0; font-size: 14px;">' + children + '</p>';
}