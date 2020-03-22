CKEDITOR.dialog.add( 'shortcodePostDialog', function( editor ) {
    return {
        title: 'Shortcode Post URL',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Basic Settings',
                elements: [
                    {
                        type: 'text',
                        id: 'data-id',
                        label: 'Id',
                        hidden : 'true',
                        validate: CKEDITOR.dialog.validate.notEmpty( "ID Post can't be empty." ),
                        setup: function( element ) {
                            this.setValue( element.getAttribute( "data-id" ) );
                        },
                        commit: function( element ) {
                            element.setAttribute( "data-id", this.getValue() );
                        }
                    },
                    /*{
                        type: 'text',
                        id: 'data-url',
                        label: 'URL',
                        validate: CKEDITOR.dialog.validate.notEmpty( "URL can't be empty." ),
                        setup: function( element ) {
                            this.setValue( element.getAttribute( "data-url" ) );
                        },
                        commit: function( element ) {
                            element.setAttribute( "data-url", this.getValue() );
                        }
                    },*/
                    {
                        type: 'text',
                        id: 'text',
                        label: 'Text',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Text can't be empty." ),
                        setup: function( element ) {
                            this.setValue( element.getText());
                        },
                        commit: function( element ) {
                            element.setText( this.getValue() );
                        }
                    },
                    {
                        type : 'button',
                         id : 'browseInternal',
                         label : 'Link to CMS Post',    // See Note 2
                         filebrowser :
                         {
                             action : 'Browse',
                             url : 'api/browse-post-list'    // See Note 3
                         }
                    }
                ]
            }
        ],
        onShow: function() {
            var selection = editor.getSelection();
            var element = selection.getStartElement();

            if ( element )
                element = element.getAscendant( 'shortcodepost', true );

            if ( !element || element.getName() != 'shortcodepost' ) {
                element = editor.document.createElement( 'shortcodepost' );
                this.insertMode = true;
            }
            else
                this.insertMode = false;

            this.element = element;
            if ( !this.insertMode )
                this.setupContent( this.element );
        },
        onOk: function() {
            var dialog = this;
            var abbr = this.element;
            this.commitContent( abbr );

            if ( this.insertMode )
                editor.insertElement( abbr );
        }
    };
});