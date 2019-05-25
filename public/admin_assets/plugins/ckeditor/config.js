/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.language = 'en';
    config.uiColor = '#9AB8F3';
    config.height = 350;
    config.toolbarCanCollapse = true;
    config.width = 'auto';
    config.filebrowserImageBrowseUrl = '../ckfinder/ckfinder.html?Type=Images';
    config.filebrowserFlashBrowseUrl = '../ckfinder/ckfinder.html?Type=Flash';
    config.filebrowserImageUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
