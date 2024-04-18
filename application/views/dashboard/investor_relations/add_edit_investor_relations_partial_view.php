add_edit_investor_relations_partial_view

<style type="text/css">
.ck.ck-editor {
  position: relative;
  width: 100% !important;
}
</style>

<!-- <script src="<?php echo(base_url());?>assets-admin/plugins/ckeditor5/build/ckeditor.js"></script> -->
 <!-- ckeditor -->
 <script src="<?php echo base_url(); ?>assets-admin/ckeditor/ckeditor.js"></script>
  <script>

    
// let theEditor;

// ClassicEditor
//     .create(document.querySelector('.editor'), {

//         toolbar: {
//             items: [
//                 'Source',
//                 'bold',
//                 'italic',
//                 'link',
//                 'bulletedList',
//                 'numberedList',
//                 '|',
//                 'outdent',
//                 'indent',
//                 '|',
//                 'insertTable',
//                 'undo',
//                 'redo',
//                 'heading',
//                 'alignment',
//                 'fontSize',
//                 'highlight',
//                 'htmlEmbed',
//                 'subscript',
//                 'superscript',
//                 'underline',
//                 'code',
//                 'fontFamily',
//                 'fontColor',
//                 'fontBackgroundColor',
//                 'findAndReplace',
//                 'strikethrough',
//                 'comment'
//             ]
//         },
//         language: 'en',
//         image: {
//             toolbar: [
//                 'imageTextAlternative',
//                 'imageStyle:inline',
//                 'imageStyle:block',
//                 'imageStyle:side'
//             ]
//         },
//         table: {
//             contentToolbar: [
//                 'tableColumn',
//                 'tableRow',
//                 'mergeTableCells'
//             ]
//         },
//         licenseKey: '',



//     })
//     .then(editor => {
//         window.editor = editor;




//     })
//     .catch(error => {
//         console.error('Oops, something went wrong!');
//         console.error(
//             'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
//             );
//         console.warn('Build id: vjthmprneoky-icn3x2a9jequ');
//         console.error(error);
//     });
  </script>

<div class="row">
<div class="col-md-12">
<label for="groupname">Title</label>
<div class="form-group">
  <div class="input-group input-group-sm">
   <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="" autocomplete="off">
 </div>
</div>                    
</div>  
</div> 

<div class="row">
<div class="col-md-12">
<label for="groupname">Page Url</label>
<div class="form-group">
  <div class="input-group input-group-sm">
   <input type="text" class="form-control" name="page_url" id="page_url" placeholder="" value="" autocomplete="off" readonly>
 </div>
</div>                    
</div>  
</div> 

<div class="row">

<div class="col-md-12">
    <label for="groupname"> Description</label>
    <div class="form-group" id="mail_bodyerr">
        <div class="input-group input-group-sm">
            <textarea class="form-control ckeditor" style="width: 100%;" name="description"
                id="description"></textarea>

        </div>
    </div>
</div>


</div>