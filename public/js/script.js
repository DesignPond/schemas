jQuery(document).ready(function() {
	
	// The url to the application
	var base_url = location.protocol + "//" + location.host+"/";

	// By default hide the selects theme ans subtheme	
	jQuery("body").on("change", "#categorie", function(){

		var $select = jQuery( "#theme" );	
		
		// Grab choosen categories
		var cat = jQuery(this).val();
		
		if(cat)
		{
			jQuery.ajax({
				 dataType: 'json',
				 success: function(data) 
				 {
				 		$select.empty();
				 		// array for options
				 		var items = [];
				 		// Loop over ajax data response
						jQuery.each(data, function(key, val) {
							items.push('<option value="' + key + '">' + val + '</option>');
						});
						// Join all html, append to select and show the select
						var all = items.join('');
						$select.append(all);
						jQuery( "#theme-label" ).show();	
				 },
				 url: base_url + 'theme/drop_theme/'+ cat
			});
		}
	});
	
	jQuery("body").on("change", "#theme", function(){
		
		var $select = jQuery( "#subtheme" ).empty();	
		// Grab choosen categories
		var theme = jQuery(this).find(":selected").val();

		if(theme)
		{
			jQuery.ajax({
				 dataType: 'json',
				 success: function(data) 
				 {
				 		$select.empty();
				 		// array for options
				 		var items = [];
				 		// Loop over ajax data response
						jQuery.each(data, function(key, val) {
							items.push('<option value="' + key + '">' + val + '</option>');
						});
						// Join all html, append to select and show the select
						var all = items.join('');
						$select.append(all);
						jQuery( "#subtheme-label" ).show();	
				 },
				 url: base_url + 'theme/drop_subtheme/'+ theme
			});
		}
	});
	
	var valueCat = jQuery( "#categorie" ).find(":selected").val();
	
	if(valueCat && (valueCat != 0) ){
		console.log('value!');
		jQuery( "#categorie" ).trigger('change');
	}
	
	//$(".zoom_projet").elevateZoom({ zoomType : "lens", lensShape : "round", lensSize : 200 });


	$("#IframeId").load(function() {
	
    	$(this).height( $(this).contents().find("body").height() ); 
    	
    	var content = $(this).contents().html();
    	var height  = $(this).contents().find("body").height();
        var image   = $(this).contents().find("img").height();

        $(this).contents().find("img").css("height",image);

    	console.log(image);
    	
    	$(this).contents().find("html").css('text-align','center');
        $(this).height(height);

        $("#footer").stickyFooter({
            // The class that is added to the footer.
            class: 'sticky-footer',
            // The footer will stick to the bottom of the given frame. The parent of the footer is used when an empty string is given.
            frame: '',
            // The content of the frame. You can use multiple selectors. e.g. "#header, #body"
            content: '#wrapper, #content'
        });
    	   
	});

    function detectIE() {
        var ua = window.navigator.userAgent;

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
            // IE 10 or older => return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
            // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
            // IE 12 => return version number
            return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        }

        // other browser
        return false;
    }



}); 

