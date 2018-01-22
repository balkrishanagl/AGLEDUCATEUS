<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">MCQ Exam</div>
    </li>
  </ul>
</div>
<section class="about_sec registration title_bdr">
<div class="wrapper">
<div class="regis_form_box">

<div class="reg">
	<?php if(!empty($quiz_data)){ ?>
        <form id="frmQuiz" name="frmQuiz" method="POST" action="<?php echo base_url(); ?>student/play_quiz_start/" data-toggle="validator" role="form">
          <ul>
          
             <li>
				  <label>MCQ Exam</label>
				  <select name="quiz_name" id="quiz_name" required> 
					<?php $currDate = date("Y-m-d");
						foreach($quiz_data as $quiz)
						{ 
							
						?>
						<option value="<?php echo $quiz->id;?>"><?php echo $quiz->name;?></option>
					<?php
						}?>
					</select>
              
              </li>
			 
			 <li><label>&nbsp;</label> <input type="submit" id="btnSavePayment" value="Start"></li>
		</ul>
	    </form>
	<?php }else{
			echo "No Any Exam Found";
	}		?>
</div>

</div>
</div>
</section>