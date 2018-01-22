<!-- start banner box -->

<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
      <div class="tag1">News and Events</div>
    </li>
  </ul>
</div>

<!-- end banner box --> 

<!-- start breadcrum -->
<div class="breadcrum">
  <div class="wrapper">
    <ul>
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li>News and Events</li>
    </ul>
  </div>
</div>
<!-- end breadcrum --> 



<div class="news_events">
  <div class="wrapper">

    
    <div class="event_list1">
      <ul>
	  
	  <?php foreach($news_event as $news_events){ 
	  
	  if($news_events->type == "News"){
		$dtDate = date('M d',strtotime($news_events->created));
		}else{
			$dtDate = date('M d',strtotime($news_events->start_date));
					
		}	
		
	  ?>
        <li>
          <div class="thumb"><img src="<?php echo base_url().$news_events->main_image;?>" alt=""></div>
          <div class="content1">
           
            <h4><?php echo $news_events->name;?></h4>
            <div class="date"><?php echo 'Post by '.ucwords($news_events->created_by).' | '. $dtDate; ?></div>
            
            <p><?php if(strlen($news_events->event_content)>100){
				$news_pos = strpos($news_events->event_content, ' ', 100);
						$newsshort_cnt = substr($news_events->event_content,0,$news_pos );
						echo strip_tags($newsshort_cnt).'...';
				}else{
					echo $news_events->event_content;
				}  ?></p>
            <a href="<?php echo base_url().'post/'.$news_events->slug;?>">More <img src="<?php echo base_url(); ?>assets/site/images/red_arrow.png" alt=""></a>
            
            
            </div>
            
            
        </li>
	  <?php } ?>
        
      </ul>
    </div>
    
  </div>
</div>
