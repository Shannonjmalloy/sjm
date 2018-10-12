/**
 *
 * Base theme javascript file
 * Put all your scripts related to your theme in here.
 * Keep in mind that this file will get concatenated into
 * a singular file.
 *
 */

// If we don't have an object for our theme create it.

if( typeof(sjm) == 'undefined' ) {
    sjm = {};
}

sjm.site = function ( $ ) {
    // Private Variables
    var $window    = $(window),
        $doc       = $(document),
        $body      = $('body'),
        $photo_slider               = $('.photo-slider'),

        self;

    return {
        /*
         * function init
         * Kick off all of the business
         */

        init: function() {
            self = sjm.site;

	        // initialize foundation
	        $doc.foundation();

            if ($photo_slider.length ) {
                self.photo_slider();
            }
        },

        photo_slider : function () {
            $(document).ready(function(){
                $photo_slider.slick({
                    arrows: true,
                    fade: true,
                    swipe: true,
                    adaptiveHeight: true,
                });
            });
        }
    };
} ( jQuery );

jQuery(function( $ ) {
    sjm.site.init();
});