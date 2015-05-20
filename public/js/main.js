$( function() {
    
    
/*
    $("#filterTag").change(function(){
         $("#filter").submit()
    });
    
    $("#filterYear").change(function(){
         $("#filter").submit()
    });
    
*/

	$('.zooming').zoom();
    
    $(".myTags").tagit({
	    afterTagAdded: function(event, ui) {
		    
		    if(!ui.duringInitialization){
			   
		        var tag = ui.tagLabel;
		        var id  = $(this).data('id');
		        
		        $.ajax({
		            dataType: "json",
		            type    : 'POST',
		            url     : 'addTag',
		            data: {
		                id  : id,
		                tag : tag
		            },
		            success: function( data ) {		            
		               console.log('added');			            
		            },
			        error: function(data) {
			           console.log('error');
			        }
		        });	      
		    }
	        
	    },
	    beforeTagRemoved: function(event, ui) {
	    
	        var tag = ui.tagLabel;
	        var id  = $(this).data('id');
	        
	        $.ajax({
	            dataType: "json",
	            type    : 'POST',
	            url     : 'removeTag',
	            data: {
	                id  : id,
	                tag : tag
	            },
	            success: function( data ) {		            
	               console.log('removed');			            
	            },
		        error: function(data) {
		           console.log('error');
		        }
	        });	 
	             
	    },
	    autocomplete: {
    		delay: 0, 
    		minLength: 2,
    		source: function( request, response ) {
				
		        $.ajax({
		            dataType: "json",
		            type    : 'GET',
		            url     : 'tags',
		            data: {
		                term: request.term
		            },
		            success: function( data ) {		            
		            	response( $.map( data, function( item ) {
			               return {
			                 label: item.title,
			                 value: item.title
			               }
			            }));			            
		            },
			        error: function(data) {
			          console.log('error');
			        }
		        });	        
		    }
	    }
	});
	
	
	    
    /**
	*  Rating système for projets
	*/
    
    
    $(".rateit").bind('rated', function (event, value) { 
	    console.log('Rating rated' + value);
	    
	    var projet  = $(this).data('projet');
	    
	    $.ajax({
            url: 'compose/update',
            type: 'POST',
            data: {  id: projet, value: value , column: 'rating' },
	        success : function(data){
	            console.log(data);
	        }
	    }); 
	    
	    
	});
	
	$(".rateit").bind('reset', function () { 
		console.log('Rating reset');
		
		var projet  = $(this).data('projet');
	    
	    $.ajax({
            url: 'compose/update',
            type: 'POST',
            data: {  id: projet, value: 0 , column: 'rating' },
	        success : function(data){
	            console.log(data);
	        }
	    }); 
	    
	});
	
	
	/**
	 *  Mentions checkbox
	*/
	
	$(".mentions").change(function() { 
		
		var mention = [];
		var projet  = $(this).data('projet');
		
		$('.mentions_'+projet).each(function(i, obj) {
			
			if($(this).is(":checked")) { 			
		   		mention.push($(this).val());		   		
		    }
		    
		});
		
		var mentions = mention.join(); 
		
		$.ajax({
            url: 'compose/update',
            type: 'POST',
            data: {  id: projet, value: mentions , column: 'mentions' },
	        success : function(data){
	            console.log(data);
	        }
	    }); 
	    
        
    }); 


  
});
