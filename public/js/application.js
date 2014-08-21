function chgact()
{
	document.forms['photo-search'].action = $('#php_action').val() + '/' + $('#q_cam').val();
	return true;
};

jQuery(document).ready(function() {
// $(function(){
    $("#grid").justifiedGallery();
    $('#brands').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
    });
    $('#lenses').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
        "order": [[ 1, "desc" ]]
    });
    
    $( 'a' ).imageLightbox();
});

$( function()
{
    var activityIndicatorOn = function()
    {
        $( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
    },
    activityIndicatorOff = function()
    {
        $( '#imagelightbox-loading' ).remove();
    },

    overlayOn = function()
    {
        $( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
    },
    overlayOff = function()
    {
        $( '#imagelightbox-overlay' ).remove();
    },

    closeButtonOn = function( instance )
    {
        $( '<a href="#" id="imagelightbox-close">Close</a>' ).appendTo( 'body' ).on( 'click touchend', function(){ $( this ).remove(); instance.quitImageLightbox(); return false; });
    },
    closeButtonOff = function()
    {
        $( '#imagelightbox-close' ).remove();
    },

    captionOn = function()
    {
        var description = $( 'a[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
        if( description.length > 0 )
            $( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
    },
    captionOff = function()
    {
        $( '#imagelightbox-caption' ).remove();
    },

    navigationOn = function( instance, selector )
    {
        var images = $( selector );
        if( images.length )
        {
            var nav = $( '<div id="imagelightbox-nav"></div>' );
            for( var i = 0; i < images.length; i++ )
                nav.append( '<a href="#"></a>' );

            nav.appendTo( 'body' );
            nav.on( 'click touchend', function(){ return false; });

            var navItems = nav.find( 'a' );
            navItems.on( 'click touchend', function()
            {
                var $this = $( this );
                if( images.eq( $this.index() ).attr( 'href' ) != $( '#imagelightbox' ).attr( 'src' ) )
                    instance.switchImageLightbox( $this.index() );

                navItems.removeClass( 'active' );
                navItems.eq( $this.index() ).addClass( 'active' );

                return false;
            })
            .on( 'touchend', function(){ return false; });
        }
    },
    navigationUpdate = function( selector )
    {
        var items = $( '#imagelightbox-nav a' );
        items.removeClass( 'active' );
        items.eq( $( selector ).filter( '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ).index( selector ) ).addClass( 'active' );
    },
    navigationOff = function()
    {
        $( '#imagelightbox-nav' ).remove();
    };


    //  WITH ACTIVITY INDICATION

    $( 'a[data-imagelightbox="a"]' ).imageLightbox(
    {
        onLoadStart:    function() { activityIndicatorOn(); },
        onLoadEnd:      function() { activityIndicatorOff(); },
        onEnd:          function() { activityIndicatorOff(); }
    });


    //  WITH OVERLAY & ACTIVITY INDICATION

    $( 'a[data-imagelightbox="b"]' ).imageLightbox(
    {
        onStart:     function() { overlayOn(); },
        onEnd:       function() { overlayOff(); activityIndicatorOff(); },
        onLoadStart: function() { activityIndicatorOn(); },
        onLoadEnd:   function() { activityIndicatorOff(); }
    });


    //  WITH "CLOSE" BUTTON & ACTIVITY INDICATION

    var instanceC = $( 'a[data-imagelightbox="c"]' ).imageLightbox(
    {
        quitOnDocClick: false,
        onStart:        function() { closeButtonOn( instanceC ); },
        onEnd:          function() { closeButtonOff(); activityIndicatorOff(); },
        onLoadStart:    function() { activityIndicatorOn(); },
        onLoadEnd:      function() { activityIndicatorOff(); }
    });


    //  WITH CAPTION & ACTIVITY INDICATION

    $( 'a[data-imagelightbox="d"]' ).imageLightbox(
    {
        onLoadStart: function() { captionOff(); activityIndicatorOn(); },
        onLoadEnd:   function() { captionOn(); activityIndicatorOff(); },
        onEnd:       function() { captionOff(); activityIndicatorOff(); }
    });


    //  WITH DIRECTION REFERENCE

    var selectorE = 'a[data-imagelightbox="e"]';
    var instanceE = $( selectorE ).imageLightbox(
    {
        onStart:     function() { navigationOn( instanceE, selectorE ); },
        onEnd:       function() { navigationOff(); activityIndicatorOff(); },
        onLoadStart: function() { activityIndicatorOn(); },
        onLoadEnd:   function() { navigationUpdate( selectorE ); activityIndicatorOff(); }
    });


    //  ALL COMBINED

    var instanceF = $( 'a[data-imagelightbox="f"]' ).imageLightbox(
    {
        onStart:        function() { overlayOn(); closeButtonOn( instanceF ); },
        onEnd:          function() { overlayOff(); captionOff(); closeButtonOff(); activityIndicatorOff(); },
        onLoadStart:    function() { captionOff(); activityIndicatorOn(); },
        onLoadEnd:      function() { captionOn(); activityIndicatorOff(); }
    });

});

// jquery for scroll-to-top
jQuery(document).ready(function() {
    var offset = 200;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.scroll-to-top').fadeIn(duration);
        } else {
            jQuery('.scroll-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.scroll-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
