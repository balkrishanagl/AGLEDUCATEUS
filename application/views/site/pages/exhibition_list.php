<!-- start banner box -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">Exhibitions</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<!-- end banner box --> 

<!-- ------------ name-------------------------- -->



<div class="layout">
<div class="exibition_name">
<h1>Exihibitions</h1>

<?php echo $page_data->page_content;?>

</div>

</div>


<!-- --------- -- up coming ------------- -->

<div class="layout">

<div class="upcoming">
  <h1>Upcoming Events</h1>
  <p>Choose Your College Based on Career Experts Guidance, Placement History & Alumini,  Accreditations &  International Collaborations, Infrastructure / Faculty / Peer Group</p>
  <ul>
  <?php if(sizeof($exhibitions_data) > 0){ 
		foreach($exhibitions_data as $exhibitions){ 
		$currDate = date("Y-m-d");
		
		$startDate = date("Y-m-d",strtotime($exhibitions->start_date));
		$endDate = date("Y-m-d",strtotime($exhibitions->end_date));
		//echo $currDate; die;
		if(strtotime($currDate) >= strtotime($startDate) && strtotime($currDate) <= strtotime($endDate)){
		?>
    <li>
      <div class="thumb"> <img src="<?php echo base_url().$exhibitions->thumb_image; ?>" alt="<?php echo $exhibitions->name;?>"> <span class="title"><?php echo $exhibitions->city_name; ?></span> </div>
      <div class="date"><img src="<?php echo base_url(); ?>assets/site/images/date.png" alt=""> <?php echo date("jS",strtotime($exhibitions->start_date)).' & '.date("jS",strtotime($exhibitions->end_date)).' '.date('F Y', strtotime($exhibitions->start_date)); ?></div>
      <p><?php echo $exhibitions->name; ?></p>
      <a href="<?php echo base_url().'exhibition/'.$exhibitions->slug;?>" class="btn2">Know More</a> </li>
	  <?php }
		}
  }  ?>
  </ul>
</div>


</div>
<!-- ----------end upcoming ------------ --> 
