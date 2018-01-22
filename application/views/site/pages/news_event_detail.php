<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
      <div class="tag1"><?php echo $news_event_detail->name; ?></div>
    </li>
  </ul>
</div>

<!-- end banner box --> 

<!-- start breadcrum -->
<div class="breadcrum">
  <div class="wrapper">
    <ul>
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li><a href="<?php echo base_url();?>news-events">News and events</a></li>
      <li><?php echo $news_event_detail->name; ?></li>
    </ul>
  </div>
</div>
<!-- end breadcrum --> 

<!-- start about section -->

<div class="about_sec">
  <div class="wrapper">
    
    <div class="regist_text title_bdr" > 
	
	 <?php if($news_event_detail->type == "News"){
		$dtDate = date('M d',strtotime($news_event_detail->created));
		}else{
			$dtDate = date('M d',strtotime($news_event_detail->start_date));
					
		}	?>
       
 <div class="date_pos"><?php echo 'Post by '.ucwords($news_event_detail->created_by).' | '. $dtDate; ?></div>

	<p><?php echo $news_event_detail->event_content; ?></p>
 </div>
    <div class="left_about regist">
      
      <img src="<?php echo base_url().$news_event_detail->main_image; ?>" alt="">
      
       </div>
  </div>
</div>

<!-- end about section --> 