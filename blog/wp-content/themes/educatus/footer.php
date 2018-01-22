<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		<!-- -------------- start footer -------------------- -->

<footer>
  <div class="top_footer">
    <div class="box box1">
      <h3>About us</h3>
      <ul>
        <li><a href="http://aglfbapps.in/educateus/about">Who we are</a></li>
        <li><a href="#">Vision & Mission</a></li>
        <li><a href="#">Messages</a></li>
        
      </ul>
    </div>
    <div class="box box2">
      <h3>EVENTS</h3>
      <ul>
        <li><a href="#">New Delhi</a></li>
        <li><a href="#">Jamshedpur</a></li>
        <li><a href="#">Ranchi</a></li>
        <li><a href="#">Patna</a></li>
        <li><a href="#">Palampur</a></li>
        <li><a href="#">Chandigarh</a></li>
        <li><a href="#">Jammu</a></li>
        <li><a href="#">Srinagar</a></li>
      </ul>
    </div>
    <div class="box box2">
      <h3>Quick Links</h3>
      <ul>
 <li><a href="http://aglfbapps.in/educateus/counselling">Counseling</a></li>
        <li><a href="http://aglfbapps.in/educateus/scholarship">Scholarship</a></li>
        <li><a href="#">Educatus Counseling</a></li>
        <li><a href="http://aglfbapps.in/educateus/news">News</a></li>
        <li><a href="http://aglfbapps.in/educateus/online-register">Register Online</a></li>

        <li><a href="http://aglfbapps.in/educateus/faq">FAQ</a></li>
        <li><a href="http://aglfbapps.in/educateus/international-presence">International Presence</a></li>
        <!--<li><a href="#">Feedback</a></li>-->
        <li><a href="http://aglfbapps.in/educateus/blog/">Blog</a></li>
        <li><a href="http://aglfbapps.in/educateus/feedback/">Feedback</a></li>
      </ul>
    </div>
    <div class="box box3">
      <div class="subcribe">
        <h3>Newsletter</h3>
		 <form name="newslatter_form" method="post" id="newslatter_form">
			<input type="text" placeholder="Enter your Email address" name="email" id="emailmail" required>
			<input type="submit" value="">
		</form>
      </div>
      <div class="socail_box">
        <h3>connect with us</h3>
        <div class="socails ">
          <ul>
            <li style="background-color:#365491;"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/face1.png" alt=""> </a></li>
            <li style="background-color:#1da1f3;"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.png" alt=""> </a></li>
            <li style="background-color:#dd4c3b;"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_plus.png" alt=""></a></li>
            <li style="background-color:#0074b1;"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkand.png" alt=""> </a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="box box4">
      <h3>Contact us</h3>
      <p class="add"> S S Exhibitions & Media Pvt. Ltd.<br/>
        130, First Floor, Charmwood Plaza, <br/>
        Charmwood, Eros Garden,<br/>
        Surajkund Road, Faridabad-121009 (HR), India </p>
      <p class="email"><a href="mailto:Info@educatusexpo.in"> Info@educatusexpo.in</a></p>
      <p class="phones"> <a href="tel:+919958203331">+91 9958203331</a> ,<a href="tel:+919818895069">+91 9818895069</a></p>
    </div>
  </div>
  <div class="bottom_footer">
    <p>Copyright © 2017 - Educatus Expo. All Rights Reserved. Works best in IOS and Android.<br/>
      Disclaimer & Term of Use    Mandatory Educatus Disclosure    RTI Compliance    Sitemap</p>
  </div>
</footer>

<!-- --------------end footer ---------------------- -->

<div class="mob_footer">
  <div class="vote_link bdr"><a href="tel:913322825787">Call</a></div>
  <div class="vote_link"><a href="mailto:info@educatusexpo.in">Email</a></div>
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-2.1.4.min.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/owl.carousel.css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/owl.carousel.js"></script>
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/slick.css" rel="stylesheet">
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/slick.js"></script> 



<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.fancybox-buttons.css" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.fancybox-buttons.js"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.fancybox-thumbs.js?v=1.0.7"></script>


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>

<script>
$('#newslatter_form').on('submit', function (e) {
	
	 var formData = new FormData(this);
			
			$.ajax({
				
				url: "http://aglfbapps.in/educateus/subscribe",
				type : "POST",
				data : formData,
				cache:false,
				contentType: false,
				processData: false,
				success : function(result) {
					var hh = JSON.parse(result);
					alert(hh.msg);
					var curUrl = window.location.href;
					setTimeout(function(){ window.location.href = curUrl; },1000);
					return false;
				},
				error: function(xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			});
			
			return false;
});
</script>
</body>
</html>
