<!-- start banner box -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">International Presence</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<!-- end banner box --> 

<!-- ------------ name-------------------------- -->




<div class="exibition_name">
<div class="layout">
<h1>International Presence</h1>

<?php echo $page_data->page_content;?>

</div>

</div>


<!-- --------- -- up coming ------------- -->



<div class="upcoming presence">
<div class="layout">
  
  <ul>
  <?php if(sizeof($international_presence) > 0){ 
		foreach($international_presence as $internationalPresence){ 
		$currDate = date("Y-m-d");
		
		$startDate = date("Y-m-d",strtotime($internationalPresence->start_date));
		$endDate = date("Y-m-d",strtotime($internationalPresence->end_date));
		//echo $currDate; die;
		if(strtotime($currDate) >= strtotime($startDate) && strtotime($currDate) <= strtotime($endDate)){
		?>
    <li>
      <div class="thumb"> <img src="<?php echo base_url().$internationalPresence->thumb_image; ?>" alt="<?php echo $internationalPresence->name;?>"> <span class="title"><?php echo $internationalPresence->city_name; ?></span> </div>
      <div class="date"><img src="<?php echo base_url(); ?>assets/site/images/date.png" alt=""> <?php echo date("jS",strtotime($internationalPresence->start_date)).' & '.date("jS",strtotime($internationalPresence->end_date)).' '.date('F Y', strtotime($internationalPresence->start_date)); ?></div>
      <p><?php echo $internationalPresence->name; ?></p>
      <a href="<?php echo base_url().'exhibition/'.$internationalPresence->slug;?>" class="btn2">Know More</a> </li>
	  <?php }
		}
  }  ?>
  </ul>
</div>


</div>
<!-- ----------end upcoming ------------ --> 
