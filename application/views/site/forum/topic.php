<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Forum</div>
    </li>
  </ul>
</div>
<?php
/*$session_data = $this->session->userdata;
echo "<pre>";
print_r($session_data);
echo "</pre>"; die;*/
?>
<style>
.error{
	float:left !important;
}
</style>
<section class="main">
			<div class="wrapper">
				<div class="assignment-outer">
						<div>
			<?php echo validation_errors(); ?>
			<?php if($this->session->flashdata('success')){ ?>
				<div class="succe"><?php echo $this->session->flashdata('success'); ?></div>
			<?php } ?>
			
			
			
		</div>
				<?php //echo "<pre>"; print_r($topic); echo "<pre>"; ?>
				
				
					
					<h3>Ask your query.<?php //echo $topic->title; ?></h3>
					<form method="post" action="<?php echo base_url(); ?>forum/add_comment/">
						<div class="form-box">
							<textarea name="comment_body" placeholder="Please Enter Your Comment" required></textarea>
						</div>
						<input type="hidden" name="topic_id" value="<?php //echo $topic->id; ?>">
						<input type="submit" class="add-comment-btn" value="Submit">
					</form>
					<div class="comments">
					<?php if(count($all_comment)>0){
						foreach($all_comment as $comment){ //echo "<pre>"; print_r($comment); die; ?>
						<div class="comment">
							<h4><?php echo $comment['username']; ?></h4>
							<p><?php echo $comment['body']; ?></p>
							<p><?php echo date("M d,Y",strtotime($comment['created'])); ?></p>
						</div>
						<?php if($comment['reply_body']){
							
							$replyerData = $this->user_model->get_user_data_by_id($comment['reply_user_id']);
							//echo '<pre>'; print_r($replyerData); die;;
						?>
						<div class="comment" style="margin-left:50px;">
							<h4><?php echo $replyerData->username; ?></h4>
							<p><?php echo $comment['reply_body']; ?></p>
							<p><?php echo date("M d,Y",strtotime($comment['reply_created'])); ?></p>
						</div>
						<?php } ?>
						
					<?php }
					}	else { ?>
						<h2>No comment yet!</h2>
					<?php } ?>
					</ul>
				
				
						</div>
					</div>
		</section>
		
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/bootstrap-datepicker3.css"/>
<script>
	$(document).ready(function(){
		var date = new Date();
		date.setDate(date.getDate());
		
		var date_input=$('input[name="chequedate"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			//startDate: date,
		})
	})
</script>