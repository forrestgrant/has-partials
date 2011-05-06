(function() {	
	tinymce.create('tinymce.plugins.ratings_mce', {
		init : function(ed, url) {
			
			ed.addCommand('insertPartial', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 360 + ed.getLang('HasPartials.delta_width', 0),
					height : 100 + ed.getLang('HasPartials.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});
			
			ed.addButton('partial', {
				title : 'Add a Partial',
				image : url + '/partial.png',
				cmd : 'insertPartial',		
			});
		},


		getInfo : function() {
			return {
				longname : 'Has Partials MCE Buttons',
				author : 'Forrest Grant',
				authorurl : 'http://www.forrestgrant.com/',
				infourl : '',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
		
	});

	// Register plugin
	tinymce.PluginManager.add('ratings_mce', tinymce.plugins.ratings_mce);
	
})();