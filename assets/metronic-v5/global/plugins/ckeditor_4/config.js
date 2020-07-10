/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'uploadimage,wordcount,notification,shortcodepost,lazyload';
	config.allowedContent = {
		shortcodepost: {
			attributes: 'data-*'
		},
	    $1: {
	        // Use the ability to specify elements as an object.
	        elements: CKEDITOR.dtd,
	        attributes: true,
	        styles: true,
	        classes: true
	    }
	};
	config.wordcount = {

	    // Whether or not you want to show the Paragraphs Count
	    showParagraphs: true,

	    // Whether or not you want to show the Word Count
	    showWordCount: true,

	    // Whether or not you want to show the Char Count
	    showCharCount: false,

	    // Whether or not you want to count Spaces as Chars
	    countSpacesAsChars: false,
	};
	config.removeButtons = 'Font,FontSize';
	config.disallowedContent = 'span{font,font-size,font-family}';
	config.extraAllowedContent ='*{data-*};script; *[on*];i;';
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
    config.protectedSource.push( /<\/i>/g );
};
