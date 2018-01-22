<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$exhibition_data->main_image; ?>" alt="<?php echo $exhibition_data->name; ?>">
        <div class="tags inner_tags"> <span class="tag1"><?php if(isset($exhibition_data->name) && $exhibition_data->name !=""){ echo $exhibition_data->name; }?></span>
          <p><?php echo date("jS",strtotime($exhibition_data->start_date)).' & '.date("jS",strtotime($exhibition_data->end_date)).' '.date('F Y', strtotime($exhibition_data->start_date)); ?> (<?php echo date('D', strtotime($exhibition_data->start_date)). '-'. date('D', strtotime($exhibition_data->end_date));?>) <?php if(isset($exhibition_data->location) && $exhibition_data->location != ""){ echo $exhibition_data->location; }?></p>
          <!--<a href="#" class="btn1">Register Now</a>--> </div>
      </li>
    </ul>
  </div>
  
  <div class="form_box">
    <form name="city_exhibition_register" method="post" id="city_exhibition_register">
	
	<div class="successMsg"><?php if($this->session->flashdata('success')){ echo $this->session->flashdata('success'); } ?></div>
	<input type="hidden" name="formName" value="City Exhibition Register">
	<input type="hidden" name="exhibition_city" value="<?php echo $cityId; ?>">
      <h3>Register Now For Free Entry
        at Expo</h3>
      <ul>
	  
        <li>
		 <div class="form-group">
          <input type="text" placeholder="Full Name*" class="names"  name="name" id="name">
		  <div class="help-block with-errors"></div>
		 </div>
        </li>
        <li>
		<div class="form-group">
          <input type="email" placeholder="Email*" class="email" name="email" id="email">
		<div class="help-block with-errors"></div>
		</div>
        </li>
        <li>
		<div class="form-group">
          <input type="text" placeholder="Mobile No.*" class="phone" name="mobile" id="mobile">
		<div class="help-block with-errors"></div>
		</div>
        </li>
        <li>
		<div class="form-group">
          <input type="text" placeholder="City*" class="city" name="user_city" id="user_city">
		<div class="help-block with-errors"></div>
		</div>
        </li>
        <li>
		<div class="form-group">
          <select class="course" id="qualification" name="qualification">
		  <option value="">Educational Qualification</option>
            <option value="Graduate"> Graduate</option>
            <option value="Post Graduate"> Post Graduate</option>
            <option value="Under Graduate"> Under Graduate</option>
            
          </select>
		<div class="help-block with-errors"></div>
		</div>
        </li>
        <li>
		<div class="form-group">
          <select class="course" name="course" id="course">
			<option value="">Select Course</option>
            <?php foreach($course_data as $course){?>
			 <option value="<?php echo $course->id;?>" <?php if(isset($_POST['course']) && $_POST['course']==$course->id){ ?> selected <?php } ?>><?php echo $course->name;?></option>
		<?php } ?>
          </select>
		<div class="help-block with-errors"></div>
		</div>
        </li>
        <li>
          <input type="submit" value="Get your Ticket Now" >
        </li>
      </ul>
    </form>
  </div>
</section>

<!-- ------------- end banner ------------------------- --> 



<!-- --------------- start gallery and education ----------- -->
<section class="gallery_educat_box">

<?php if(sizeof($gallery_data) > 0){ ?>
  <div class="thumb_gallery">
  <div class="slider">
  <?php foreach($gallery_data as $gallery){ ?>
    
      <figure> <img src="<?php echo base_url().'uploads/gallery/'.$gallery->images; ?>" alt="<?php echo $gallery->name;?>"> </figure>
   
	<?php 
	} ?>
	</div>
	<div class="slider-nav-thumbnails thumbs_imgage">
	<?php foreach($gallery_data as $galleryDetail){ ?>
    
      <div><img src="<?php echo base_url().'uploads/gallery/'.$galleryDetail->images; ?>" alt="<?php echo $galleryDetail->name;?>"></div>
    
	<?php } ?>
	</div>
  </div>
 <?php } ?> 

  <div class="educate">
    <h1><?php if(isset($exhibition_data->name) && $exhibition_data->name != "" ){ echo $exhibition_data->name; } ?></h1>
    <?php if(isset($exhibition_data->event_content) && $exhibition_data->event_content != "" ){ echo $exhibition_data->event_content; } ?>
  </div>
