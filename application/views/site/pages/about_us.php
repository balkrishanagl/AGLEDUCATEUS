<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">About Educatus</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<!-- -------------- start All projects --------------------- -->

<div id="cbp-so-scroller" class="cbp-so-scroller">
				<section class="cbp-so-section">

<div class="projects">
<div class="layout">
  <div class="left_project"><img src="<?php echo base_url().$page_data->page_image; ?>" alt=""></div>
  <div class="right_project">
    <?php echo $page_data->page_content; ?>
  </div>
  </div>
</div>

</section>

<!-- -------------- end All projects --------------------- --> 

<!-- -------------- start our mission ------------------ -->
	<section class="cbp-so-section">
<div class="our_mission">
<div class="layout">
  <div class="mission_content">
    <h2>Our Mission</h2>
    <?php echo $page_data->mission; ?>
  </div>
  </div>
</div>

</section>

<!-- ---------------- end our mission ----------------- --> 

<!-- ------------ start educates history ------------- -->
	<section class="cbp-so-section">
<div class="educates_history">
<div class="layout">
  <h1>Educatus History</h1>
  <p class="tag_title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu blandit lorem, vitae congue dolor. </p>
  <ul>
  
  <?php 
		if(sizeof($history_data) > 0){
		foreach($history_data as $history){ ?>
    <li>
      <div class="year"><?php echo $history->year; ?></div>
      <div class="left_hist">
      
      <span class="red_arrow"><img src="images/red_arrow.png" alt=""></span>
        <div class="circle"><span class="imgs"><img src="<?php echo base_url().$history->image_1; ?>" alt="<?php echo $history->title_1; ?>"></span></div>
        <div class="circle_content">
          <h3><?php echo $history->title_1; ?></h3>
          <?php echo $history->detail_1; ?>
        </div>
      </div>
      
      
      <div class="right_hist">
      
      
      <span class="blue_arrow"><img src="images/blue_arrow.png" alt=""></span>
         <div class="circle"><span class="imgs"><img src="<?php echo base_url().$history->image_2; ?>" alt=""></span></div>
        <div class="circle_content">
          <h3><?php echo $history->title_2; ?></h3>
         <?php echo $history->detail_2; ?>
        </div>
      </div>
      
    </li>
    
		<?php } 
		}
		?>

  </ul>
  </div>
  </div>
</section>

</div>

<!-- ------------ end educates history ------------- --> 
