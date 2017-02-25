 /**
 * Theme functions file
 */
(function ($) {

    var $window = $(window);
 
    /**
    * Document ready (jQuery)
    * test
    */
    $(function () {
    	
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}    	
    	

        var $header_continer_id = $('#header-slider'),
            $header_resize 		= $('#header-slider .header-resize'),
            $offset_header 		= $('#site-header' ).offset();

		/*
		 * If Resize window
	     **/
	    if ( $header_continer_id.length){
	    	$window.on('resize', function () {
		
		            var $windowheight   = $window.height() - $header_continer_id.offset().top,
		                $windowWidth    = $window.width();
		              
						//destktop
		                if ($windowWidth > 768 && $windowheight <= 500) {
		 
		                   	$windowheight = 500;
		                    
		                } else if ($windowWidth < 768 && $windowheight <= 300){
		               		
		               		$windowheight = 300;
		                }
		
		                $header_resize.height($windowheight);           
		    
		    }).resize();
	    }
		/**
		* Activate Slick
		*/
            
            // Header slider (slick)
            $('#slider').slick({
            	dots: false,
            	infinite: true,
				speed: 500,
				fade: true,
				cssEase: 'linear',
				autoplay: true,
				pauseOnHover: false            	
            });
            
            // Client carousel	(slick)
           	$('#client-slider').slick({
	           	dots: false,
	           	arrows: false,
				centerMode: true,
				slidesToShow: 5,
				autoplay: true,
				pauseOnHover: false,
				responsive: [
				    {
				      breakpoint: 480,
				      settings: {
				        centerPadding: '40px',
				        slidesToShow: 1
				      }
				    }
				  ]				
            }); 
       
       /**
        *  Scroll
        */
		$window.scroll(function() {

		      if ( $window.scrollTop() > ($offset_header.top)){
		            $('body').addClass('fixed-header');
		       } else {
		            $('body').removeClass('fixed-header');
		       }        
		});  	    

        /**
         *  function menu 
         */
          	//if resize window
          	$('#header-menu').nav();

            // if click button menu 
            $('button.icon-button-small-menu').on('click', function(e){
        
               var item = $(this).next();
        
               item.toggleClass( item.data("class") + " small-menu" );
               $( '#site-header' ).toggleClass( "menu-active" );
        
               e.preventDefault();
            });
  			
  			// If Menu focus
            $( function() { $( '.horizontal' ).find( 'a' ).on( 'focus blur', function() {
               $( this ).parents().toggleClass( 'focus' );
            });});

		
		/**
		* Activate rwd table.
		*/
	    	$('.hentry table').table();


        /**
        * Image Popup
        */
            //Translating magnificPopup
            $.extend(true, $.magnificPopup.defaults, {
              tClose: datalanuge.close, // Alt text on close button
              tLoading: datalanuge.load, // Text that is displayed during loading. Can contain %curr% and %total% keys
              gallery: {
                tPrev: datalanuge.prev, // Alt text on left arrow
                tNext: datalanuge.next, // Alt text on right arrow
                tCounter: '%curr% '+ datalanuge.of + ' %total%' // Markup for "1 of 7" counter
              },
              image: {
                tError: '<a href="%url%">'+ datalanuge.image +'</a>' + datalanuge.error_image // Error message when image could not be loaded
              },
              ajax: {
                tError: '<a href="%url%">'+ datalanuge.image +'</a>' + datalanuge.error_image // Error message when ajax request failed
              }
            });       
       
            // Single image
            $('.image-popup').magnificPopup({
              type:'image',
            });

            //Button to gallery    
            $('.gallery-popup').on('click', function () {
                $('.gallery').magnificPopup('open');
            });

            //Gallery image    
            $('.gallery').each(function () {
               
               $(this).magnificPopup({
                    delegate: 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]',
                    type: 'image',
                    gallery: {
                        enabled: true,
                    }
               });
            });        
            
            
            
        /**
        * Show/hidde sidebar
        */                        
		    $( "a.show-overlay" ).click(function(e) {
		    	e.preventDefault();
	  			$('#sidebar-overlay').addClass('active');
	  			$('.quiz-224 input').val('wygoda').trigger( 'change' );
			});
		    $( "a.hide-overlay" ).click(function(e) {
		    	e.preventDefault();
	  			$('#sidebar-overlay').removeClass('active');
			});            
            
                       
	
    });


    /*******************
    * Function Section
    ********************/
	
	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}
	
	/**
	* Function rwd table.
	*/
    $.fn.table = function() {
        return this.each(function () {
        	var headertext = [];

			var $this = $(this);

			$this.find('thead td, th').each(function(){
         		headertext.push($(this).html());
			});

			$this.find('tbody tr').each(function(){
    				$(this).find('td').each(function(index){
        					$(this).attr('data-th', headertext[index]);
					});
			});
		});
	};

    /**
    * Function rwd nav.
    */
   $.fn.nav = function(nav) {
        return this.each(function () {

           var 	$this = $(this),
           		$li_megamenu = $this.find('li.megamenu');

           	$window.on('resize orientationchange', function () {

           	var window_width = $window.width();
 					
           		if (window_width > 768) {

					$classes = $this.data("class");

					// Usuwanie classy z menu
					if ($this.hasClass( "small-menu" )) {
						$( '#site-header' ).removeClass("menu-active");
						$this.removeClass();
						$this.addClass( $classes );
					 }
					 
			 		$li_megamenu.each(function(){
 						var $position = $(this).offset();
 						$(this).children('ul.menu-sub-content')
 							.css( "left","-"+$position.left+"px")
 							.css( "width",window_width + "px");
 					}); 
				} else {
				 	$li_megamenu.each(function(){
 						var $position = $(this).offset();
 						$(this).children('ul.menu-sub-content')
 							.css( "left","0px")
 							.css( "width","auto");
 					}); 				
				}
			}).resize();
		});
  };
})( jQuery );