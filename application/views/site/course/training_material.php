<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
      <div class="tag1"><?php echo $page_data->page_title; ?></div>
    </li>
  </ul>
</div>

<!-- end banner box --> 

<!-- start breadcrum -->
<div class="breadcrum">
  <div class="wrapper">
    <ul>
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li><?php echo $page_data->page_title; ?></li>
    </ul>
  </div>
</div>
<!-- end breadcrum --> 

<!-- start about section -->

<div class="about_sec">
  <div class="wrapper">
    
    <div class="regist_text table_box title_bdr mB50" > 
    <h1><?php echo $page_data->page_title; ?></h1>
	 <?php echo $page_data->page_content; ?>
	
    </div>

  </div>
</div>

<!-- end about section --> 