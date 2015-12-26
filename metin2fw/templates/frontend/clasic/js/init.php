<?php
require '../../../../system/core.php';
?>
        $.fn.exists = function(){return jQuery(this).length>0;}
        $(document).ready(function(){
            $('#namefield, #emailfield').each(function() {
                var default_value = this.value;
                $(this).focus(function() {
                    if(this.value == default_value) {
                        this.value = '';
                    }
                });
                $(this).blur(function() {
                    if(this.value == '') {
                        this.value = default_value;
                    }
                });
            });
             var fancybox_css = {'outer': {'background' : null}, 'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}};
                $('a#itemshop').fancybox({
                    'autoDimensions': false,
                    'width': 740,
                    'height': 550,
                    'padding': 0,
                    'scrolling': 'no',
                    'overlayColor': '#000',
                    'overlayOpacity': 0.8,
                    'onStart': function() {
                        fancybox_css.outer.background = $('#fancybox-outer').css('background');
                        fancybox_css.close.background_image = $('#fancybox-close').css('background-image');
                        fancybox_css.close.height = $('#fancybox-close').css('height');
                        fancybox_css.close.right = $('#fancybox-close').css('right');
                        fancybox_css.close.top = $('#fancybox-close').css('top');
                        fancybox_css.close.width = $('#fancybox-close').css('width');
                    	$('#fancybox-outer').css({'background': 'transparent url("<?php echo site_url(); ?>frame.png") center center no-repeat'});
                    	$('#fancybox-close').css({'background-image': 'none', 'height': '16px', 'right': '3px', 'top': '7px', 'width': '16px'});
                    },
                    'onComplete': function() {
	                    $('#fancybox-inner').css({'top': 27, 'left':8});
	                    $('#fancybox-wrap').css({'width': 756, 'height': 585});
                    },
                    'onClosed': function() {
                        if (null != fancybox_css.outer.background) { $('#fancybox-outer').css('background', fancybox_css.outer.background); }
                        if (null != fancybox_css.close.background_image) { $('#fancybox-close').css('background-image', fancybox_css.close.background_image); } 
                        if (null != fancybox_css.close.height) { $('#fancybox-close').css('height', fancybox_css.close.height); }
                        if (null != fancybox_css.close.right) { $('#fancybox-close').css('right', fancybox_css.close.right); }
                        if (null != fancybox_css.close.top) { $('#fancybox-close').css('top', fancybox_css.close.top); }
                        if (null != fancybox_css.close.width) { $('#fancybox-close').css('width', fancybox_css.close.width); }
                    }
                });
                $('a#payment').fancybox({
                    'scrolling': 'no',
                    'autoDimensions': false,
                    'type': 'iframe',
                    'width': 790,
                    'height': 640,
                    'padding': 0,
                    'overlayColor': '#000',
                    'overlayOpacity': 0.8
                });
                $('#coda-slider-1').codaSlider({
                autoSlide: true,
                autoHeight: false,
                autoSlideInterval: 7000,
                autoSlideStopWhenClicked: true,
                dynamicArrows: false
            });
        })
