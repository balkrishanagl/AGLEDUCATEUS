 <!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
	<?php foreach($slider_details as $slider){ ?>
      <li> <img src="<?php echo base_url().$slider->banner_image; ?>" alt="">
        <div class="tags">  <span class="tag1"><?php echo $slider->img_caption; ?></span>
          <p><?php echo $slider->banner_content; ?></p>
          <a href="<?php echo $slider->url; ?>" class="btn1">Register Now</a> </div>
      </li>
    <?php } ?>
    </ul>
  </div>
 </section>

<!-- ------------- end banner ------------------------- -->

<div class="four_section">
  <ul>
    <li>
      <div class="icons"><img src="<?php echo base_url(); ?>assets/site/images/icon1.png" alt=""></div>
      <h3>Scholarships</h3>
      <p>Numerous Indian and foreign universities, colleges, etc., all under one roof, Offering   scholarships to meritorious students.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url(); ?>assets/site/images/icon2.png" alt=""></div>
      <h3>admission</h3>
      <p>With this education fair, learn about, understand, evaluate and compare, to find the right educational institution.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url(); ?>assets/site/images/icon3.png" alt=""></div>
      <h3>global education</h3>
      <p>The education fair upgrades education trends, latest happenings, and new developments in global education.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url(); ?>assets/site/images/icon4.png" alt=""></div>
      <h3>professional guidance</h3>
      <p>A college fair like no other, Educatus Expo Integrates Guidance and Counseling, all at one place.</p>
    </li>
  </ul>
</div>

<!-- ----------------start about us ---------------- -->

<div class="aboutus"> <span class="line1"></span> <span class="line2"></span> <span class="line3"></span> <span class="line4"></span> <span class="line5"></span> <span class="line6"></span>
  <div class="about"> <img src="<?php echo base_url(); ?>assets/site/images/about.png" alt="">
    <div class="edu"> <strong>Educatus</strong>
      <p>Lorem ipsum dolor sit ametG FWF WAVEFSI</p>
    </div>
  </div>
  <div class="about_video">
    <div class="video">
	<?php 
					if($about_data->video_url != ""){
								  
					$videoData = $about_data->video_url;
									
				?>
			<iframe src="<?php echo $videoData; ?>" height="118px" width="202.8px" frameborder="0"></iframe>	
		<?php } ?>	
	</div>
    <div class="video_data">
      <p><?php if(strlen($about_data->page_content)>500){
				$about_pos = strpos($about_data->page_content, ' ', 500);
				$about_cnt = substr($about_data->page_content,0,$about_pos );
				echo strip_tags($about_cnt).'...';
			}else{
					echo strip_tags($about_data->page_content);
			} ?>
       <a href="<?php echo base_url().'about'?>" class=""> Know More</a> </p>
      <!--<a href="#" class="btn2">360&deg; Virtual Tour</a>--> <a href="#" class="btn2">Register Now</a> </div>
  </div>
</div>

<!-- ---------------end about us-------------------- --> 

<!-- ------------ help page --------------------- -->

<div class="educatate_help">
  <h3>How Educatus can help you</h3>
  <ul>
  <?php foreach($help_data as $help){ ?>
    <li> <img src="<?php echo base_url().$help->image; ?>" alt="">
      <p><strong><?php echo $help->title; ?></strong></p>
      
  <?php } ?>
  </ul>
</div>
<!-- ---------- end help page---------------- --> 

<!-- --------- -- up coming ------------- -->

