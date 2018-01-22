<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="tags inner_tags"> <span class="tag1"><?php echo $page_data->page_title;?></span> </div>
      </li>
    </ul>
  </div>
 
</section>

<!-- ------------- end banner ------------------------- --> 

<!-- ------------ start your dream ------------------- -->

<div class="layout">
  <section class="your_dream">
    <?php echo $page_data->page_content; ?>
    <div class="process">
      <ul>
        <li>
          <div class="above_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc1.png" alt=""></span></p>
            <p class="process_name">Register on<br/>
              website</p>
          </div>
          <div class="down_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc1.png" alt=""></span></p>
            <p class="process_name">Register on<br/>
              website</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <a href="#" class="btn2">Enquiry Now</a> </div>
        </li>
        <li>
          <div class="above_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc2.png" alt=""></span></p>
            <p class="process_name">Eligibility<br/>
              Assessment</p>
          </div>
          <div class="down_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc2.png" alt=""></span></p>
            <p class="process_name">Eligibility<br/>
              Assessment</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <a href="#" class="btn2">Enquiry Now</a> </div>
        </li>
        <li>
          <div class="above_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc3.png" alt=""></span></p>
            <p class="process_name">ATTEND <br/>
              EXPO</p>
          </div>
          <div class="down_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc3.png" alt=""></span></p>
            <p class="process_name">ATTEND EXPO</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <a href="#" class="btn2">Enquiry Now</a> </div>
        </li>
        <li>
          <div class="above_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc4.png" alt=""></span></p>
            <p class="process_name">Head one  to one<br/>
              with counselor </p>
          </div>
          <div class="down_box">
            <p class="proc"><span class="bdr"><img src="<?php echo base_url()?>assets/site/images/proc4.png" alt=""></span></p>
            <p class="process_name">Head one  to one <br/>
              with counselor </p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <a href="#" class="btn2">Enquiry Now</a> </div>
        </li>
      </ul>
    </div>
  </section>
</div>

<!-- ----------- end your dream --------------------- --> 

<!-- --------------- start university ----------- -->

<div class="Counslaer">
  <h3>Meet Our Amazing Counselor</h3>
  <p class="tag_line">WE ARE ALWAYS WORKING HARD TO BUILD THE REAL VALUES</p>
  <div class="layout">
    <div class="counslar_box">
      <ul class="owl-carousel counslares">
		<?php if(sizeof($counseller_data)){
				foreach($counseller_data as $counseller){?>
        <li>
          <div class="photo"><img src="<?php echo base_url().$counseller->image; ?>" alt="<?php echo $counseller->title; ?>"></div>
          <div class="details">
            <p class="name"><?php echo $counseller->title; ?></p>
            <p class="desgi"><?php echo $counseller->designation; ?></p>
            <p class="data"><?php if(strlen($counseller->description)>200){
				$counseller_pos = strpos($counseller->description, ' ', 200);
				$counseller_cnt = substr($counseller->description,0,$counseller_pos );
				echo strip_tags($counseller_cnt).'...';
			}else{
					echo strip_tags($counseller->description);
			} ?></p>
            <a href="#co_<?php echo $counseller->id; ?>"  class="team btn2">Read More</a>
            <div id="co_<?php echo $counseller->id; ?>" class="poup" style=" display:none; width:1000px;">
              <div class="left_imgage"> <img src="<?php echo base_url().$counseller->image; ?>" alt="<?php echo $counseller->title; ?>"> </div>
              <div class="right_text">
                <p class="names"><?php echo $counseller->title; ?></p>
                <p class="desgin"><?php echo $counseller->designation; ?></p>
                <p class="team_det"><?php echo $counseller->description; ?></strong></p>
				<?php if(isset($counseller->website) && $counseller->website!=""){ ?><p><strong>Website:  <?php echo $counseller->website; ?></strong></p><?php } ?>
                <?php if(isset($counseller->phone) && $counseller->phone!=""){ ?><p><strong>Phone: <?php echo $counseller->phone;  ?></strong></p>  <?php } ?>
                <?php if(isset($counseller->skills) && $counseller->skills!=""){ ?><p><strong>Skills: <?php echo $counseller->skills; ?></strong></p><?php } ?>
              </div>
            </div>
          </div>
        </li>
		<?php } 
		}?>
     
      </ul>
      <div class="slide_arrow_box"> <a class="btn prev prev4" id=""></a> <a class="btn next next4" id=""></a></div>
    </div>
  </div>
</div>

<!-- --------------- end university ----------- --> 