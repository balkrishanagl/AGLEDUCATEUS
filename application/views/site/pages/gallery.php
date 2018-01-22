<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">Gallery</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<!-- ------------------ start gallery -------------------------- -->

<div class="galleres">
<div class="layout">

  <h1>Gallery</h1>
  <?php echo $page_data->page_content; ?>
    
    
   
   <div class="tab_btn" >
   <ul>
   
  <?php if(sizeof($year) > 0){
	  
	  $i = 1;
	  foreach($year as $years){?> 
	   <li <?php if($i==1){ echo 'class="active"'; }?>><a href="javascript:void(0);" rel="tab<?php echo $i;?>"><?php echo $years->year;?></a></li>
  <?php $i++;
  } 
  }?>
   </ul>
   
   
   </div>
    
  <?php $y = 1;
  
  foreach($year as $cl_year){ ?>
  
  <div class="tab_box <?php if($y != 1){ echo 'hide'; } ?>" id="tab<?php echo $y;?>">
    
  <ul>
  
  <?php $galleryYear = $cl_year->year;
	
		$gallery = $this->gallery_model->get_gallery_by_year($galleryYear); 
		
		foreach($gallery as $galleryDetail){
		?>
    <li>
      <div class="upper_box"> 
	  <?php if($galleryDetail->type == "image"){ ?>
	  <img src="<?php echo base_url().'uploads/gallery/'.$galleryDetail->images; ?>" class="thumbs" alt="<?php echo $galleryDetail->name; ?>"> 
      <?php }else{ ?>
	  <img src="<?php echo base_url().$galleryDetail->video_image; ?>" class="thumbs" alt="<?php echo $galleryDetail->name; ?>"> 
	  <?php } ?>
      <div class="hoverbg">
	  <?php if($galleryDetail->type == "image"){ ?>
		<a class="multiple_gallery" data-fancybox-group="thumb1" title="<?php echo $galleryDetail->name; ?>" href="<?php echo base_url().'uploads/gallery/'.$galleryDetail->images; ?>"><img src="<?php echo base_url().'uploads/gallery/'.$galleryDetail->images; ?>" class="views" alt="<?php echo $galleryDetail->name; ?>"><img src="<?php base_url()?>assets/site/images/view.png" class="views" alt=""></a>
	  <?php }else{ ?>
		<a class="multiple_gallery" data-fancybox-type="iframe" data-fancybox-group="thumb1" title="<?php echo $galleryDetail->name; ?>" href="<?php echo $galleryDetail->video; ?>"><img src="<?php echo base_url().$galleryDetail->video_image; ?>" class="views" alt="<?php echo $galleryDetail->name; ?>"></a>
	  <?php } ?>
        
        </div>
      
      
      </div>
      <p><?php echo $galleryDetail->name; ?></p>
    </li>
   
<?php } ?> 

  </ul>
  
 
      
  </div> 
  
  <?php $y++;
  } ?>
  
  <?php if(sizeof($gallery) > 0){ ?>
  <div class="pagerSec">
        <ul class="tabs">
          <?php echo $paging; ?>
        </ul>
      </div>
  <?php } ?>  
  
  
</div>
</div>

<!-- -----------------  end gallery --------------------------- --> 