/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.disableAutoInline = true;
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	//config.extraPlugins = 'tableresize';
	config.extraPlugins = 'image';
	config.extraPlugins = 'dialog';
	config.extraPlugins = 'link';
	config.extraPlugins = 'save';

	//config.extraPlugins = 'scayt';
	config.language = 'en';
	config.skin = 'moono';
   // config.extraPlugins = 'slideshow';
   config.extraPlugins = 'oembed';
   config.allowedContent = true;

	//config.extraPlugins = 'sourcedialog';
	//config.removePlugins= 'sourcearea';
	config.extraPlugins = 'codemirror';



    config.filebrowserBrowseUrl          = './assets/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl     = './assets/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl     = './assets/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl          = './assets/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl     = './assets/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl     = './assets/kcfinder/upload.php?type=flash';

    config.toolbar_admin =
    [
        { name: 'document', items : [ 'Source','Sourcedialog', '-', 'Templates', 'DocProps' ] },
        { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
               'HiddenField' ] },
        { name: 'styles', items : [ 'FontSize' ] },
        { name: 'links', items : [ 'Link','Unlink'] },
        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','RemoveFormat' ] },
        { name: 'paragraph', items : ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','BulletedList' ] },
        { name: 'colors', items : [ 'TextColor','BGColor' ] },
        { name: 'insert', name:'save',items : [ 'Image','Flash','Table', 'Iframe', 'oembed','Slideshow' ] }
    ];

	 config.toolbar_webmaster =
    [
        { name: 'document', items : [ 'Source','Sourcedialog', '-', 'Templates', 'DocProps' ] },
        { name: 'styles', items : [ 'FontSize' ] },
        { name: 'links', items : [ 'Link','Unlink'] },
        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','RemoveFormat' ] },
        { name: 'colors', items : [ 'TextColor','BGColor' ] },
        { name: 'insert', name:'save',items : [ 'Image','Flash','Table', 'Iframe', 'oembed' ] }
    ];

    config.toolbar_defaultSmall =
    [
          { name: 'document', items : [ 'Source'] },
          { name: 'insert', items : [ 'Image', 'Link' ] }
    ];

    config.toolbar_default =
    [
        { name: 'links', items : [ 'Link','Unlink'] },
        { name: 'basicstyles', items : [ 'RemoveFormat' ] },
        { name: 'insert', name:'save',items : [ 'Image' ] }
    ];

    config.toolbar_embedVideo =
    [
        { name: 'links', items : [ 'Link','Unlink'] },
        { name: 'basicstyles', items : [ 'RemoveFormat' ] },
        { name: 'insert', name:'save',items : [ 'Image','Flash', 'Iframe','oembed' ] }
    ];


//config.toolbar = 'Full';
config.toolbar_Full =
[
	{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
        'HiddenField' ] },
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	'/',
	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
];

    config.resize_enabled = false;

	/**
	 * 'Ctrl-K' to comment the currently selected text
	 'Ctrl-Shift-K' to uncomment currently selected text
	 'Ctrl-Alt-K' to auto format currently selected text
	 'Ctrl-Q' Expand/Collapse Code Block
	 'Ctrl-F' to perform a search
	 'Ctrl-G' to find next
	 'Ctrl-Shift-G' to find previous
	 'Ctrl-Shift-F' to find and replace
	 'Ctrl-Shift-R' to find and replace all
	 */
// cofigure codemirror
	config.codemirror = {

	 	    // Set this to the theme you wish to use (codemirror themes)
	 	    theme: 'default',

	 	    // Whether or not you want to show line numbers
	 	    lineNumbers: true,

	 	    // Whether or not you want to use line wrapping
	 	    lineWrapping: true,

	 	    // Whether or not you want to highlight matching braces
	 	    matchBrackets: true,

	 	    // Whether or not you want tags to automatically close themselves
	 	    autoCloseTags: true,

	 	    // Whether or not you want Brackets to automatically close themselves
	 	    autoCloseBrackets: true,

	 	    // Whether or not to enable search tools, CTRL+F (Find), CTRL+SHIFT+F (Replace), CTRL+SHIFT+R (Replace All), CTRL+G (Find Next), CTRL+SHIFT+G (Find Previous)
	 	    enableSearchTools: true,

	 	    // Whether or not you wish to enable code folding (requires 'lineNumbers' to be set to 'true')
	 	    enableCodeFolding: true,

	 	    // Whether or not to enable code formatting
	 	    enableCodeFormatting: true,

	 	    // Whether or not to automatically format code should be done when the editor is loaded
	 	    autoFormatOnStart: true,

	 	    // Whether or not to automatically format code should be done every time the source view is opened
	 	    autoFormatOnModeChange: true,

	 	    // Whether or not to automatically format code which has just been uncommented
	 	    autoFormatOnUncomment: true,

	 	    // Whether or not to highlight the currently active line
	 	    highlightActiveLine: true,

	 	    // Define the language specific mode 'htmlmixed' for html including (css, xml, javascript), 'application/x-httpd-php' for php mode including html, or 'text/javascript' for using java script only
	 	    mode: 'htmlmixed',

	 	    // Whether or not to show the search Code button on the toolbar
	 	    showSearchButton: true,

	 	    // Whether or not to show Trailing Spaces
	 	    showTrailingSpace: true,

	 	    // Whether or not to highlight all matches of current word/selection
	 	    highlightMatches: true,

	 	    // Whether or not to show the format button on the toolbar
	 	    showFormatButton: true,

	 	    // Whether or not to show the comment button on the toolbar
	 	    showCommentButton: true,

	 	    // Whether or not to show the uncomment button on the toolbar
	 	    showUncommentButton: true,

	 	    // Whether or not to show the showAutoCompleteButton button on the toolbar
	 	    showAutoCompleteButton: true

	 	};


};
/*
CKEDITOR.on('dialogDefinition', function(ev) {
      // Take the dialog name and its definition from the event data
      var dialogName = ev.data.name;
      var dialogDefinition = ev.data.definition;

      if (dialogName == 'image') {
         dialogDefinition.onOk = function(e) {
             alert('sa speram ca s-a terminat');
            var imageSrcUrl = e.sender.originalElement.$.src;
            var imgHtml = CKEDITOR.dom.element.createFromHtml("<img src=" + imageSrcUrl + " alt='' align='right'/>");
            CKEDITOR.instances.body.insertElement(imgHtml);
         };
      }
});*/
