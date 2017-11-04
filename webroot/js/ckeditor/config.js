/**
 * Created by maicon on 20/06/2017.
 */

CKEDITOR.plugins.add('extra_buttons',
    {
        init: function (editor) {
            var pluginName = 'extra_buttons';
            editor.ui.addButton('addFile',
                {
                    label: 'Upload',
                    command: 'upload',
                    icon: '/filemanager/img/upload.png'
                });
            var cmd = editor.addCommand('upload', { exec: showMyDialog1 });
        }
    });

function showMyDialog1(e) {
    //e.insertHtml(' Hello ');
    window.open('/filemanager/dialog.php?type=1&editor=ckeditor&fldr=', 'FileManager', 'scrollbars=no,scrolling=no,location=no,toolbar=no');
}

CKEDITOR.editorConfig = function( config ) {

    config.language = 'pt-br';
    config.height = '400px';

    config.extraPlugins = 'extra_buttons';

    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
        {name: 'forms', groups: ['forms']},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
        {name: 'links', groups: ['links']},
        {name: 'insert', groups: ['insert']},
        '/',
        {name: 'styles', groups: ['styles']},
        {name: 'colors', groups: ['colors']},
        {name: 'tools', groups: ['tools']},
        {name: 'others', groups: ['others']},
        {name: 'about', groups: ['about']}
    ];

    config.removeButtons = 'Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Language,CreateDiv,BidiLtr,BidiRtl,Flash,PageBreak,Iframe,About';
}

