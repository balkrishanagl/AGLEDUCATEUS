<!-- -------------- start footer -------------------- -->

<footer>
  <div class="top_footer">
    <div class="box box1">
      <h3>About us</h3>
      <ul>
        <!--<li><a href="<?php //echo base_url().'about'?>">Who we are</a></li>
        <li><a href="#">Vision & Mission</a></li>-->
		 <?php $footer_menu = $this->common_model->get_footer_menu('about'); 
			foreach($footer_menu as $footer_menus){
			
			if($footer_menus->parent_id == 0){	
			
	  ?>
			<li><a href="<?php echo $footer_menus->link; ?>"><?php echo $footer_menus->name; ?></a>
			<?php 
			}
			}?>
        
      </ul>
    </div>
    <div class="box box2">
      <h3>EVENTS</h3>
      <ul>
        <!--<li><a href="#">New Delhi</a></li>
        <li><a href="#">Jamshedpur</a></li>
        <li><a href="#">Ranchi</a></li>
        <li><a href="#">Patna</a></li>
        <li><a href="#">Palampur</a></li>
        <li><a href="#">Chandigarh</a></li>
        <li><a href="#">Jammu</a></li>
        <li><a href="#">Srinagar</a></li>-->
		
		<?php $footer_event_menu = $this->common_model->get_footer_menu('events'); 
			if(sizeof($footer_event_menu) > 0){
			foreach($footer_event_menu as $footer_event_menus){
			
			if($footer_event_menus->parent_id == 0){	
			
	  ?>
			<li><a href="<?php echo $footer_event_menus->link; ?>"><?php echo $footer_event_menus->name; ?></a>
			<?php }
			}
			}?>
      </ul>
    </div>
    <div class="box box2">
      <h3>Quick Links</h3>
      <ul>
       		
		<?php $footer_quick_menu = $this->common_model->get_footer_menu('quick links'); 
			if(sizeof($footer_quick_menu) > 0){
			foreach($footer_quick_menu as $footer_quick_menus){
			
			if($footer_quick_menus->parent_id == 0){	
			
	  ?>
			<li><a href="<?php echo $footer_quick_menus->link; ?>"><?php echo $footer_quick_menus->name; ?></a>
			<?php }
			}
			}?>
      </ul>
    </div>
    <div class="box box3">
     <form name="newslatter_form" method="post" id="newslatter_form" data-toggle="validator" role="form">
	 <div class="successMsg"></div>
      <div class="subcribe">
       <h3>Newsletter</h3>
	   <div class="form-group">
        <input type="text" placeholder="Enter your Email address" name="email" id="emailmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required >
        <input type="submit" value="">
		<div class="help-block with-errors"></div>
		</div>
      </div>
	 </form> 
      <div class="socail_box">
        <h3>connect with us</h3>
        <div class="socails">
          <ul>
            <li style="background-color:#365491;"><a href="<?php echo $this->config->item('fbUrl'); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/site/images/face1.png" alt=""> </a></li>
            <li style="background-color:#1da1f3;;"><a href="<?php echo $this->config->item('twitterUrl'); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/site/images/twitter.png" alt=""> </a></li>
            <li style="background-color:#dd4c3b;"><a href="<?php echo $this->config->item('google_url'); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/site/images/google_plus.png" alt=""></a></li>
            <li style="background-color:#0074b1;"><a href="<?php echo $this->config->item('linkedin_url'); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/site/images/linkand.png" alt=""> </a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="box box4">
      <h3>Contact us</h3>
      <p class="add"><?php echo $this->config->item('Address'); ?></p>
         <p class="email"><a href="mailto:<?php echo trim($this->config->item('Email'));?>"> <?php echo trim($this->config->item('Email'));?></a></p>
      <p class="phones"> <a href="tel:+919958203331">+91 9958203331</a> ,<a href="tel:+919818895069">+91 9818895069</a></p>
    </div>
  </div>
  <div class="bottom_footer">
    <p><?php echo $this->config->item('copyright'); ?></p>
  </div>
</footer>

<!-- --------------end footer ---------------------- -->

<div class="mob_footer">
  <div class="vote_link bdr"><a href="tel:913322825787">Call</a></div>
  <div class="vote_link"><a href="mailto:info@educatusexpo.in">Email</a></div>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/jquery-2.1.4.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/validator.js"></script>

