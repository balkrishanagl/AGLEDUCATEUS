<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Re Exam</div>
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
					
					</div>
					
					<div class="latest-news important-message">
						
						
						<h3>IMPORTANT !!</h3>
						<?php if($re_exam_payment_id==0){ ?>
							<p><a href="<?php echo base_url(); ?>student/re_exam_payment/">Please Click here to enter the cheque/DD Details</a></p>
							
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
						<?php if($re_exam_payment_id!=0 and $re_exam_payment_status==0){ ?>
							<p style="color:red;">Your payment verification is pending from admin.</p>
						<?php } ?>
						<?php if($re_exam_payment_id!=0 and $re_exam_payment_status==1){ ?>
							<p style="color:green;">Your payment is verified by admin.</p>
						<?php } ?>	

						<?php if($this->session->userdata('quiz_message')){ ?>
							<div class="quiz-succe"><?php echo $this->session->userdata('quiz_message'); $this->session->unset_userdata('quiz_message'); ?></div>
						<?php } ?>
						
						<?php if($re_exam_payment_id!=0 and $re_exam_payment_status==1){ ?>
                        <p><a href="<?php echo base_url(); ?>student/play_quiz/">Please Click Here To Start Exam</a></p>
							
							<?php } ?>
<!-- Download admit card -->
						
	
		</section>