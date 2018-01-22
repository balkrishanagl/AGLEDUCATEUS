<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Payment</div>
    </li>
  </ul>
</div>

<section class="about_sec registration title_bdr">
<div class="wrapper">
<div class="regis_form_box">
<?php if(validation_errors()){?>
<div class="reg validate-error"><?php echo validation_errors(); ?></div>
<?php } ?>
<div class="reg paylist">

        <form id="frmPayment" name="frmPayment" method="POST" action="<?php echo base_url(); ?>student/make_payment/" data-toggle="validator" role="form">
          <ul>
          
          <script type="text/javascript">
		   function change_chk(){
			  var val = $("#payment_type").val();
			  if(val=="DD"){
				  $("#chq_lbl").html('DD Number <sup>*</sup>');
				  $("#chequenumber").attr("placeholder","DD Number");
				  $("#chequenumber").attr("data-error","Please Enter DD Number");
				  $("#date_lbl").html('DD Date <sup>*</sup>');
				  $("#chequedate").attr("placeholder","DD Date");
			  } else if(val=="NEFT"){
				  $("#chq_lbl").html('Acknowledgement Number <sup>*</sup>');
				  $("#chequenumber").attr("placeholder","Acknowledgement Number");
				  $("#chequenumber").attr("data-error","Please Enter Acknowledgement Number");
				  $("#date_lbl").html('Acknowledgement Date <sup>*</sup>');
				  $("#chequedate").attr("placeholder","Acknowledgement Date");
			  } else if(val=="RTGS"){
				  $("#chq_lbl").html('Acknowledgement Number <sup>*</sup>');
				  $("#chequenumber").attr("placeholder","Acknowledgement Number");
				  $("#chequenumber").attr("data-error","Please Enter Acknowledgement Number");
				  $("#date_lbl").html('Acknowledgement Date <sup>*</sup>');
				  $("#chequedate").attr("placeholder","Acknowledgement Date");
			  } else if(val=="CHEQUE"){
				  $("#chq_lbl").html('CHEQUE Number <sup>*</sup>');
				  $("#chequenumber").attr("placeholder","CHEQUE Number");
				  $("#chequenumber").attr("data-error","Please Enter Cheque Number");
				  
				  $("#date_lbl").html('CHEQUE Date <sup>*</sup>');
				  $("#chequedate").attr("placeholder","CHEQUE Date");
			  }
		  }
		 
		  </script>
             <li>
				  <label>Payment Type <sup>*</sup></label>
                   <div class="form-group">
				  <select id="payment_type" name="payment_type"  data-error="Please Slect Payment Type" required onchange="change_chk();">
					<option value="">Select Payment Type</option>
						<?php foreach($payment_type as $payType){ ?>
						<option <?php if(set_value('payment_type')==$payType->payment_type){ ?> selected <?php } ?> value="<?php echo $payType->payment_type; ?>"><?php echo $payType->payment_type; ?></option>
						<?php } ?>
					</select>
					<div class="help-block with-errors"></div>
              </div>
              </li>
			 <li>
				  <label id="chq_lbl">DD Number<sup>*</sup></label>
				  <div class="form-group">
				  <input name="chequenumber" id="chequenumber" value="<?php echo set_value('chequenumber'); ?>" placeholder="DD Number"  data-error="Please Enter Cheque Number" required type="text">
				  <div class="help-block with-errors"></div>
				  </div>
			</li> 
			
			 <li>
				  <label id="date_lbl">DD Date <sup>*</sup></label>
				  <div class="form-group">
				  <input type="text" id="chequedate" name="chequedate" value="<?php echo set_value('chequedate'); ?>" data-error="Please Enter Date" placeholder="DD Date" readonly required />
				  <div class="help-block with-errors"></div>
				  </div>
			</li> 
			 <li>
				  <label>Course Fees <sup>*</sup></label>
				  <div class="form-group">
				  <input id="coursefees" name="coursefees1" value="<?php echo $fee; ?>" placeholder="500" required readonly disabled type="text">
				  <input type="hidden" value="<?php echo $fee; ?>" name="coursefees"/>
				  <div class="help-block with-errors"></div>
				  </div>
			</li> 
			
			<li>
				  <label>Bank Name <sup>*</sup></label>
				  <div class="form-group">
				  <input id="bankname" name="bankname" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Bank Name" value="<?php echo set_value('bankname'); ?>" data-error="Please Enter Bank Name" placeholder="Bank Name" required type="text">
				  <div class="help-block with-errors"></div>
				  </div>
			</li> 
			
			<li>
				  <label>Branch Name <sup>*</sup></label>
				  <div class="form-group">
				  <input id="branchname" name="branchname" value="<?php echo set_value('branchname'); ?>" placeholder="Branch Name" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Branch Name" data-error="Please Enter Branch Name" required type="text">
				  <div class="help-block with-errors"></div>
				  </div>
			</li> 
			 <li>
			 <div class="form-group">
			 <input type="submit" class="paybtn" id="btnSavePayment" value="Save"></li>
			 </div>
		</ul>
	    </form>

		
		</div>
</div>
</div>
</section>