<script>
$('#contact_form').validator().on('submit', function (e) {
		//alert("Test");
		if (e.isDefaultPrevented()) {
			
		  } else {
			  
			  
			  var formData = new FormData(this);
			 
				$.ajax({
				type : "POST",
				//url: "<?php echo base_url(); ?>ajax/user/formData",
				url: "<?php echo base_url(); ?>form",
				data : formData,
				dataType: "json",
				async : true,
                cache : false,
                contentType : false,
                processData : false,
				success : function(result) {
					
					$('.successMsg').text(result.msg);
					$('.successMsg').css('color','green');
					
					var curUrl = window.location.href;
					setTimeout(function(){ window.location.href = curUrl; },1500);
					return false;
				},
				error: function(xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			});
			return false;
			  
		  }
});

$('#feedback_form').validator().on('submit', function (e) {
		//alert("Test");
		if (e.isDefaultPrevented()) {
			
		  } else {
			  
			  
			  var formData = new FormData(this);
			 
				$.ajax({
				type : "POST",
				//url: "<?php echo base_url(); ?>ajax/user/formData",
				url: "<?php echo base_url(); ?>form",
				data : formData,
				dataType: "json",
				async : true,
                cache : false,
                contentType : false,
                processData : false,
				success : function(result) {
					
					$('.successMsg').text(result.msg);
					$('.successMsg').css('color','green');
					
					var curUrl = window.location.href;
					setTimeout(function(){ window.location.href = curUrl; },1500);
					return false;
				},
				error: function(xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			});
			return false;
			  
		  }
});

</script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/html5.js"></script>
<link href="<?php echo base_url(); ?>assets/site/css/owl.carousel.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/site/js/owl.carousel.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/slick.css">
<script src="<?php echo base_url(); ?>assets/site/js/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/site/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/jquery.fancybox-buttons.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/site/js/jquery.fancybox-buttons.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/site/css/jquery.fancybox-thumbs.css?v=1.0.7" />
<script src="<?php echo base_url(); ?>assets/site/js/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/script.js"></script>



<!-- end about section --> 

<script>

$('#newslatter_form').validator().on('submit', function (e) {
		
		if (e.isDefaultPrevented()) {
			
		  } else {
			  
			  var formData = new FormData(this);
			
			$.ajax({
				
				url: "<?php echo base_url(); ?>subscribe",
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
		  }
});

$('#city_exhibition_register').on('submit', function (e) {
		//alert("ddd");
		
		if($('#name').val() == ""){
			 $('#name').attr("placeholder", "Please enter your name");
			 $('#name').addClass("error-place");
			 $('#name').addClass("error-place");
			return false;
		}

		if($('#email').val() == ""){
			 $('#email').attr("placeholder", "Please enter your email");
			 $('#email').addClass("error-place");
			return false;
		}
		
			  
		if($('#mobile').val() == ""){
			 $('#mobile').attr("placeholder", "Please enter your mobile number");
			 $('#mobile').addClass("error-place");
			return false;
		}
		
		
		//$cf = $('#mobile');
		
			phone = $('#mobile').val();
			phone = phone.replace(/[^0-9]/g,'');
			if (phone.length != 10)
			{
				$('#mobile').attr("placeholder", "Please enter valid mobile number");
				$('#mobile').val('');
				$('#mobile').focus();
				return false;
			}
		
		
		if($('#user_city').val() == ""){
			 $('#user_city').attr("placeholder", "Please enter your city");
			 $('#user_city').addClass("error-place");
			return false;
		}
		
		if($('#qualification').val() == ""){
			 $('#qualification').addClass("error-border");
			return false;
		}
		
		if($('#course').val() == ""){
			 $('#course').addClass("error-border");
			return false;
		}
		
		
			  var formData = new FormData(this);
			 
				$.ajax({
				type : "POST",
				url: "<?php echo base_url(); ?>form",
				data : formData,
				dataType: "json",
				async : true,
                cache : false,
                contentType : false,
                processData : false,
				success : function(result) {
					
					/* $('.successMsg').text(result.msg);
					$('.successMsg').css('color','green'); */
					alert(result.msg);
					
					var curUrl = window.location.href;
					setTimeout(function(){ window.location.href = curUrl; },1500);
					return false;
				},
				error: function(xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			});
			return false;
			  
		  
});		

	$('#qualification').on('change', function() {
			
			if($('#qualification').val() !=""){
				 $('#qualification').removeClass("error-border");
			}
			
		});
	
	$('#course').on('change', function() {
			
			if($('#course').val() !=""){
				 $('#course').removeClass("error-border");
			}
			
		});

$('#online_register_form').validator().on('submit', function (e) {
		
		if (e.isDefaultPrevented()) {
			
		  } else {
		  }
});		  
</script>


<script type="text/javascript">
function forceLower(strInput) 
{
	$('#fEmail').val(strInput.value.toLowerCase());
	//strInput.value=strInput.value.toLowerCase();
}
</script>

<script>
	$("#search_news").click(function(){
		
		var year_checked = [];
		var month_checked = [];
			$("input[name='news_month[]']:checked").each(function ()
			{
				month_checked.push(parseInt($(this).val()));
			});
			
			$("input[name='news_year[]']:checked").each(function ()
			{
				year_checked.push(parseInt($(this).val()));
			});
		//console.log(year_checked);
		
		 //var formData = new FormData(this);
			 
				$.ajax({
				type : "POST",
				url: "<?php echo base_url(); ?>news-filter",
				data : ({year:year_checked,month:month_checked,is_search:'1'}),
				//dataType: "json",
				
				success : function(result) {
					//alert(result);
					//alert("aya");
					$('#newsData').html('');
					$('#newsData').html(result);
					//$('.pagerSec').html(result.paging);
										
					return false;
				},
					error: function(xhr, resp, text) {
					console.log(xhr, resp, text);
				}
			});
			return false;
	});
	
$("#btn_search").click(function(){
    if($("#query").val() == ""){
		alert("Please enter search query");
		return false;
	}
});

$("#common_search").submit(function(){
    if($("#common_query").val() == ""){
		alert("Please enter search query");
		return false;
	}
});
</script>
</body>
</html>
