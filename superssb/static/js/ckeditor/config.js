/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'autogrow';
	config.autoGrow_minHeight = 300;        // 300 pixels high autgrow default
	config.height = 300;        // 300 pixels high ckeditor default

	config.toolbar = [
	    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
	    { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	    { name: 'justify', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
	    { name: 'editing', items: [ 'Find', 'Replace', 'SelectAll' ] },
	    { name: 'links',   items: [ 'Link', 'Unlink', 'Anchor' ] },
	    { name: 'insert',      items: [ 'Table', 'SpecialChar' ] },
	    { name: 'paragraph',   items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote' ] },
	    { name: 'tools',       items: [ 'Maximize' ] },
	    { name: 'code',        items: [ 'Source' ] },
	    // '/',
	    { name: 'fonts',       items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	    { name: 'insert',      items: [ 'Image' ] }
	];
	//config.skin = 'kama';
	config.filebrowserBrowseUrl = 'https://' + window.location.hostname + '/superssb/static/js/filemanager/index.html';
	//config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // PHP code
};
