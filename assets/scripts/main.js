/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // LOAD WEB FONTS
        WebFont.load({
          google: {
            families: ['Quicksand', 'Open Sans']
          },
          active: function () {
              
              // FIRE FUNCTIONS AFTER FONT HAS LOADED
              $('body').addClass('page-ready');
              $('#loading-cover').delay(50).queue(function(next) { $(this).addClass("hello-app"); next(); }).delay(50).fadeOut('250',function(){$(this).remove();});
              
          }
        });

        // Enable BS tooltips (if not touchscreen)
        if(!('ontouchstart' in window)) {
          $(function () {
            $('[data-toggle="tooltip"]').tooltip();
          });
        }


      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        // http://www.formvalidator.net/
        $.validate({
          form : '#form-comment'
        });

        // Validate - limit characters
        $('#comment').restrictLength($('#maxlength'));

        // Slick Carousel
        $(".comment-list").slick({

          // normal options...
          infinite: false,
          vertical: true,
          verticalSwiping: true,
          slidesToScroll: 1,
          touchThreshold: 1

        });

        var mySlick = document.querySelector('.comment-list');
        var indicator = new WheelIndicator({
          elem: document.querySelector('.comment-list'),
          callback: function(e){
            if (e.direction === "down") {

              if($(".comment-list").slick('slickCurrentSlide') === $(".comment-list").find('.slide').length - 1) {
                return;
              } else {
                $(".comment-list").slick('slickNext');
              }
              

            } else if (e.direction === "up") {

              if($(".comment-list").slick('slickCurrentSlide') === 0) {
                return;
              }
              
              $(".comment-list").slick('slickPrev');
            }
          }
        });

        //The method call
        indicator.getOption('preventMouse'); // true        
      

        // SHOW & HIDE SEARCH BOX
        $(".quote-form-open-close").click(function(){

          if ($("#respond").hasClass("open")) {
            $("#respond").removeClass("open").delay(250).hide(10);
          } else {
            $("#respond").show(1).addClass("open");
          }
          
        });


      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
