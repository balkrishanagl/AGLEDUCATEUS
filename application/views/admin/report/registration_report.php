<!-- DATA TABLES -->

<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />



<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

           Registration

            <!--<small><a href="<?php echo base_url();?>admin/payment/add_payment">Add Payment</a></small>-->

        </h1>



        <ol class="breadcrumb">

            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Registration List</li>

        </ol>

    </section>

     <!-- Main content -->

<section class="content">



    <div class="row">

        <div class="col-xs-12">

            <div class="box">

                <div class="box-header">

                    <h3 class="box-title">Registration List</h3>

			    </div><!-- /.box-header -->

					<form id ="filter_registration" method="post" role="form" id="exportdata" action="#" accept-charset="utf-8">



						<table border='0' width='100%'>

							<tr>

								<td colspan='4'><p>Filter By:</p></td>

							</tr>

							<tr>

							<td>

							<div class="form-group">

							<label>Source</label>



								<select name="source" id="source" class="form-control">

								<option value="">Select</option>

								<?php foreach($source_type_list as $source){ ?>

									<option <?php if(isset($_POST['source']) and $_POST['source']==$source->id){ echo "selected='selected'"; } ?> value="<?php echo $source->id; ?>"><?php echo $source->name; ?></option>

								<?php } ?>

								</select>

							</div>

							</td>



							<td>

							<div class="form-group">

								<label>Session</label>



								<select name="session" id="session" class="form-control">

								<option value="">Select</option>

								<?php foreach($session_data as $sessionData){ ?>

									<option <?php if(isset($_POST['session']) and $_POST['session']==$sessionData->id){ echo "selected='selected'"; } ?> value="<?php echo $sessionData->id; ?>"><?php echo $sessionData->name; ?></option>

								<?php } ?>



								</select>

								</div>

							</td>


								<td>
									<div class="form-group">
										<label>User Type</label>

										<select name="appl_category" id="appl_category" class="form-control">
											<option value="">Select</option>
											<?php foreach ($user_type as $userType) { ?>
												<option <?php if (isset($_POST['appl_category']) and $_POST['appl_category'] == $userType->user_type_id) {
													echo "selected='selected'";
												} ?>
													value="<?php echo $userType->user_type_id; ?>"><?php echo $userType->user_type_name; ?></option>
											<?php } ?>

										</select>
									</div>
								</td>
							<td>

								<div class="form-group">

								<label>From</label>

								<input type="text"  id="reg_from" value="<?php echo $this->session->userdata('from'); ?>" name="reg_from" class="form-control" />

								</div>

							</td>



							<td>

								<div class="form-group">

								<label>To</label>

								<input type="text"  id="reg_to" value="<?php echo $this->session->userdata('to'); ?>" name="reg_to" class="form-control" />

								</div>

							</td>





							</tr>



							<tr>

							<td>

							<input type="button" class="btn-info" id="btnReport" value="Search"/>

							<input type="button" class="btn-primary" id="btnExport" value="Export"/>

							<input type="button" class="btn-info" id="btnClear" value="Clear"/>

							</td>

							</tr>



						</table>





					</form>



                <div class="box-body table-responsive">

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>Sr No</th>

                                <th>Session</th>
								<th>User Type</th>

                                <th>Registration Date</th>

								<th>Name</th>

								<th>Father Name</th>

								<th>Gender</th>

								<th>Source</th>

								<th>Registration on</th>

								<th>DOB</th>

                                <th>Email</th>

								<th>Permanent Address</th>

								<th>Mobile</th>

								<th>Nationality</th>

								<th>Qualification</th>

								<th>Organization</th>

								<th>Designation</th>

								<th>Course</th>

								<th>Course Year</th>







                            </tr>

                        </thead>

                        <tbody class="dtRegister">

                            <?php



								if(isset($user_list) && $user_list != NULL) {?>

                                <?php $i=0; foreach($user_list as $user) { $i++;?>

                                    <tr>

                                        <td><?php echo $i;?></td>

                                        <td><?php echo $user->session;?></td>
										<td><?php echo $user->user_type_name;?></td>

                                        <td><?php echo date("d/m/Y", strtotime($user->created));?></td>

										<td><?php echo $user->first_name;?></td>

										<td><?php echo $user->father_name;?></td>

										<td><?php echo $user->gender;?></td>

										<td><?php echo $user->source;?></td>

										<td><?php echo $user->created;?></td>

										<td><?php echo $user->dob;?></td>

										<td><?php echo $user->email;?></td>

										<td><?php echo $user->permanent_address;?></td>

										<td><?php echo $user->mobile_number;?></td>

									    <td><?php echo $user->nationality;?></td>

								        <td><?php echo $user->qualification;?></td>

										<td><?php echo $user->organization;?></td>

										<td><?php echo $user->designation;?></td>

										<td><?php echo $user->about_course;?></td>

	                                    <td><?php echo $user->course_year;?></td>







                                    </tr>

                                <?php }?>

                            <?php }?>



                        </tbody>



                    </table>

                </div><!-- /.box-body -->

            </div><!-- /.box -->

        </div>

    </div>



</section><!-- /.content -->



</aside>



<!-- DATA TABES SCRIPT -->

<script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>



<script type="text/javascript">



	$(document).ready(function(){





		 $("#reg_from").datepicker({

			autoclose: true,

			format: 'yyyy-mm-dd',

			}).on('changeDate', function (selected) {



			});







			$("#reg_to").datepicker({

				autoclose: true,

				format: 'yyyy-mm-dd',

			}).on('changeDate', function (selected) {



				});

			})



function delete_payment(id){

	var r = confirm('are you sure to delete payment?');

	if(r==true){

		window.location.href = "<?php echo base_url(); ?>admin/payment/delete_payment/"+id;

	}

}



function change_status(user_id,id, status){

	var r = confirm('are you sure to change payment status?');

	if(r==true){

		window.location.href = "<?php echo base_url(); ?>admin/payment/update_status/"+user_id+"/"+id+"/"+status;

	}

}

    $(function() {

        $("#example1").dataTable();

        $('#example2').dataTable({

            "bPaginate": true,

            "bLengthChange": false,

            "bFilter": false,

            "bSort": true,

            "bInfo": true,

            "bAutoWidth": false

        });

    });



	$(function(){

	$('#btnReport').click(function(){



	var fromDate = $('#reg_from').val();

	var toDate = $('#reg_to').val();

	var source = $('#source').val();

	var session = $('#session').val();
		var appl_category = $('#appl_category').val();



	$.ajax({

            url: "<?php echo base_url(); ?>admin/report/registration_report",

            type: "POST",

            data: {fromdt:fromDate, todt:toDate, SourceId:source, userType: appl_category, sessionId:session} ,

			dataType: 'json',

			 success: function(dataJson) {

				// alert(dataJson);

				$('#example1').dataTable().fnClearTable();



				for(var i = 0; i < dataJson.length; i++) {



					$('#example1').dataTable().fnAddData([ dataJson[i]]);

				}



                }

        });

	});



	$('#btnExport').click(function(){







		//alert(paymentType);

			window.location.href='<?php echo base_url();?>admin/report/download_registration_csv/';



                    return false;



	});



	$('#btnClear').click(function(){

		$('#filter_registration')[0].reset();

	});







});

</script>