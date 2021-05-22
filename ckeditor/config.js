
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	CKEDITOR.config.format_tags = 'p;h2;h3;h4;h5;h6;pre;address;div';
	config.extraPlugins = 'moxiemanager,specialchar';
	config.toolbar_Full = [
        ['Source','Paste','PasteText','PasteFromWord','-','Undo','Redo','Spell Check As You Type'],
        ['Bold','Italic','Underline','Strike','Subscript','Superscript','RemoveFormat'],
        ['NumberedList','BulletedList','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		 ['Link','Unlink','Anchor'],
        ['Image','Table','PageBreak','SpecialChar','Iframe','Smiley'],		
        ['Styles','Format','Font','FontSize','ShowBlocks'],
		['TextColor','BGColor'],
		['About']
        ] ;
		
		 config.toolbar_Basic = [
        ['Source','Paste','PasteText','PasteFromWord'],
        ['Bold','Italic','Underline'],      
		['Link','Unlink'],
        ['SpecialChar'],		
		['About']
        ] ;
	//config.contentsCss = BASEURL+'ckeditor/css/editor.css';
			
    config.removeDialogTabs = 'link:upload;image:Upload';
    CKEDITOR.config.allowedContent = true;   
   CKEDITOR.env.isCompatible = true;
};

CKEDITOR.on('instanceReady', function (ev) {
// Ends self closing tags the HTML4 way, like <br>.
ev.editor.dataProcessor.htmlFilter.addRules(
    {
        elements:
        {
            $: function (element) {
                // Output dimensions of images as width and height
                if (element.name == 'img') {
                    var style = element.attributes.style;

                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];

                        if (width) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            element.attributes.width = width;
                        }

                        if (height) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            element.attributes.height = height;
                        }
                    }
                }



                if (!element.attributes.style)
                    delete element.attributes.style;

                return element;
            }
        }
    });
});
