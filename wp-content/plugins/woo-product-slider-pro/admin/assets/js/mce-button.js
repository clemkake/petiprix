(function() {
	tinymce.PluginManager.add('sp_wpsp_mce_button', function( editor, url ) {
		editor.addButton('sp_wpsp_mce_button', {
			text: false,
            icon: false,
			image: url + '/icon.svg',
			tooltip: 'Product Slider Pro for WooCommerce',
            onclick: function () {
                editor.windowManager.open({
                    title: 'Insert Shortcode',
					width: 400,
					height: 100,
					body: [
						{
							type: 'listbox',
							name: 'listboxName',
                            label: 'Select Shortcode',
							'values': editor.settings.spWPSPShortcodeList
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[woo-product-slider-pro id="' + e.data.listboxName + '"]');
					}
				});
			}
		});
	});
})();