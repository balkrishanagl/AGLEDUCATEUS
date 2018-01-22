
<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">MCQ Exam Start</div>
    </li>
  </ul>
</div>


<section class="formsection">
		<div class="wrapper">
		<div class="form-outer">
		<?php 
			if(sizeof($question_data)>0){
		 ?>
		<span id="hm_timer"></span>
		
		<div id="myProgress">
		  <div id="myBar"></div>
		</div>
		<?php } ?>
		<form class="paymentForm" method="post" action="<?php echo base_url(); ?>student/play_quiz_start/">
		<div class="formTop">
		<div class="user-type">
		<div class="form-part" id="quiz_part">
		<div class="form-right" style="width:100%">
		<div class="form-row" id="quiz_div">
		
		<?php 
			if(sizeof($question_data)>0){
		 ?>
		   
			<div class="form-label"><p><span>Q:<?php echo $count+1;?></span> <?php echo $question_data[$count]->title;?></p></div>
			<div class="form-input">
            
            <ul>
            	<li>
                	<input type="radio"  name="choice" id="quiz1" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_1)){echo $question_data[$count]->choice_1;}?>"/><?php if(isset($question_data[$count]->choice_1)){ ?> <label for="quiz1"> <?php echo $question_data[$count]->choice_1;}?></label>
                </li>
                <li>
                	<input type="radio"  name="choice" id="quiz2" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_2)){ echo $question_data[$count]->choice_2;}?>"/><?php if(isset($question_data[$count]->choice_2)){ ?> <label for="quiz2"> <?php echo $question_data[$count]->choice_2;}?></label>
                </li>
                <li>
                	<input type="radio"  name="choice" id="quiz3" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_3)){echo $question_data[$count]->choice_3;}?>"/><?php if(isset($question_data[$count]->choice_3)){ ?> <label for="quiz3"> <?php echo $question_data[$count]->choice_3;}?></label>
                </li>
                <li>
                	<input type="radio"  name="choice" id="quiz4" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_4)){ echo $question_data[$count]->choice_4;}?>"/><?php if(isset($question_data[$count]->choice_4)){ ?> <label for="quiz4"> <?php echo $question_data[$count]->choice_4;}?></label>
                </li>
            </ul>
			<input type="button" class="btnQuiz" id="btnNextQuestion" onclick="playing_quiz()" value="Next">
            <input type="hidden" id="count" name="count" value="<?php if($resume_exam == 1){ echo $count+1; }else{ echo $count; }?>"/>
			<input type="hidden" id="quizid" name="quizid" value="<?php if(isset($question_data[$count]->quiz_id)){ echo $question_data[$count]->quiz_id; }?>"/>
			<input type="hidden" id="user_id" name="user_id" value="<?php if(isset($userID)){ echo $userID; }?>"/>
			<input type="hidden" id="quesid" name="quesid" value="<?php echo $question_data[$count]->id;?>"/>
			<input type="hidden" id="total_question" name="total_question" value="<?php echo count($question_data);?>"/>
			<input type="hidden" id="last_progress" name="last_progress" value=""/>
			
			
	        </div>
			<?php }else{ ?>
				<div>No Any Question found</div>
			<?php } ?>
			</div>
				
			</div>
		    </div></div>
			</div>
			</form>
			</div>
			</div>
		    </section>
<script>
var tsmin=0;

	
	 
var manage_duration = function(){
	 
	
	 var user_id = $('#user_id').val();
	 var quiz_id = $('#quizid').val();
	 
	
	 $.ajax({
	  url: '<?php echo base_url(); ?>student/updateExamDuration',
	  type: 'POST',
	  data: {'quizId' : quiz_id,'userId' : user_id},
	  success: function(data) {

		 if(data=='Done'){
			// alert("Test");
			$.ajax({
			url: '<?php echo base_url(); ?>student/updateResultStatus',
			type: 'POST',
			data: {'quizId' : quiz_id, 'userId' : user_id, 'status' : 'done'},
				  success: function(data) {
						window.location.href = "<?php echo base_url(); ?>student/quiz_result_page/"+quiz_id+'/'+user_id;
					  },
				  error: function(e) {
					//called when there is an error
					console.log(e.message);
				  }
				});
			
		  
		 }
		 },
	  error: function(e) {
		console.log(e.message);
	  }
	});
 	
};

var manage_second = function(){
	
	 var user_id = $('#user_id').val();
	 var quiz_id = $('#quizid').val();
	
	 $.ajax({
	  url: '<?php echo base_url(); ?>student/updateSecond',
	  type: 'POST',
	  data: {'quizId' : quiz_id,'userId' : user_id},
	  success: function(data) {

		 },
	  error: function(e) {
		console.log(e.message);
	  }
	});
}

setInterval(manage_duration, 1000 * 60 * 1);
setInterval(manage_second, 10000);


var currentQuestion = 0;
 
function playing_quiz(){
	var totalQuestions = $('#total_question').val();
	var $progressbar = $("#myBar");	
	var $last_progress = $("#last_progress");	
	var count = $('#count').val();
	
	if(count == 0){
		
		currentQuestion = count;
	}else{
		currentQuestion = count-1;
	}
	
	  if (currentQuestion >= totalQuestions){ return; }
	  
		currentQuestion++;
		
	 $("#last_progress").val(Math.round(100 * currentQuestion / totalQuestions));
	  
	  $progressbar.css("width", Math.round(100 * currentQuestion / totalQuestions) + "%");
	 
	 if($("input:radio[name='choice']").is(":checked")) { 
		var userChoice = $("input[name='choice']:checked").val();
	} else{
		alert('Please Choose Any Answer!');
		return false;
	}
	 
	
	
	 var quizId = $('#quizid').val();
	 
	 var userId = $('#user_id').val();
	 
	
	 
	 
	
	 var quesId = $('#quesid').val();
	 
	 if(count==0)
	 {
		count=1;
	 }

     $.ajax({
	  url: '<?php echo base_url(); ?>student/play_quiz_result/',
	  type: 'POST',
	  data: {'user_choice' : userChoice,'quizid' : quizId,'count':count,'quesid':quesId},
	  success: function(data) {
		//called when successful
		//alert(data);
		if(data!='done'){
		  $('#quiz_part').html(data);
		}else{
				
				 $.ajax({
				  url: '<?php echo base_url(); ?>student/updateResultStatus',
				  type: 'POST',
				  data: {'quizId' : quizId, 'userId' : userId, 'status' : 'done'},
				  success: function(data) {
						window.location.href = "<?php echo base_url(); ?>student/quiz_result_page/"+quizId+'/'+userId;
					  },
				  error: function(e) {
					//called when there is an error
					console.log(e.message);
				  }
				});
			
			
		}
		  },
	  error: function(e) {
		//called when there is an error
		console.log(e.message);
	  }
	});


	}
	
	var minute = <?php echo $exam_duration; ?>;	
	var second = 00;	
	//alert(minute);
	
	
 // });
</script>
	
<!-- Include Date Range Picker -->
