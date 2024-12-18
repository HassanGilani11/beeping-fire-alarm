/*
Template Name: Plumco
Author: wpoceans
Version: 1.0
*/

(function($){
'use strict';

/*----- ELEMENTOR LOAD FUNTION CALL ---*/

$( window ).on( 'elementor/frontend/init', function() {

	var swiper_slide = function(){
	 
     // SLIDER
    var menu = [];
    jQuery('.swiper-slide').each(function (index) {
        menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },

        watchSlidesProgress: true,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        on: {
            progress: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },

            touchStart: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },

            setTransition: function (speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                        speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

	}; // end



    // sliderBgSetting

    var sliderBgSetting = function(){
        // DATA BACKGROUND IMAGE
        var sliderBgSetting = $(".slide-bg-image");
        sliderBgSetting.each(function (indx) {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });

        

    }; // end



    var hero_client_slider = function(){

      /*------------------------------------------
        = Client SLIDER
      -------------------------------------------*/
      if ($(".wpo-happy-client-slide").length) {
          $(".wpo-happy-client-slide").owlCarousel({
              autoplay: true,
              smartSpeed: 300,
              margin: 0,
              loop:true,
              autoplayHoverPause:true,
              dots: false,
              nav: false,
              items:4
          });
      }

    }; // end


    var portfolio_filter = function(){

      /*------------------------------------------
        = FUNCTION FORM SORTING GALLERY
      -------------------------------------------*/
      function sortingGallery() {
          if ($(".sortable-gallery .gallery-filters").length) {
              var $container = $('.gallery-container');
              $container.isotope({
                  filter:'*',
                  animationOptions: {
                      duration: 750,
                      easing: 'linear',
                      queue: false,
                  }
              });

              $(".gallery-filters li a").on("click", function() {
                  $('.gallery-filters li .current').removeClass('current');
                  $(this).addClass('current');
                  var selector = $(this).attr('data-filter');
                  $container.isotope({
                      filter:selector,
                      animationOptions: {
                          duration: 750,
                          easing: 'linear',
                          queue: false,
                      }
                  });
                  return false;
              });
          }
      }

      sortingGallery();

    }; // end



    var testimonials_slider = function(){
     
       /*------------------------------------------
        = Testimonial SLIDER
        -------------------------------------------*/
        if ($(".testimonials-wrapper").length) {
            $(".testimonials-wrapper").owlCarousel({
                autoplay: false,
                smartSpeed: 300,
                margin: 40,
                loop:true,
                autoplayHoverPause:true,
                dots: false,
                nav: false,
                responsive: {
                    0 : {
                        items: 1,
                    },

                    500 : {
                        items: 1,
                    },

                    768 : {
                        items: 2,
                    },

                    1200 : {
                        items: 2
                    },

                    1400 : {
                        items: 3
                    },

                }
            });
        }


    }; // end


    
    var odometer = function(){

       /*------------------------------------------
        = FUNFACT
        -------------------------------------------*/
        if ($(".odometer").length) {
            $('.odometer').appear();
            $(document.body).on('appear', '.odometer', function(e) {
                var odo = $(".odometer");
                odo.each(function() {
                    var countNumber = $(this).attr("data-count");
                    $(this).html(countNumber);
                });
            });
        }



    }; // end


    var team_slider = function(){

       /*------------------------------------------
        = TEAM SLIDER
        -------------------------------------------*/
        if ($(".team-slider").length) {
            $(".team-slider").owlCarousel({
                autoplay: false,
                smartSpeed: 300,
                margin: 0,
                loop:true,
                autoplayHoverPause:true,
                dots: false,
                nav: true,
                navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next-1"></i>'],
                responsive: {
                    0 : {
                        items: 1
                    },

                    600 : {
                        items: 2
                    },

                    768 : {
                        items: 3
                    },

                    1200 : {
                        items: 4
                    }
                }
            });
        }



    }; // end


    var partners_slider = function(){

       /*------------------------------------------
        = PARTNERS SLIDER
        -------------------------------------------*/
        if ($(".partners-slider").length) {
            $(".partners-slider").owlCarousel({
                autoplay:true,
                smartSpeed: 300,
                margin: 30,
                loop:true,
                autoplayHoverPause:true,
                dots: false,
                responsive: {
                    0 : {
                        items: 2
                    },

                    550 : {
                        items: 3
                    },

                    992 : {
                        items: 4
                    },

                    1200 : {
                        items: 5
                    }
                }
            });
        }


    }; // end

  



  	//Hero Client Slider
  	elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_hero.default', function($scope, $){
  		hero_client_slider();
  	} );

    //Slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_slider.default', function($scope, $){
      swiper_slide();
    } );

    //sliderBgSetting
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_slider.default', function($scope, $){
        sliderBgSetting();
    } );


    //portfolio_filter
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo_plumco_case_filter.default', function($scope, $){
        portfolio_filter();
    } );


    //team_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_team.default', function($scope, $){
        team_slider();
    } );


    //testimonial
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_testimonial.default', function($scope, $){
        testimonials_slider();
    } );

    //odometer
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_funfact.default', function($scope, $){
        odometer();
    } );

    //partners_slider
    elementorFrontend.hooks.addAction( 'frontend/element_ready/wpo-plumco_client.default', function($scope, $){
        partners_slider();
    } );
    
 
} );


})(jQuery);  