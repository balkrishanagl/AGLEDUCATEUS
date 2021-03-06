<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">News</span> </div>
      </li>
    </ul>
  </div>
  
</section>
<!-- ------------- end banner ------------------------- -->
<div class="layout">
<div class="news_box">



  <div class="news_search_box">
    <h2>Search for a News Story</h2>
    <div class="year_box">
      <h2>Year</h2>
	<?php if(sizeof($news_year) > 0){
		for($i=0; $i < count($news_year); $i++){?>
	 <input type="checkbox" id="news_year" name="news_year[]" value="<?php echo $news_year[$i]['Year'];?>" >
      <label><?php echo $news_year[$i]['Year'];?></label>
	<?php }
	}?>
    </div>
    <div class="year_box">
      <h2>Month</h2>
      <ul>
	  <?php if(sizeof($news_month) > 0){
		  for($j=0; $j < count($news_month); $j++){?>
        <li>
          <input type="checkbox" id="news_month" name="news_month[]" value="<?php echo $news_month[$j]['month_val'];?>" >
          <label><?php echo $news_month[$j]['Month'];?></label>
        </li>
       <?php }
	}?>
      </ul>
    </div>
	<input type="submit" class="btn2" id="search_news" value="Search" >
  </div>
  <h1>Educatus News</h1>
  <div class="newsData" id="newsData">
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
		<?php if(isset($paging)){ echo $paging; } ?>
		  <?php echo $this->ajax_pagination->create_links(); ?>
		
        </ul>
   </div>
  <?php }?>  
  <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/site/images/loading.gif'; ?>"/></div></div>
  </div>
</div>
</div>

