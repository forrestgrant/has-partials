function insertPartialCode() {
	
	var tagtext;
	
	var partial = document.getElementById('partial').value;
	var tagtext = "[has_partial " + partial + "]";
	
	if(window.tinyMCE) {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}