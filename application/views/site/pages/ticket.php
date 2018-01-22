<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<title>Registration</title>-->

</head>
<body>
<div style="width:800px; margin:auto;">
<div class="pdffile" style="width:800px;float:left; font-family:Arial, Helvetica, sans-serif; color:#333; border: 5px solid; padding: 0px;">
<div class="innerpdf" style="float:left; width:100%;">

<header style="background:#eeeeee; float:left; width:100%; text-align:center; padding:20px 0;">
<div class="logo"><img src="<?php echo base_url();?>assets/site/images/pdf/logo.png" alt="" ></div>

<div class="timing" style="color:#0887ca; font-size:25px; font-weight:bold; border-bottom:1px solid #0887ca; border-top:1px solid #0887ca; padding:5px 0; margin-top:20px; display:inline-block;">Timing: <?php echo $start_time; ?> to <?php echo $end_time; ?></div>

</header>

<h1 style="text-align:center; font-size:32px; padding:10px 5%; float:left; width:90%;"><?php echo $start_date;?><?php if(isset($end_date) && $end_date !="" ){ ?> & <?php echo $end_date; } ?> <?php echo $event_month_year;?>
 <?php if(isset($location) && $location !=""){ echo $location; } ?>, <?php echo $city; ?> </h1>

<div class="details" style="float:left; width:100%; margin:10px 5%; text-align:left; font-size:32px; font-weight:bold;">

<p class="name">Name - <span class="name_space" style="display:inline-block; border-bottom:1px dashed #000; min-width:55%;"> <?php echo $name; ?></span> </p>
<p class="name">Registration no - <span class="name_space" style="display:inline-block; border-bottom:1px dashed #000; min-width:55%;"><?php echo $voucher; ?></span> </p>


</div>


<div class="ss" style="padding:20px 0; text-align:center;"><img  src="<?php echo base_url();?>assets/site/images/pdf/ss.png" alt="" style="width:100%"> </div>

<footer><img src="<?php echo base_url();?>assets/site/images/pdf/footer.png" alt="" style="width:800px; max-height:300px;"></footer>

</div>
</div>
<div>


</body>
</html>
