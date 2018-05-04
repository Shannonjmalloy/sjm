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
        }
    };
} ( jQuery );

jQuery(function( $ ) {
    sjm.site.init();
});