 /**
 * Theme functions file
 */

(function ($) {

    var wpApi = wp.customize;


    /**
    * Document ready (jQuery)
    */
    $(function () {

      	/* === Init Font Family And Style Control === */
        fontChosen.init();
        /* === Checkbox Multiple Control === */
        multiCheckboxes.init();
        
        /* === Fn. Checkbox Multiple Sort Control === */
        $('.customize-control-checkbox-multiple-sort').multiCheckboxesSort();
            
        /* === Show terms with icon last post === */
            //last_in_terms.init();
        /* === Contact Google Map === */
            display_map.show_map();

        /* === FIX - Upadte google map when display:none === */
            $('#accordion-section-wpg_contact_theme_section').bind('click', function(){
                
                 var center = map.getCenter();
                 google.maps.event.trigger(map, "resize");
                 map.setCenter(center); 
            }); 
        
    });
    
    /* === Font Family And Style Control === */
    fontChosen = {

        init: function () {
            fontChosen.showFonts();
        },

        showFonts: function () {
            $(".google-font-select").each(function () {
              
                var $el = $(this),
                    key = $el.attr('data-customize-setting-link');

                wpApi(key, function (setting) {

                    $el.on('change', function () {
                        var $select     = $(this),
                            font_famile = $select.val(),
                            font_variant     = $select.closest('li').next().find('select');

                        if (font_variant.length > 0 && wpgCustomizerFontsL10n[font_famile] !== undefined) {

                            font_variant.html(fontChosen.showVariants(wpgCustomizerFontsL10n[font_famile]['variants']))
                                        .children('option[value="regular"]').attr('selected','selected')
                                        .trigger('change');
                        }
                    });
                });
            });
        },

        showVariants: function (variants) {
            
            var options = '';
            
            $.each(variants, function (ind, val) {
                var name = val.replace('italic', ' Italic').replace(/\w\S*/g, function (txt) {
                
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                
                });
                options += '<option value="' + val + '">' + name + '</option>';
            });
            
            return options;
        }

    };
    
    
    
  	/* === All Checkbox Multiple Control === */
    var multiCheckboxes = {

        init: function(){

            $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change',function() {

                var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map( function() {
                            return this.value;
                        }
                    ).get().join( ',' );

                $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
            });
        }
    };
 
 
  	/* === Function multi Checkboxes Sort === */
    $.fn.multiCheckboxesSort = function() {
        return this.each(function () {

            var $el = $(this),
                $hidden_input = $el.find( 'input[type="hidden"]' );
          
          		if ($hidden_input.length !== 0){
		           
					if ($hidden_input.val().length !== 0) {
		    
		                 var $checkbox_sort_array = $hidden_input.val().split(",");
		              
					} else {
		              
		                 var $checkbox_sort_array = [];
		              
					}       			
				}
          		
  

            $el.find('input[type="checkbox"]' ).on( 'change', function() {

                   var input = $(this);

                   if (  input.is(':checked') ) {
                       $checkbox_sort_array.push(input.val());
                      
                   } else {
                       $checkbox_sort_array.splice($.inArray( input.val(), $checkbox_sort_array),1);

                   }
                   $hidden_input.val( $checkbox_sort_array.join( ',' ) ).trigger( 'change' );
    
                });
        });
    };   
    
     
    
  	/* === Show terms with icon last post === */
    var last_in_terms = {
        
        init: function(){
              hidden_input = $('#category-chosen');
              
              if (hidden_input.val().length !== 0) {
                  checkbox_array = $('#category-chosen').val().split(",");
              } else {
                  checkbox_array = [];
              }
             
              last_in_terms.select_tax();
              last_in_terms.select_term();
        },
      
        select_tax: function() {
                    
                    
                    $('#customize-control-wpg_featured_term_tax select').on( 'change', function() {
    
                    var tax_select     = $(this),
                        val_tax_select = tax_select.val(),
                        termlist       = tax_select.closest('li').next().find('ul');
    
                    termlist.removeClass('show-list');
    
                    $('ul.'+ tax_select.val()).addClass('show-list');
    
                    termlist.find('input:checkbox').each(function(){
                        $(this).prop( "checked", false );
                    });
    
    
                    $('ul.'+ val_tax_select + 'input').first().prop( "checked", true );
    
                    checkbox_array = [];
    
                    $('ul.'+ val_tax_select).find('input:checkbox:first').each(function(){
                        $(this).prop( "checked", true );
                        checkbox_array.push($(this).val());
                    });
    
                  hidden_input.val( checkbox_array.join( ',' ) ).trigger( 'change' );
    
            });            
        },
        
        
        select_term: function(){
            $( '#customize-control-wpg_featured_term_terms input[type="checkbox"]' ).on( 'change', function() {
    
                   var input = $(this);
    
                   if (  input.is(':checked') ) {
                       checkbox_array.push(input.val());
                   } else {
                       checkbox_array.splice($.inArray( input.val(), checkbox_array),1);
                   }
   
                   input.parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_array.join( ',' ) ).trigger( 'change' );
                    
                });              
        }
        
    };
    
    
   	/* === Contact google map === */
    var display_map = {

        show_map: function(){
            
            var input       = $('#geo_latlng'),
                array_input = input.val().split(","),
                myLatlng    = new google.maps.LatLng( array_input[0], array_input[1] ); 

            var myOptions = {
                zoom: 11,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            
                        
            map = new google.maps.Map(document.getElementById("draggable-map"), myOptions); 

            var marker = new google.maps.Marker({
                draggable: true,
                position: myLatlng, 
                map: map,
                title: "Your location"
            });
            
            google.maps.event.addListener(marker, 'dragend', function(event){
                   
                  input.val( event.latLng.lat() +','+ event.latLng.lng() ).trigger( 'change' );

            });
        }           
            
            
        
        
    };    
    
})(jQuery);