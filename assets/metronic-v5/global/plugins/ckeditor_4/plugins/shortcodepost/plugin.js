CKEDITOR.plugins.add( 'shortcodepost', {
    icons: 'shortcodepost',
    init: function( editor ) {
        editor.addCommand( 'shortcodepost', new CKEDITOR.dialogCommand( 'shortcodePostDialog' ) );

        editor.ui.addButton( 'Shortcodepost', {
            label: 'Insert Shortcode Post URL',
            command: 'shortcodepost',
            toolbar: 'insert'
        });

        if ( editor.contextMenu ) {
            editor.addMenuGroup( 'shortcodePostGroup' );
            editor.addMenuItem( 'shortcodePostItem', {
                label: 'Edit Shortcode',
                icon: 'shortcodepost',
                command: 'shortcodepost',
                group: 'shortcodePostGroup'
            });

            editor.contextMenu.addListener( function( element ) {
                if ( element.getAscendant( 'shortcodepost', true ) ) {
                    return { shortcodePostItem: CKEDITOR.TRISTATE_OFF };
                }
            });
        }

        CKEDITOR.dialog.add( 'shortcodePostDialog', this.path + 'dialogs/shortcodepost.js' );
    }
});