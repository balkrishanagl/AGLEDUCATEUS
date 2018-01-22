<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enrolment Number <?php echo $site_name; ?>!</title>
</head>

<body style="padding:0; margin:0;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #f5821f; padding:0 15px;">

  <tr>
    <td align="left"><a href="<?php echo base_url(); ?>" target="_blank"><img src="<?php echo base_url().$this->config->item('email_logo'); ?>" alt="FICCI Logo" style="display:block; border:0;" /></a></td>
  </tr>
   
  <tr>
  <td>
  <h4 style="font:bold 20px Arial, Helvetica, sans-serif; color:#000; text-align:center">Enrolment Number <?php echo $site_name; ?></h4>
  </td>
  </tr>
  
  <tr>
    <td align="left" style="font:normal 13px Arial, Helvetica, sans-serif; color:#000;"><p>Dear <?php echo trim($name);?>, <br />
      <br />
We are pleased to confirm receipt of <?php echo $payment_type; ?> No. <?php echo $referenceno;  ?>, of amount Rs.<?php echo $courseFee;  ?>, towards the Course fees for the <b>FICCI Online Certificate Course on <?php echo $site_name; ?>, Session- <?php echo $sessionStartMonth; ?> to <?php echo $sessionEndMonth; ?> <?php echo $sessionYear; ?> . </b><br />
<br />
Your account has been activated and your enrolment number is <b><?php echo $ennrollment_number; ?></b><br />
<br />
Kindly note that Online Access for the course will be available only from the date on which the course is commencing. <br />
<br />
Should you require any clarification or further information, please feel free to contact the undersigned.</strong>.<br /><br />




With best regards,<br />
<strong>Course Coordinator</strong><br />
 FICCI-IP Education Centre (IPEC)<br/>
<strong>Federation of Indian Chambers of Commerce and Industry</strong> <br />
</p></td>
  </tr>

  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2" style="font:normal 14px Arial, Helvetica, sans-serif; color:#000;">
          FICCI | Industry's Voice For Policy Change<br />
  
Contact No: 18003136160 (Toll free ) +91-11- 23487477 <br />
E: <a href="mailto:ipcourse@ficci.com" target="_blank" style="outline:none; color:#000;">ipcourse@ficci.com</a>  | <a href="www.ficciipcourse.in" target="_blank" style="outline:none; color:#000;">W: www.ficciipcourse.in</a> <br />

          </td>
          
        </tr>
      </table></td>
  </tr>
  
</table>
</body>
</html>