<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Dashboard</div>
    </li>
  </ul>
</div>
<?php
/*$session_data = $this->session->userdata;
echo "<pre>";
print_r($session_data);
echo "</pre>"; die;*/
?>

					
<section class="main login-wrapper">
			<div class="wrapper">
				
				<div class="inner-bottom">					
					<div class="message">
						<div class="message-image">
							<?php if($stuData->user_image_file!='NULL' && $stuData->user_image_file!=''){ ?>
								<img src="<?php echo base_url(); ?>uploads/user_image/<?php echo $stuData->user_image_file; ?>" alt="">							
							<?php }else{ ?>
								<img src="<?php echo base_url(); ?>assets/site/images/principle.png" alt="">							
							<?php } ?>
						</div>
						<h5><?php echo $user_name; ?></h5>
					</div>
					
					<div class="latest-news important-message">
						
						
						<h3>IMPORTANT !!</h3>
						<?php if($payment_id==0){ ?>
							<p><a href="<?php echo base_url(); ?>student/make_payment/">Please Click here to enter the cheque/DD Details</a></p>
							
							<!--<form name="payment" method="post" action="http://payment.ficci.com/ipr-new/ipr.asp">
                        
							<input type="hidden" name="sSessionID" value="IPRCOURSE<?php //echo $stuData->id; ?>">
							<input type="hidden" name="amount" value="<?php //echo $stuData->course_fee; ?>">
							<input type="hidden" name="Phone" value="<?php //echo $stuData->mobile_number; ?>">
							<input type="hidden" name="Email" value="<?php //echo $stuData->email; ?>">
							<input type="hidden" name="Organisation" value="FICCI">
							<input type="hidden" name="Address" value="<?php //echo $stuData->permanent_address; ?>">
							<input type="hidden" name="City" value="Jaipur <?php //echo $stuData->city; ?>">
							<input class="makepayment" type="submit" value="Pay Using Internet Banking" />
							</form>-->
							<p><a>Online Payment will soon be available</a></p>
						<?php } ?>
						<?php if($payment_id!=0 and $payment_status==0){ ?>
							<p style="color:red;">Your payment verification is pending from admin.</p>
						<?php } ?>
						<?php if($payment_id!=0 and $payment_status==1){ ?>
							<p style="color:green;">Your payment is verified by admin.</p>
						<?php } ?>	

						<?php if($this->session->userdata('quiz_message')){ ?>
							<div class="quiz-succe"><?php echo $this->session->userdata('quiz_message'); $this->session->unset_userdata('quiz_message'); ?></div>
						<?php } ?>
						
						<?php if($payment_id!=0 and $payment_status==1){ ?>
                        <ul>
                        	<li><a href="<?php echo base_url(); ?>forum/index/" class="more">Forum</a></li>
                            <li><a href="<?php echo base_url(); ?>student/assignments/" class="more">Assignments</a></li>
                            <li><a href="<?php echo base_url(); ?>student/play_quiz/">MCQ Exam</a></li>
                            <li><a href="<?php echo base_url(); ?>student/study_material/">Study Material</a></li>
                            <li><a href="<?php echo base_url(); ?>user-profile/<?php echo $user_id;?>">User Profile</a></li>
							<li><a href="<?php echo base_url(); ?>change-password/">Change Password</a></li>
							<li><a href="<?php echo base_url(); ?>news-events/">News and Events</a></li>
							
							<?php if(isset($pending_quiz) && !empty($pending_quiz)){ ?>
                            <li><a href="<?php echo base_url(); ?>student/resume_exam/<?php echo $pending_quiz[0]->quiz_id; ?>">Resume Exam</a></li>
							<?php } ?>
							
							<?php if(isset($re_exam) && !empty($re_exam)){ ?>
							<li><a href="<?php echo base_url(); ?>student/re_exam/">Re Exam</a></li>
							<?php } ?>
                        </ul>
							
							<?php } ?>
<!-- Download admit card -->
						
					</div>
					<?php if(sizeof($announcement) > 0 ){ ?>
	<div class="announcemen"><marquee>
	<?php 
		$i = 1;
		foreach($announcement as $announcements){ 
		if($i == count($announcement)){
			echo $announcements->title;
		}else{
			echo $announcements->title.'&nbsp; | &nbsp;';
		}
		$i++;
	 } ?> 
	</marquee></div>		<?php } ?>		
			</div>
		</section>