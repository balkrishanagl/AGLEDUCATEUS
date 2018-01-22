$(document).ready(function(e) {
    
var owl1 = $("#home_slide");	
  owl1.owlCarousel({
	  loop:true,
	  autoPlay: 7000,
	    afterAction: function(el){
   //remove class active
   this
   .$owlItems
   .removeClass('active')

   //add class active
   this
   .$owlItems //owl internal $ object containing items
   .eq(this.currentItem - 3)
   .addClass('active')    
    }, 
      items : 1, //10 items above 1000px browser width
      itemsDesktop : [1100,1], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,1], // betweem 900px and 601px
      itemsTablet: [800,1], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $("#next1").click(function(){
    owl1.trigger('owl.next');
  })
  $("#prev1").click(function(){
    owl1.trigger('owl.prev');
  });
  
 
  
  var owl1 = $(".logos");	
  owl1.owlCarousel({
	  loop:true,
	  autoPlay: false,
      items : 5, //10 items above 1000px browser width
      itemsDesktop : [1300,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [800,2], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next1").click(function(){
    owl1.trigger('owl.next');
  })
  $(".prev1").click(function(){
    owl1.trigger('owl.prev');
  });
  
  
    var owl2 = $(".gallery");	
    owl2.owlCarousel({
	  loop:true,
	  autoPlay: false,
	  dots:true,
      items : 1, //10 items above 1000px browser width
      itemsDesktop : [1100,1], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,1], // betweem 900px and 601px
      itemsTablet: [800,1], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next2").click(function(){
    owl2.trigger('owl.next');
  })
  $(".prev2").click(function(){
    owl2.trigger('owl.prev');
  });
  
  
    var owl3 = $(".testi");	
    owl3.owlCarousel({
	  loop:true,
	  autoPlay: false,
	 
      items : 2, //10 items above 1000px browser width
      itemsDesktop : [1100,1], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,1], // betweem 900px and 601px
      itemsTablet: [800,1], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next3").click(function(){
    owl3.trigger('owl.next');
  })
  $(".prev3").click(function(){
    owl3.trigger('owl.prev');
  });
  

  
    var owl4 = $(".counslares");	
  owl4.owlCarousel({
	  loop:true,
	  autoPlay: false,
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1300,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [800,2], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next4").click(function(){
    owl4.trigger('owl.next');
  })
  $(".prev4").click(function(){
    owl4.trigger('owl.prev');
  });
  
  
  var owl6 = $(".video_slider");	
  owl6.owlCarousel({
	  loop:true,
	  autoPlay: false,
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1300,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [800,2], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next6").click(function(){
    owl6.trigger('owl.next');
  })
  $(".prev6").click(function(){
    owl6.trigger('owl.prev');
  });
  
  
  
  var owl7 = $(".blogBxSlider");	
  owl7.owlCarousel({
	  loop:true,
	  autoPlay: false,
	  dots:true,
      items :3, //10 items above 1000px browser width
      itemsDesktop : [1300,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,2], // betweem 900px and 601px
      itemsTablet: [800,2], //2 items between 600 and 0
      itemsMobile : [599,1], // itemsMobile disabled - inherit from itemsTablet option
  });
    // Custom Navigation Events
  $(".next7").click(function(){
    owl7.trigger('owl.next');
  })
  $(".prev7").click(function(){
    owl7.trigger('owl.prev');
  });
  
  
  

$(".tabs_btn li a").click(function(){
	
$(".tabs_btn li a").removeClass("active");	

$(this).addClass("active");	

var rel = $(this).attr("rel");

$(".tabs").addClass("hide");

$("#" + rel).removeClass("hide");
	

});	


$(".top_click").click(function(){	
$(this).next().slideToggle();
$(this).toggleClass("active");	

	});
	
	
$(".sub_menu").parent().addClass("drop-arrow");


$(".drop-arrow .drop_mrnu").click(function(){	   
if ($(this).next(".sub_menu").is(':visible')) 

{
$(this).next(".sub_menu").slideUp();
$(this).removeClass("active");	

} 

else{
$(".sub_menu").slideUp();
$(".drop-arrow .drop_mrnu").removeClass("active");
$(this).next(".sub_menu").slideDown();
$(this).addClass("active");	 
		
}

});	
	
	
	
	$('.slider').slick({
 	slidesToShow: 1,
 	slidesToScroll: 1,
 	arrows: true,
 	fade: false,
 	asNavFor: '.slider-nav-thumbnails',
 });

 $('.slider-nav-thumbnails').slick({
 	slidesToShow: 5,
 	slidesToScroll: 1,
 	asNavFor: '.slider',
 	dots: false,
	arrows: true,
	infinite: false,
 	focusOnSelect: true
 });

 // Remove active class from all thumbnail slides
 $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

 // Set active class to first thumbnail slides
 $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 $('.slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
 	var mySlideNumber = nextSlide;
 	$('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
 	$('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
});
	
	

$(".tab_btn li a").click(function(){


$(".tab_btn li").removeClass("active");

$(this).parent().addClass("active");

var rel1 = $(this).attr("rel");	

$(".tab_box").addClass("hide");

$("#" + rel1).removeClass("hide");
	
});	
	
	
	
$(".accordain_box h4").click(function(){
	
 if($(this).next().is(":visible")){
	 
 $(".accordain_box h4").next().slideUp(); 
 
 $(this).removeClass("active");
  
}
	 
	 
else	
	
{
	
$(".data").slideUp();

$(this).next().slideDown();
 $(".accordain_box h4").removeClass("active");
$(this).addClass("active");

	
}
	 
	
 });
	
	
	
$(".top_header a.search").click(function(){

$(this).next().toggleClass("active");	
	
});	




jQuery('.fancybox').fancybox();

jQuery(".team").fancybox({
    fitToView : true,
    wrapCSS : 'team_wrap',

});

			 $('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
			 
		

	jQuery(".multiple_gallery").fancybox({
    fitToView : true,
    wrapCSS : 'popup_wrapp',
	
		
				
  });	 
  

  
  
	
	
});


$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >=100) {
        $(".socail").addClass("active");
    } else {
        $(".socail").removeClass("active");
    }
});