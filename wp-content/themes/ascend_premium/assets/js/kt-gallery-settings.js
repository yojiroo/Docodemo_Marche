(function($) {
	// no errors
	var media = wp.media;

	// Wrap the render() function to append controls.
	media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
		render: function() {
			var $el = this.$el;

			media.view.Settings.prototype.render.apply( this, arguments );

			// Append the type template and update the settings.
			$el.append( media.template( 'custom-gallery-setting' ) );
			media.gallery.defaults.type = 'default';
			this.update.apply( this, ['type'] );
			media.gallery.defaults.caption = 'default';
			this.update.apply( this, ['caption'] );
			media.gallery.defaults.masonry = 'default';
			this.update.apply( this, ['masonry'] );
			$el.find( 'select[name=size]' ).closest( 'label.setting' ).hide();
			$el.find( '.slider-settings' ).hide();
			// Hide the Columns setting for all types except Default
			function settings_setup() {
				var value = $el.find( 'select[name=kt_type]' ).val();
				var columnSetting = $el.find( 'select[name=columns]' ).closest( 'label.setting' );
				var slidersettings = $el.find( '.slider-settings' );

				if ( 'default' === value || 'carousel' === value ) {
					columnSetting.show();
				} else {
					columnSetting.hide();
				}
				if ( 'slider' === value ) {
					slidersettings.show();
				} else {
					slidersettings.hide();
				}
			}
			settings_setup();
			$el.find( 'select[name=kt_type]' ).on( 'change', function () {
				settings_setup();
			} ).change();

			return this;
		}
	});
})(jQuery);
	