<div class="layout1">
<div class="upcoming">
  <h1>Upcoming Events</h1>
  <p>Choose Your College Based on Career Experts Guidance, Placement History & Alumini,  Accreditations &  International Collaborations, Infrastructure / Faculty / Peer Group</p>
  <ul>
  <?php if(sizeof($event_data) > 0){ 
		foreach($event_data as $event){ 
		$currDate = date("Y-m-d");
		
		$startDate = date("Y-m-d",strtotime($event->start_date));
		$endDate = date("Y-m-d",strtotime($event->end_date));
		//echo $currDate; die;
		if(strtotime($currDate) >= strtotime($startDate) && strtotime($currDate) <= strtotime($endDate)){
		?>
    <li>
      <div class="thumb"> <img src="<?php echo base_url().$event->thumb_image; ?>" alt=""> <span class="title"><?php echo $event->city_name; ?></span> </div>
      <div class="date"><img src="<?php echo base_url(); ?>assets/site/images/date.png" alt=""> <?php echo date("jS",strtotime($event->start_date)).' & '.date("jS",strtotime($event->end_date)).' '.date('F Y', strtotime($event->start_date)); ?></div>
      <p><?php echo $event->name; ?></p>
      <a href="<?php echo base_url().'exhibition/'.$event->slug;?>" class="btn2">Know More</a> </li>
  <?php }
		}
  }  ?>
  </ul>
</div>
</div>
<!-- ----------end upcoming ------------ --> 

<!-- ------------ start participet ------------ -->

<div class="participet">
  <h3>Participating Colleges</h3>
  <div class="logos_box">
    <ul class="owl-carousel logos">
	<?php foreach($participating_colleges as $participating_college){ ?>
      <li><img src="<?php echo base_url().$participating_college->main_image ?>" alt=""></li>
	<?php } ?>
    </ul>
    <div class="slide_arrow_box"> <a class="btn prev prev1" id=""></a> <a class="btn next next1" id=""></a></div>
  </div>
</div>

<!-- ------------ end participet ----------- --> 

<!-- -------------- start gallery and faq box ------------------- -->
<div class="layout1">
<div class="gallery_faq_box">
  <div class="thumb_gallery">
    <h1>Gallery</h1>
    <div class="slider">
	
	<?php if(sizeof($gallery_details) > 0){
		foreach($gallery_details as $gallery){
		?>
      <figure> <img src="<?php echo base_url().'uploads/gallery/'.$gallery->images; ?>" alt="One"> </figure>
	  
		<?php }
		} ?>
		
      
    </div>
    <div class="slider-nav-thumbnails thumbs_imgage">
	<?php if(sizeof($gallery_details) > 0){
		foreach($gallery_details as $gallery_thum){
		?>
      <div><img src="<?php echo base_url().'uploads/gallery/'.$gallery_thum->images; ?>" alt=""></div>
      <?php }
		} ?>
	
    </div>
  </div>
  
  <div class="faq_box">
    <h1>Faq</h1>
    <ul>
	<?php foreach($faq as $faq_data){ ?>
      <li>
        <h4><?php echo $faq_data->title; ?></h4>
		
		<?php if(strlen($faq_data->description)>150){
				$faq_pos = strpos($faq_data->description, ' ', 150);
				$faq_cnt = substr($faq_data->description,0,$faq_pos );
				echo strip_tags($faq_cnt).'...';
			}else{
					echo strip_tags($faq_data->description);
			} ?>
        
      </li>
	<?php } ?>
    </ul>
    <a href="<?php echo base_url().'faq/'; ?>" class="btn2">Know More</a> <img src="<?php echo base_url(); ?>assets/site/images/thumb1.jpg" class="faq_img" alt=""> </div>
</div>
</div>

<!-- -------------- end gallery and faq box ------------------- --> 

<!-- ------------start testimonials -------------------- -->

<div class="testimonils">
  <!--<h1>Testimonial</h1>-->
  <h1><img src="<?php echo base_url();?>assets/site/images/testi_name.png" alt=""></h1> 
  <div class="testi_box">
    <ul class="owl-carousel testi">
	
	<?php foreach($testimonial_data as $testimonial){ ?>
      <li>
        <div class="test_content"><?php echo $testimonial->description; ?> <strong><?php echo $testimonial->title; ?></strong> </div>
        <div class="pic"><img src="<?php echo base_url().$testimonial->image; ?>" alt=""></div>
      </li>
     <?php } ?>
    </ul>
    <div class="slide_arrow_box"> <a class="btn prev prev3" id=""></a> <a class="btn next next3" id=""></a></div>
  </div>
</div>

<!-- -----------end testinomilas -------------------- --> 