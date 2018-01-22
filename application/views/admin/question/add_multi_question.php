
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Multiple Questions
            <small>Add Multiple Question</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/question/manage_question"><i class="fa fa-dashboard"></i> Question</a></li>
            <li class="active">Add Multiple Question</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
		<div>
			<?php if(validation_errors()){?>
			
			<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
				</div>
			<?php } ?>
			
			
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php }else if($this->session->flashdata('error')){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php }else if($this->session->flashdata('warning')){  ?>
				<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
				</div>
			<?php }else if($this->session->flashdata('info')){  ?>
				<div class="alert alert-info">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
				</div>
			<?php } ?>
		</div>
                <form id="add_user_form" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/question/add_multipal_question/">
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Exam</label></label>
                            <div class="col-md-5">
							
                                <select name="quiz_id" id="quiz_id" class="form-control input-sm br0" required>
									<option value=''>select Exam</option>
									<?php foreach($quiz_list as $quiz){ ?>
										<option value="<?php echo $quiz->id; ?>" <?php if(isset($_POST['quiz_id']) and $_POST['quiz_id']==$quiz->id){ echo "selected='selected'"; } ?>><?php echo $quiz->name; ?></option>
									<?php } ?>
								</select>
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   
					   <div id="csvbox">
						   <div class="form-group">
								<label for="cal_event_datetime" class="col-md-4 control-label"><label for="correct_choice">CSV</label></label>
								<div class="col-md-5">
									<input type="file" name="questions_csv"  accept=".csv" class="form-control input-sm br0 csv" id="questions" required>
									<a href="<?php echo base_url().'uploads/ficci_question.csv'; ?>" target="_blank">Sample CSV</a>
									<span class="form_er_msg" id="error_title"></span>
								</div>
						   </div>
					   </div>
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-5">
							
                                <select name="status" class="form-control input-sm br0" id="status" required>
									<option value=''>select status</option>
									<option value='1' <?php if(isset($_POST['status']) and $_POST['status']==1){ echo "selected='selected'"; } ?>>Active</option>
									<option value='0' <?php if(isset($_POST['status']) and $_POST['status']==0){ echo "selected='selected'"; } ?>>Inactive</option>
								</select>
                                <span class="form_er_msg" id="error_status"></span>
                            </div>
                       </div>
					   
					   
					   
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add Question" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script type="text/javascript">

$(document).ready(function(){

	//$("div").remove(".iradio_minimal"); 
	//$("ins").remove();
	var isProcessing = false;  
	 
     
});


function questiontype(questype)
{

	if(questype=='question')
    {
        $('#csvbox').hide();
        $('#questionb').show();
        //$('#sms_temp_list').val();
		$(".csv").removeAttr("required","required");
       // $("#sms_temp_list option[value='X']").remove();
    }
    if(questype=='question_csv')
    {
         $('#csvbox').show();
        $('#questionb').hide();
		$(".csv").attr("required","required");
    }
}

</script>