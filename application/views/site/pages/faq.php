<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">FAQ</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<div class="four_section faq_two_sect">
  <ul>
    <li>
      <div class="icons"><img src="<?php echo base_url()?>assets/site/images/contact_support.png" alt=""></div>
      <h3>Contact Support</h3>
      <p>For any information about our locations, doctors or services, please feel <a href="<?php echo base_url().'contact-us'?>"><strong>free to write</strong></a> or fill out this convenient <a href="<?php echo base_url().'contact-us'?>"><strong>form</strong></a>.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url()?>assets/site/images/feedback.png" alt=""></div>
      <h3>Feedback</h3>
      <p> Feedback We'd love to hear from you on how we can improve ourselves to serve you better. <a href="<?php echo base_url().'feedback'?>"><strong>Write to us</strong></a> or fill out this <a href="<?php echo base_url().'feedback'?>"><strong>form</strong></a> here.</p>
    </li>

  </ul>
</div>

<!-- --------------- start faq ------------------ -->

<section class="faq">

<div class="layout">

  <?php echo $page_data->page_content; ?>
  
  <div class="accordain_box">
  
  <?php $i =0; 
		if(sizeof($faq_data)>0){
		foreach($faq_data as $faq){ ?>
    <h4 class="active"><span class="q"><?php echo $faq->title;?></span> <span class="plus"></span></h4>
    <div class="data" <?php if($i==0){ echo 'style="display:block;"'; }?>>
      <?php echo $faq->description;?>
    </div>
  <?php $i++;
  } 
  }?>
  </div>
  
  </div>
</section>

<!-- ---------------end faq -------------------- --> 
