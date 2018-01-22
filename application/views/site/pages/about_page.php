<!-- start banner box -->

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

<?php if($page_data->page_slug ==  "ficci"){ ?>
<div class="about_sec">
  <div class="wrapper">
    <div class="regist_text title_bdr" >
      <h1><?php echo $page_data->page_title; ?></h1>
      <p><?php echo $page_data->page_content; ?></p>
    </div>
    <div class="left_about regist"> <img src="<?php echo base_url().$page_data->page_image; ?>" alt="<?php echo $page_data->page_title; ?>" class="wid50" alt=""> </div>
  </div>
</div>
<?php }else{ ?>

<div class="about_sec">
  <div class="wrapper">
  <div class="regist_text title_bdr" > 
    <h1><?php echo $page_data->page_title; ?></h1>
    
	<p><?php echo $page_data->page_content; ?></p>

</div>
<div class="left_about regist">
 <img src="<?php echo base_url().$page_data->page_image; ?>" alt="">
   </div>
  </div>
</div>
<?php } ?>

<!-- end about section --> 