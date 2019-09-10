// Creates links to the TinyMCE
import tinymce from 'tinymce';
import "tinymce/themes/silver";
import "tinymce/plugins/image";


let form = document.querySelector('#tinymce_editor');
//console.dir(form); console.log(form.dataset.id);
form.dataset.id = undefined;
tinymce.init({
    selector: '#post_content',
    plugins: 'image',
    toolbar: 'undo redo | link image',
    automatic_uploads: true,
    images_upload_url: '/attachment/' + form.dataset.id,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
            const file = this.files[0];

            const reader = new FileReader();
            reader.onload = function () {
                const id = 'blobid' + (new Date()).getTime();
                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                const base64 = reader.result.split(',')[1];
                const blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    }
});
