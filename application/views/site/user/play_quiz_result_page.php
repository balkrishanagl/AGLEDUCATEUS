<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">MCQ Exam</div>
    </li>
  </ul>
</div>
	
</section>
<section class="formsection">
			<div class="wrapper">
				<div class="form-outer quiz_result">
				
				<h1>Result</h1>
				<ul>
                	<li><span>MCQ Exam -</span> <?php echo $about_quiz[0]->name;?></li>
                    <li><span>Your Result -</span> <?php if(isset($rightans)){echo count($rightans)."/".count($choice1);}else{ echo 'Failed'; }?></li>
                    <li><span>Right Answer -</span> <?php if(isset($rightans)){echo count($rightans);}else{ echo '0'; }?></li>
                    <li><span>Wrong Answer -</span> <?php if(isset($wrongans)){echo count($wrongans);}else{ echo '0'; }?></li>
                    <li><span>Grade -</span> <?php if(isset($grade)){echo $grade;}else{ echo ''; }?></li>
                </ul>
				</div>
			</div>
		</section>
		
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/bootstrap-datepicker3.css"/>
