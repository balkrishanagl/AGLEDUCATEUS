  <ul class="news_list" id="target">
  <?php if(sizeof($news_data) > 0){
	  foreach($news_data as $news){?>
    <li>
      <div class="left_img"> <img src="<?php echo base_url().$news->main_image;?>" alt="<?php echo $news->news_title;?>"> </div>
      <div class="right_cont">
        <h4><?php echo $news->news_title;?></h4>
        <div class="dates"><?php echo date('d F Y', strtotime($news->created));?></div>
		
		<?php if(strlen($news->content)>165){
				$news_pos = strpos($news->content, ' ', 165);
				$news_cnt = substr($news->content,0,$news_pos );
				echo strip_tags($news_cnt).'...';
			}else{
					echo strip_tags($news->content);
			} ?>
        <a href="<?php echo base_url().'post/'.$news->slug;?>" class="btn2">Know More</a> </div>
    </li>
  <?php }
 }else{ ?>
  <div><h2>No Any News Found!</h2></div>
  <?php }?>   
  </ul>

  <?php if(sizeof($news_data) > 0){ ?>
  <div class="pagerSec">
        <ul class="tabs">
          
		  <?php echo $this->ajax_pagination->create_links(); ?>
        </ul>
      </div>
	  
  <?php } ?>  
  