<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="tags inner_tags"> <span class="tag1">Educatus Scholarship</span> </div>
      </li>
    </ul>
  </div>
 
</section>

<!-- ------------- end banner ------------------------- --> 

<!-- ---------- start scolarship ----------------------- -->

<section class="scolar">
  <div class="girl"><img src="<?php echo base_url().$page_data->page_image; ?>" alt=""></div>
  <div class="right_scolar">
	<?php echo $page_data->page_content; ?>
</section>

<!-- ------------end scolarship ------------------------ --> 

<!-- ------------Stat how to apply ------------------------- -->

<section class="apply">
  <h3>How to Apply?</h3>
  <ul>
    <li>
      <div class="number">1</div>
     <?php if(isset($page_data->apply_stap1)){ echo $page_data->apply_stap1; } ?>
    </li>
    <li>
      <div class="number">2</div>
      <?php if(isset($page_data->apply_stap2)){ echo $page_data->apply_stap2; } ?>
    </li>
    <li>
      <div class="number">3</div>
      <?php if(isset($page_data->apply_stap3)){ echo $page_data->apply_stap3; } ?>
    </li>
  </ul>
</section>

<!-- ------------end how to apply ------------------------- --> 

<!-- ------------start eligibilty ------------------------ -->

<section class="eligibilty">
  <div class="eligilibty_box">
    <h1>Eligibility Criteria:</h1>
    <p class="tag_line">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu blandit lorem, vitae congue dolor. </p>
    <ul>
	
	 <?php $eligibility_criteria = json_decode($page_data->eligibility_criteria, true);
			if(isset($eligibility_criteria)){
				foreach($eligibility_criteria as $ec) { 
					foreach($ec as $value){?> 
      <li><?php echo $value; ?>.</li>
			<?php }
			}
			}?>
    </ul>
  </div>
</section>

<!-- ---------- end eligibilty ---------------------- --> 