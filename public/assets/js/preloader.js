jQuery(document).ready(function () {
    "use strict"
    //indexOf support for IE8 and below. 
    if (!Array.prototype.indexOf){
      Array.prototype.indexOf = function(elt /*, from*/){
        var len = this.length >>> 0;

        var from = Number(arguments[1]) || 0;
        from = (from < 0)
             ? Math.ceil(from)
             : Math.floor(from);
        if (from < 0)
          from += len;

        for (; from < len; from++){
          if (from in this &&
              this[from] === elt)
            return from;
        }
        return -1;
      };
    }

    //bgImg for holding background images in the page & img array for images present in the document(<img src="">).
    var bgImg = [], img = [], count=0, percentage = 0;

    //Creating loader holder. 
    jQuery('<div id="loaderMask"><span>0%</span></div>').css({
        position:"fixed",
        top:0,
        bottom:0,
        left:0,
        right:0,
        background:'#fff'
    }).appendTo('body');

    //Using jQuery filter method we parse all elemnts in the page and adds background image url & images src into respective arrays.
    jQuery('*').filter(function() {

        var val = jQuery(this).css('background-image').replace(/url\(/g,'').replace(/\)/,'').replace(/"/g,'');
        var imgVal = jQuery(this).not('script').attr('src');

        //Getting urls of background images.
        if(val !== 'none' && !/linear-gradient/g.test(val) && bgImg.indexOf(val) === -1){
            bgImg.push(val)
        }

        //Getting src of images in the document.
        if(imgVal !== undefined && img.indexOf(imgVal) === -1){
            img.push(imgVal)
        }

    });

    //Merging both bg image array & img src array
    var imgArray = bgImg.concat(img); 

    //Adding events for all the images in the array.
    jQuery.each(imgArray, function(i,val){ 
        //Attaching load event 
        jQuery("<img />").attr("src", val).bind("load", function () {
            completeImageLoading();
        });

        //Attaching error event
        jQuery("<img />").attr("src", val).bind("error", function () {
            imgError(this);
        });
    })

    //After each successful image load we will create percentage.
    function completeImageLoading(){
        count++;
        percentage = Math.floor(count / imgArray.length * 100);
        jQuery('#loaderMask').html('<span>'+percentage + '%'+'</span>');

        //When percentage is 100 we will remove loader and display page.
        if(percentage === 100){
            jQuery('#loaderMask').html('<span>100%</span>')
            jQuery('#loaderMask').fadeOut(function(){
                jQuery('#loaderMask').remove()
            })
        }
    }

    //Error handling - When image fails to load we will remove the mask & shows the page. 
    function imgError (arg) {
        jQuery('#loaderMask').html("Image failed to load.. Loader quitting..").delay(3000).fadeOut(1000, function(){
            jQuery('#loaderMask').remove();
        })
    }

});