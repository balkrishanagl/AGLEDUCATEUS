<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url(); ?>assets/site/images/register_online_banner.jpg" alt="">
        <div class="inner_tags"> <span class="tag1">Search</span> </div>
      </li>
    </ul>
  </div>
  
</section>
<!-- ------------- end banner ------------------------- -->

 <div class="search_page">



<div class="layout">

  <h1><?php if(isset($total)){ echo $total; } ?> results for "<?php echo $_GET['query'];?>"</h1>
  <p>If you didn't find what you were looking for, try again!</p>
  
  <div class="searchinput">
		<form name="search" method="GET" action="<?php echo base_url(); ?>search">
			<input type="text" name="query" id="query" placeholder="Search">
			<input type="submit" id="btn_search" value="">
		</form>
      </div>
  
  <ul class="serach_line">
  <?php if(sizeof($search_news_data) > 0){ 
	foreach($search_news_data as $news){?>
  <li>
  
  <h3><?php echo $news->news_title;?></h3>
  <p><?php if(strlen($news->content)>150){
				$news_pos = strpos($news->content, ' ', 150);
				$news_cnt = substr($news->content,0,$news_pos );
				echo strip_tags($news_cnt).'...';
			}else{
					echo strip_tags($news->content);
			} ?> </p>
  <a href="<?php echo base_url().'post/'.$news->slug;?>">READ MORE</a>  
  
  </li>
	<?php }
	} ?>
	
	
	<?php if(sizeof($search_events_data) > 0){ 
	foreach($search_events_data as $event){?>
	  <li>
	  
	  <h3><?php echo $event->name;?></h3>
	  <p><?php if(strlen($event->event_content)>150){
					$news_pos = strpos($event->event_content, ' ', 150);
					$news_cnt = substr($event->event_content,0,$news_pos );
					echo strip_tags($news_cnt).'...';
				}else{
						echo strip_tags($event->event_content);
				} ?> </p>
	  <a href="<?php echo base_url().'exhibition/'.$event->slug;?>">READ MORE</a>  
	  
	  </li>
		<?php }
		} ?>

  
  
  </ul>
  

  
  
  </div>
</div>