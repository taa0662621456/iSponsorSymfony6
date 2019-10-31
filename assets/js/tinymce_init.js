// Creates links to the TinyMCE
var tinymce = require('tinymce');

require('tinymce/themes/silver/index');
require('tinymce/plugins/image');

let form = document.querySelector('#tinymce_editor');
//console.dir(form); console.log(form.dataset.id);
tinymce.init({
    selector: '#post_content',
    plugins: 'image',
    toolbar: 'undo redo | link image',
    automatic_uploads: true,
    images_upload_url: '/attachment/' + form.dataset.id,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    }
});