</section>
<!-- --------------- end gallery and education ----------- --> 

<!-- ------------ start your dream ------------------- -->

<?php if(sizeof($dream_collage) > 0){?>
<section class="your_dream">



  <h1>Choose your Dream College</h1>
  <p class="tag_line">Get guided by Professionals from IIT, NIT & Career experts on the basis:</p>
  <div class="icon_box">
    <ul>
	
<?php 
$arrDreamCollage = json_decode($exhibition_data->dream_collage, true);
$i = 0;
if(count($arrDreamCollage) <= 6){
foreach($arrDreamCollage as $dreamCollage){
	$dreamCollageData = $this->dream_colleges_model->get_collage_data_by_id($dreamCollage);
	if ($i % 2 == 0){
	?>
      <li>
        <div class="icon_text desk_text"><?php echo $dreamCollageData->name;?></div>
        <div class="red_btn"><img src="<?php echo base_url();?>assets/site/images/red_btn.png" alt=""></div>
        <div class="icon"><img src="<?php echo base_url().$dreamCollageData->image; ?>" alt=""></div>
        
        <div class="icon_text mob_text"><?php echo $dreamCollageData->name;?>	</div>
        
        
      </li>
<?php 
	}else{ ?>
		
		<li>
        
        <div class="red_btn"><img src="<?php echo base_url();?>assets/site/images/red_btn.png" alt=""></div>
        <div class="icon"><img src="<?php echo base_url().$dreamCollageData->image; ?>" alt=""></div>
        <div class="icon_text desk_text"><?php echo $dreamCollageData->name;?></div>
		<div class="icon_text mob_text"><?php echo $dreamCollageData->name;?>	</div>
        
        
      </li>
	  
	<?php }
$i++; 
}
} ?>
    </ul>
  </div>
</section>
<?php } ?>
<!-- ----------- end your dream --------------------- --> 

<!-- ---------- start offered course ---------------- -->

<section class="offered">
  <div class="left_offered">
    <div class="middle_content">
      <h3>Courses Offered by<br/>
        Participating Institutions</h3>
      <ul>
	  <?php 
		$arrCourse = json_decode($exhibition_data->course, true);

		foreach($arrCourse as $course){
			$courseData = $this->course_model->get_course_data_by_id($course); ?>
			<li><?php echo $courseData->name; ?> </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="right_offered">
  <img src="<?php echo base_url()?>assets/site/images/offered_img_right.jpg" alt="">
   </div>
</section>

<!-- ---------end offered course ------------------ --> 

<!-- --------------- start university ----------- -->

<div class="participet unerversity">
  <h3>100+ Universities to Choose From</h3>
  <p class="tag_line">Choose Your College Based on Career Experts Guidance, Placement History & Alumini,  Accreditations &  International Collaborations, Infrastructure / Faculty / Peer Group</p>
  <div class="logos_box">
    <ul class="owl-carousel logos">
	  <?php 
		$arrUniversity = json_decode($exhibition_data->universities, true);

		foreach($arrUniversity as $universities){
			$universityData = $this->universities_model->get_universities_data_by_id($universities); ?>
      <li><img src="<?php echo base_url().$universityData->image;?>" alt=""> <img src="images/1.jpg" alt=""></li>
	
	<?php } ?>
    </ul>
    <div class="slide_arrow_box"> <a class="btn prev prev1" id=""></a> <a class="btn next next1" id=""></a></div>
  </div>
</div>

<!-- --------------- end university ----------- --> 


<!-- --------------- start map -------------------------- -->

<?php if(isset($exhibition_data->map) && $exhibition_data->map !=""){?>

<section class="map"> 
<iframe src="<?php echo $exhibition_data->map; ?>" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>

<?php } ?>

<!-- --------------- end map --------------------------- --> 