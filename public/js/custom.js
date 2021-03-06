

jQuery(document).ready(function() {

    var base_url = location.protocol + "//" + location.host+"/";

    // --------------------------------------------------
    // change menu on mobile version
    // --------------------------------------------------
    domready(function(){
        selectnav('mainmenu', {
            label: 'Menu',
            nested: true,
            indent: '-'
        });
    });

    // --------------------------------------------------
    // paralax background
    // --------------------------------------------------
    $window = jQuery(window);
    jQuery('section[data-type="background"]').each(function(){
        var $bgobj = jQuery(this); // assigning the object

        jQuery(window).scroll(function() {
            var yPos = -($window.scrollTop() / $bgobj.data('speed'));
            var coords = '50% '+ yPos + 'px';
            $bgobj.css({ backgroundPosition: coords });

        });
    });
    document.createElement("article");
    document.createElement("section");

    $("#footer").stickyFooter({
        // The class that is added to the footer.
        class: 'sticky-footer',

        // The footer will stick to the bottom of the given frame. The parent of the footer is used when an empty string is given.
        frame: '',

        // The content of the frame. You can use multiple selectors. e.g. "#header, #body"
        content: '#wrapper'
    });

    // --------------------------------------------------
    // sticky header
    // --------------------------------------------------
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 35){
            jQuery('body').addClass("sticky-2");
            jQuery('header').addClass("sticky-1");
            jQuery('header .info').addClass('h_info_hide');
            jQuery('#logo_unine').addClass('logo_little');

        }
        else{
            // --------------------------------------------------
            //back to default styles
            // --------------------------------------------------
            jQuery('body').removeClass("sticky-2");
            jQuery('header').removeClass("sticky-1");
            jQuery('header .info').removeClass('h_info_hide');
            jQuery('#logo_unine').removeClass('logo_little');
        }
    });

    //jQuery('.simple_color').simpleColor();
    jQuery( "#content-application" ).resizable({ handles: "n,s" });


    window.onresize = function(event) {
        //jQuery('#gallery').isotope('reLayout');
    };


    // --------------------------------------------------
    // scroll to top
    // --------------------------------------------------
    jQuery().UItoTop({ easingType: 'easeOutQuart' });

    /*
    // --------------------------------------------------
    // lazyload
    // --------------------------------------------------
    jQuery(function() {
        jQuery("img").lazyload({
            effect : "fadeIn",
            effectspeed: '1000'
        });
    });
     */

    jQuery(".popup_modal").fancybox({
        type: 'iframe',
        minWidth: 1030,
        autoSize: true,
        autoResize: true,
        height: '100%'
    });

    jQuery('.edit_content').editable( base_url + 'compose/update', {
        type      : 'textarea',
        submit    : 'OK',
        data: function(value, settings) {
	      /* Convert <br> to newline. */
	      var retval = value.replace(/<br[\s\/]?>/gi, '\n');
	      retval = retval.trim();
	      return retval;
	    },
        indicator : 'Sauvegarde...',
        cssclass  : 'edit_form_projet',
        tooltip   : 'Click to edit...',
        submitdata : function(value, settings) {
            var column = $(this).data('column');
            var id     = $(this).data('id');
            return {column: column , id : id};
        }
    });


    jQuery('.edit_rang').editable( base_url + 'compose/update', {
        type      : 'text',
        submit    : 'OK',
        indicator : 'Sauvegarde...',
        cssclass  : 'edit_rang_projet',
        tooltip   : 'Click to edit...',
        submitdata : function(value, settings) {
            var column = $(this).data('column');
            var id     = $(this).data('id');
            return {column: column , id : id};
        }
    });

    // Get all themes for editing in place
    if (jQuery('#theme-edit').length > 0) {

        jQuery("body").on("change", "#theme-edit", function(){
            // Grab choosen categories
            var theme  = jQuery(this).find(":selected").val();
            var column = jQuery(this).data('column');
            var id     = jQuery(this).data('id');

            if(theme)
            {
                jQuery.ajax({
                    dataType: 'json',
                    type    : "POST",
                    data    : { column: column , id : id , value : theme },
                    success : function(data)
                    {

                        /////////////////////////////
                        var default_colors = [
                            ['ffffff','000000','cccccc','999999','666666','83146a','74055b','65004c','560033','47002e'],
                            ['ffffff','000000','cccccc','999999','666666','004685','003775','002866','001957','000a48'],
                            ['ffffff','000000','cccccc','999999','666666','0066cc','0057bd','0048ae','00399f','002a90'],
                            ['ffffff','000000','cccccc','999999','666666','0092be','0083af','0074a0','006591','005682'],
                            ['ffffff','000000','cccccc','999999','666666','102720','102720','011811','000902','000000'],
                            ['ffffff','000000','cccccc','999999','666666','005d35','004e26','003f1c','00300d','002100'],
                            ['ffffff','000000','cccccc','999999','666666','57ac4a','489d3b','398e2c','2a7f1d','1b700e'],
                            ['ffffff','000000','cccccc','999999','666666','ffcc00','f0bd00','e1ae00','d29f00','c39000'],
                            ['ffffff','000000','cccccc','999999','666666','e19720','d28811','c37902','b46a00','a55b00'],
                            ['ffffff','000000','cccccc','999999','666666','e06a22','6d5b13','5e4c04','4f3d00','402c00'],
                            ['ffffff','000000','cccccc','999999','666666','a84424','993515','892506','7a1600','6b0700'],
                            ['ffffff','000000','cccccc','999999','666666','8e2c23','7f1d14','700e05','610000','520000'],
                            ['ffffff','000000','cccccc','999999','666666','b10535','a20025','930016','840007','750000']
                        ];

                        var base_url_theme = location.protocol + "//" + location.host+"/api/";

                        $.ajax({
                            type: 'GET', // Le type de ma requete
                            async:false,
                            success: function(data) {

                                console.log(data);

                                data = data.items.id - 1;
                                var colors = default_colors[data];

                                $(".simpleColorContainer").remove();
                                $("#colorPicker").remove();


                                var $colorpicker = $('<input/>', {
                                    id: 'colorPicker',
                                    class: 'simple_color',
                                    value: '#000000'
                                });

                                $("#colors").append($colorpicker);

                                $('.simple_color').simpleColor({ colors: colors , defaultColor: '#eeeeee'});

                            },
                            url: base_url_theme+'theme/'+id
                        });

                        /////////////////////////////


                        console.log('update ok');
                        $('.isUpdated').fadeIn(400);
                        $('.isUpdated').delay(1500).fadeOut(1000);
                    },
                    url: base_url + 'compose/update'
                });
            }
        });

    }

   /* var status = jQuery('#toggle-btn').data('status');

    if (status === 'actif')
    {
        var on = true;
    }
    else
    {
        var on = false;
    }

    jQuery('.toggle').toggles({
        drag:false,
        on:on,
        text:{on:'Actif', off:'Brouillon'}
    });

    // Getting notified of changes, and the new state:
    jQuery('.toggle').on('toggle', function (e, active) {

        var id = $(this).data('id');

        if (active)
        {
            var status = 'actif';
        }
        else
        {
            var status = 'brouillon';
        }

        jQuery.ajax({
            type: 'POST',
            data: {
                id    : id,
                value : status,
                column: 'status'
            },
            success: function(data)
            {
                console.log(data);
            },
            url: base_url + 'compose/update'
        });


    });*/

    // hover delete schemas in profil
    jQuery(".gallery .item").hover(
        function() {
            $(this).find('.deleteSchema').show();
        },
        function() {
            $(this).find('.deleteSchema').hide();
        });

    // Delete button util function
    $('body').on('click','.deleteAction',function(){

        var $this   = $(this);
        var action  = $this.data('action');

        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');
        if (answer){
            return true;
        }
        return false;
    });

    jQuery('.popup').tooltip();

    // --------------------------------------------------
    // gallery hover
    // --------------------------------------------------
    jQuery('.overlay').fadeTo(1, 0);
    jQuery(".item .picframe").hover(
        function() {
            jQuery(this).parent().find(".overlay").width(jQuery(this).find("span.itemColor img").css("width"));
            jQuery(this).parent().find(".overlay").height(jQuery(this).find("span.itemColor img").css("height"));
            jQuery(this).parent().find(".overlay").fadeTo(150, 1);
            picheight = jQuery(this).find("span.itemColor img").css("height");
            newheight = (picheight.substring(0, picheight.length - 2)/2)-18;
            //alert(newheight);
            jQuery(this).parent().find(".info-area").animate({'margin-top': newheight},'fast');

        },
        function() {
            jQuery(this).parent().find(".info-area").animate({'margin-top': '10%'},'fast');
            jQuery(this).parent().find(".overlay").fadeTo(150, 0);
        })


    // team hover
    jQuery(".team .picframe").hover(
        function() {
            jQuery(this).parent().find(".overlay").width(jQuery(this).find("img.team-pic").css("width"));
            jQuery(this).parent().find(".overlay").height(jQuery(this).find("img.team-pic").css("height"));
            jQuery(this).parent().find(".overlay").fadeTo(150, 1);
            picheight = jQuery(this).find("img.team-pic").css("height");
            newheight = (picheight.substring(0, picheight.length - 2)/2)-24;
            //alert(newheight);
            jQuery(this).parent().find(".sb-icons").animate({'margin-top': newheight},'fast');

        },
        function() {
            jQuery(this).parent().find(".sb-icons").animate({'margin-top': '10%'},'fast');
            jQuery(this).parent().find(".overlay").fadeTo(150, 0);
        })

    jQuery(window).load(function() {
        // --------------------------------------------------
        // filtering gallery
        // --------------------------------------------------



        jQuery('#filters a').click(function(){
            var $this = jQuery(this);
            if ( $this.hasClass('selected') ) {
                return false;
            }
            var $optionSet = $this.parents();
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            var selector = jQuery(this).attr('data-filter');
            $container.isotope({
                filter: selector,
            });

            return false;
        });



    });


    // --------------------------------------------------
    // tabs
    // --------------------------------------------------
    jQuery('.de_tab').find('.de_tab_content div').hide();
    jQuery('.de_tab').find('.de_tab_content div:first').show();

    jQuery('.de_nav li').click(function() {
        jQuery(this).parent().find('li span').removeClass("active");
        jQuery(this).find('span').addClass("active");
        jQuery(this).parent().parent().find('.de_tab_content div').hide();

        var indexer = jQuery(this).index(); //gets the current index of (this) which is #nav li
        jQuery(this).parent().parent().find('.de_tab_content div:eq(' + indexer + ')').fadeIn(); //uses whatever index the link has to open the corresponding box
    });


});
