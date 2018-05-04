if( typeof linchpin === 'undefined' ) { // create new linchpin object if one doesn't exist
	linchpin = {};
}

linchpin.utils = function( $ ) {

	// Private Variables
	var $win  = $(window),
        $body = $('body'),
		$doc  = $(document);

	return {

        /**
         * XSS protection for front end data
         */

        escapeHTML : function(str) {
            var div = document.createElement('div');
            div.appendChild( document.createTextNode(str) );
            return div.innerHTML;
        },

        /**
         * UNSAFE with unsafe strings; only use on previously-escaped ones!
         */

        unescapeHTML : function(escapedStr) {
            var div = document.createElement('div');
            div.innerHTML = escapedStr;
            var child = div.childNodes[0];
            return child ? child.nodeValue : '';
        },

		/**
		 * Find a label
		 * @param $fld[jQuery Object] : the field we are targeting.
		 */
		find_field_label : function( $fld ) {

			var type = $fld.attr('type'),

				// objects

				$fld_p = $fld.parent(),
				$fld_p_p = $fld_p.parent(),
				$lbl = $fld.prev('label:first'); // take a shot a finding our first label

			if( $lbl.length === 0 ) {
				$lbl = $fld.next('label:first'); // it wasn't prev, but maybe it's next?
			}

			if( type !== 'password' ) { // not a password field

				if( $fld.hasClass('comment-input') ) { // comment labeling
					$lbl = $fld.prev('.comment-label:first');
				} else if ( $fld.hasClass('mc_input') ) {
					$lbl = $fld.prev('.mc_var_label:first');
				}

				if ($fld_p_p.attr('id') === 'constant-contact-signup') {
					$lbl = $fld_p_p.find('label:first');
				}

			} else { // it's a password field
				$fld_p.css('position', 'relative');
				$lbl.css({'position':'absolute', 'top':'0', 'left':'0'});
			}

			if($lbl.length === 0) {
				$lbl = $fld.closest('.gfield').children('label'); // just try to grab something
			}

			return $lbl;
		},

		/**
		 * Setup our form to have inline labeling
		 * TODO: Optimize selection
		 * @param: exclude_elements[String] : A string of elements to exclude from applying the inline labels to
		 * @author aware
		 */
		setup_form_fields : function(exclude_elements) {
			var $submit  = $('input[type="submit"]'),
				accepted = ['text', 'password', 'textarea', 'email', 'tel'],
				$fields  = $('input, textarea').not( $(exclude_elements) ).each(function() {

					if ( $.inArray(this.type, accepted) === -1 ) { // make sure it's an accepted field or return
						return;
					}

					var $fld = $(this),
						$fld_p = $fld.parent(),
						$fld_p_p = $fld_p.parent(),
						$lbl,
						fld_lbl,
						type = this.type,
						fld_val = $fld.val();

					$lbl = linchpin.utils.find_field_label( $fld );

					fld_lbl = linchpin.utils.escapeHTML( $lbl.text() );

					$fld.data('lbl', fld_lbl).data('label', $lbl);

					if(fld_lbl != undefined && fld_lbl != 'undefined' && fld_lbl != '') {

						// Only set our field values/labels if the field isn't a password field
						if (type != 'password') {
							if ( undefined === fld_val || '' === fld_val || 'undefined' == fld_val ) {
								$lbl.hide();
								$fld.data('lbl', fld_lbl).attr('placeholder', fld_lbl).val( $fld.data('lbl') );
							}
						}

						//Remove values on focus and reset on blur
						$fld.on('focus', function(event) {
							var $tgt = $(this),
								$lbl = $tgt.data('label'),
								 val = linchpin.utils.escapeHTML( event.target.value );

							if (undefined === val || $tgt.data('lbl') === val || '' === val || 'undefined' === val ) {
								$tgt.val('').attr('placeholder', $tgt.data('lbl') );
							}

							if ($tgt.hasClass('gfield_error')) {
								$tgt.data('gfield_error', true);
							}

							if ($tgt.attr('type') === 'password') {
								$lbl.hide();
							}

							$tgt.parent().parent().find('.validation_message').fadeOut('fast');

						}).on('blur', function(event) {
							var $tgt = $(this),
								 val = event.target.value,
								 lbl = $tgt.data('lbl');

							if (undefined === val || $tgt.data('lbl') === val || '' === val || 'undefined' === val ) {
								if ($tgt.attr('type') !== 'password') {
									$tgt.val(lbl);
									$tgt.parent().parent().find('.validation_message').fadeIn('fast');
									if ($tgt.data('gfield_error') === true) {
										$tgt.closest('li').addClass('gfield_error');
									}
								} else {
									$lbl.show();
								}
							} else {
								if ($tgt.attr('type') == 'password') {
									$lbl.hide();
								}
								$tgt.closest('.gfield_error').removeClass('gfield_error');
							}
						});

						$('input[name="addtocart"]').on('click', function() {
							$(this).closest('form').find('input[type="text"], textarea').each(function() {
								var $tgt = $(this);
								if ( $tgt.val() === $tgt.data('lbl') ) {
									$tgt.val('');
								}
							});
						});

					}

					// If the field is being autofilled by webkit, hide our label
					$win.load(function() {
						if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
							$('input:-webkit-autofill').each(function() {
								$(this).parent().find('label').css('display', 'none');
							});
						}
					});

				});
			/**
			 * On submit we want to make sure we clear out the fields so validation works properly
			 */
			$body.on('click', $submit, function() {
				$fields.each(function() {
					var $fld = $(this),
						 val = $fld.val(),
						 lbl = $fld.data('lbl');
					if (val === lbl) {
						$fld.val('');
					}
				});
			});

		}, // END setup_form_fields()

		setup_foundation_form_errors : function() {
			$('.gfield_contains_required').addClass('error').each(function() {
				var $message = $(this).find('.validation_message'),
					msg		 = $message.text();

					$message.remove();
					$(this).append('<small>' + msg + '</small>');
			});
		},

		/**
		 * Equalize heights for multiple children
		 * @author mmorgan
		 */
		lp_equalizer : function () {
	        var $this = $(this), // Parent item with data-lp-equal tag
	        	$items = $this.data('lp-equal-items'), // Items that hold the children to be equalized
	        	$children = $this.data('lp-equal-children'), // String of elements to equal, comma seperated
		        _tall; // Set this for future use

		    // If children are set, make an array of them
		    if ( $children != ('' || null || undefined) ) var _children = $children.split(',');

	        // If data-lp-equal-items is not set, have $items be the direct children of the parent element
	        if ( $items == ('' || null || undefined) ) $items = $this.children();

	        // If the children are set, equalize each child in the items
	        if ( $children != ('' || null || undefined) ) {

		        // Loop through each child element to equalize
		        for ( var i = 0; i < _children.length; i++ ) {
			        _tall = 0; // Reset to 0 for each element being equalized

			        // Check the heights and find the tallest of a given element
			        // in an items parent container.
			        $($items, $this).find(_children[i]).each(function () {
				        var $item = $(this);

				        if  ( $item.height() > _tall ) _tall = $item.height();
				    } ).height(_tall);
			        // Then set the height of that element.
			    }

		    // If no child are set, do a standard equalize to each item
		    } else {

		        _tall = 0;

		        $($items, $this).each(function () {
			        if ( $(this).height() > _tall ) _tall = $(this).height();
			    } ).height(_tall);

			}


	        /* Quick example of markup
		     * <div data-lp-equal data-lp-equal-items="article" data-lp-equal-children="h2, .post-text">
		     *  <article>
		     *    <h2>Article title</h2>
		     *    <p class="post-text">Lorem ipsum</p>
		     *  </article>
		     *
		     *  <article>
		     *    <h2>Article title for the second article is a lot longer.</h2>
		     *    <p class="post-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		     *  </article>
		     * </div>
		     */
        },

		/**
		 * Control the hatch theme's javascript initialization
		 * @since 1.2
		 */
		init: function( ) {
			// Make sure we want infield labels before we go through our setup

			if (typeof hatch !== 'undefined') {
				if ( hatch.infield_labels ) {
					hatch.utils.setup_form_fields();
				}
			}
			/*
			 * Control opening links in an external window. W/O using the
			 * target="_blank" attribute so we stay valid for xhtml & html 5 markup
			 * be sure to do this "on" so if we use any ajax these methods still work
			 * @author aware
			 */
			$body.on('click', 'a.external-link, .external-link a', function(event) {
				event.preventDefault();
				event.stopImmediatePropagation();
				window.open(this.href);
			}) // do no close so we can chain our next click event
			/*
			 * Define an entire container as clickable. This functionality will look
			 * for the first <a> tag it finds within the container and make that the
			 * link it utilizes.
			 * @author aware
			 */
			.on('click', '.clickable', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var $tgt       = $(this),
					$a         = $tgt.find('a:first'),
					uri        = $a.attr('href'),
					new_window = $tgt.hasClass('external-link') || $a.hasClass('external-link') || event.metaKey || event.ctrlKey;

				if ( new_window ) {
					window.open(uri);
				} else {
					window.location = uri;
				}

				return false;
			})

			.bind('gform_post_render', linchpin.utils.setup_form_fields);

			var $equalizers = $('[data-lp-equal]');

			if ( $equalizers.length ) {
				$equalizers.each( linchpin.utils.lp_equalizer );
			}
		}
	};
}(jQuery);

jQuery(function( $ ) {
	linchpin.utils.init();
});