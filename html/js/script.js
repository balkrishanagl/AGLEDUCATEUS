$(document).ready(function(e) {
  
  
 $(".top_click").click(function(){	
$(this).next().slideToggle();
$(this).toggleClass("active");	
	
	});
		 
	   
$(".sub_menu").prev("a").addClass("drop");
if((screen.width<=1023))
{


$("nav a.drop").click(function(e){	  
if ($(this).next(".sub_menu").is(':visible')) 

{
$(this).next(".sub_menu").slideUp();
$(this).removeClass("active");	

} 

else{
	
$(".sub_menu").slideUp();
$(this).next(".sub_menu").slideDown();
$("nav a").removeClass("active");
$(this).addClass("active");	 
		
}

});
	
}
    
			
					
  var owl1 = $("#home_slide");	
  owl1.owlCarousel({
	  loop:true,
	  dot:true,
	  autoPlay: 7000,
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
		
		
		
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
    infinite: true,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  infinite: true,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  
  responsive: [
    {
      breakpoint: 980,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
			
			
	jQuery('.fancybox').fancybox();
	 jQuery(".form_box_poup").fancybox({
    fitToView : true,
    wrapCSS : 'popup_wrapp' // add a class selector to the fancybox wrap
  });	 
  
					


});