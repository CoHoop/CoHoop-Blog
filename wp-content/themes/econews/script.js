jQuery(document).ready(function ($) {

    /*========== General functions ==========*/
    function removeHash () {
        var scrollV, scrollH, loc = window.location;
        if ("pushState" in history){
            history.pushState("", document.title, loc.pathname + loc.search);
        }
        else {
            // Prevent scrolling by storing the page's current scroll offset
            scrollV = document.body.scrollTop;
            scrollH = document.body.scrollLeft;

            loc.hash = "";

            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scrollV;
            document.body.scrollLeft = scrollH;
        }
    }

    /*========== ShadowBox ==========*/
    Shadowbox.init({
        skipSetup: true
    });

    var vidContainer = $('.videoPlay a, .videoThumbnail a');

    vidContainer.on('click', function(){
        var ytcode = $(this).attr('href').substring(1,12);

        console.log(ytcode);
        Shadowbox.open({
            content:    '<iframe class="youtube-player" type="text/html" width="560" height="340" frameborder="0" src="http://www.youtube.com/embed/'+ytcode+'" ></iframe>',
            player:     "html",
            height:     360,
            width:      580,
            options:    {
                onClose : function(){
                    removeHash();
                }
            }
        });

    });

    /*========== jQuery Masonry ==========*/
    /*$('#toolbox').masonry({
        itemSelector: '.videoContainer',
        columnWidth: function(containerWidth ) {
            console.log(containerWidth);
            return (containerWidth  - 30) / 2;
        }
    });*/

    /*========== qTip ==========*/
    $('.socialBtn[title]').qtip({
        style: {
            border: {
                radius: 6
            },
            name: 'dark',
            tip: true
        },
        position: {
            corner: {
                target: 'topMiddle',
                tooltip: 'bottomMiddle'
            }
        }
    });

    /*========== Horizontal sliding menu ==========*/
    // Prevent submenu parent item normal behavior.
    $.each($(".nav > li > a"), function(){
        $(this).click(function (e) {
            if ($(this).parent().children('.sub-menu').length != 0) {
                e.preventDefault();
            }
        });
    });

    $.each($(".menu-item"), function(){
        var width = $(this).width();
        $(this).find('.sub-menu li a').css({
            'min-width': width - 36
        });
    });

    $(".menu-item").mouseenter(function() {
        //if ($(this).children('.sub-menu').length != 0) {
        clearTimeout($(this).data('timeoutId'));
        $(this).find(".sub-menu").fadeIn(200);
    //}
    }).mouseleave(function() {
        //if ($(this).children('.sub-menu').length != 0) {
        var el = $(this);
        var timeoutId = setTimeout(function(){
            el.find(".sub-menu").fadeOut(150);
        }, 0);
        //set the timeoutId, allowing us to clear this trigger if the mouse comes back over
        el.data('timeoutId', timeoutId);
    // }
    });
        
    
    /*========== Forms ==========*/
    // Check if browser supports HTML5 input placeholder
    function supports_input_placeholder() {
        var i = document.createElement('input');
        return 'placeholder' in i;
    }

    // Change input text on focus
    if (!supports_input_placeholder()) {
        $(':text').focus(function(){
            var self = $(this);
            if (self.val() == self.attr('placeholder')) self.val('');
        }).blur(function(){
            var self = $(this), value = $.trim(self.val());
            if(val == '') self.val(self.attr('placeholder'));
        });
    } else {
        $(':text').focus(function(){
            $(this).css('color', '#000');
        });
    }
    
    // Controls character input/counter
    var textarea = $('.wpcf7 textarea[name=your-message]');
    var maxChar = 800;
    
    textarea.after('<p class="remainingCharHolder">' + maxChar + '</p>');
    
    textarea.keyup(function() {
        var charLength = $(this).val().length;
        var remainingChar = maxChar - charLength;
        
        console.log(remainingChar);
        
        if (remainingChar < 11 && remainingChar > 0) {
            remainingChar = '<span class="darkred">' + remainingChar + '</span>';
        }
        else if (remainingChar <= 0) {
            remainingChar = '<span class="red">' + remainingChar + '</span>';
        }
        
        console.log(remainingChar);
        
        // Displays count
        $('.remainingCharHolder').html(remainingChar);
    });
    
    
/*$(".menu-item").hover(
        function () {
            if ($(this).children('.sub-menu').length != 0) {
                console.log('hover');
                $(this).children('.sub-menu').slideToggle('medium');
            }
        },
        function () {
            if ($(this).children('.sub-menu').length != 0) {
                console.log('not hover');
                $(this).delay()
                $(this).children('.sub-menu').slideToggle('medium');
            }
        }
    );*/

});