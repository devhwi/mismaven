jQuery(document).ready(function($) {

    // Create 'keyup_event' tinymce plugin
    tinymce.PluginManager.add('keyup_event', function(editor, url) {

        // Create keyup event
        editor.on('keyup', function(e) {

            // Get the editor content (html)
            get_ed_content = tinymce.activeEditor.getContent();
			id             = $(this).attr('id');
            // Do stuff here... (run do_stuff_here() function)
            do_stuff_here(id,get_ed_content);
		
        });
    });

    // This function allows the script to run from both locations (visual and text)
    function do_stuff_here(id,content) {

        // Now, you can further process the data in a single function
        $('#'+id).val(content);
    }
});