<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().'assets/site/images'?>news_details.jpg" alt="">
        <div class="tags inner_tags"> <span class="tag1">Educatus News</span> </div>
      </li>
    </ul>
  </div>

</section>

<!-- ------------- end banner ------------------------- --> 

<!---------------- start blog section ---------------------- -->

<section class="blogMainSec">
  <div class="wrapper">
    <aside class="blogLsec">
      <div class="blogSubBanner">
        <ul>
          <li><img src="<?php echo base_url().$news_data->main_image;?>" alt="<?php echo $news_data->news_title;?>"></li>
        </ul>
      </div>
      <div class="havingFunSec">
        <h2><?php echo $news_data->news_title;?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('F d,  Y', strtotime($news_data->created));?></span></h2>
        <?php echo $news_data->content;?>
      </div>
    
     
    </aside>
    <aside class="blogRsec">
      
      <div class="popularBlogSec news_view">
        <h2>Most Viewed</h2>
        <ul>
		<?php if(sizeof($most_viewed_news_data) > 0){
			foreach($most_viewed_news_data as $most_views){?>
          <li><a href="<?php echo base_url().'post/'.$most_views->slug;?>">
            <div class="popularBlogThumb"><img src="<?php echo base_url().$most_views->main_image;?>" alt="<?php echo $most_views->news_title; ?>"></div>
            <div class="popularBlogRsec">
              <ul>
                <li>
                  <h3><?php echo $most_views->news_title; ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('d-M-Y', strtotime($most_views->created));?></span></h3>
                </li>
              </ul>
            </div>
            </a></li>
		<?php } 
		}?>
        </ul>
      </div>
      
     
    </aside>
  </div>
</section>