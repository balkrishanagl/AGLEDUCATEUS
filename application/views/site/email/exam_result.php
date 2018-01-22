<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_name; ?> Online Examination  Result Announcement!</title>
</head>

<body style="padding:0; margin:0;">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #f5821f; padding:0 15px;">
  
  <tr>
    <td align="left"><a href="<?php echo base_url(); ?>" target="_blank"><img src="<?php echo base_url().$this->config->item('email_logo'); ?>" alt="FICCI Logo" style="display:block; border:0;" /></a></td>
  </tr>
  
  <tr>
  <td>
  <h4 style="font:bold 20px Arial, Helvetica, sans-serif; color:#000; text-align:center">Welcome to <?php echo $site_name; ?>!</h4>
  </td>
  </tr>
  
  <tr>
    <td align="left" style="font:normal 13px Arial, Helvetica, sans-serif; color:#000;"><p>Dear <?php echo trim($name); ?>, <br />
      <br />
Greetings from Federation of Indian Chambers of Commerce & Industry (FICCI)! </b><br />
<br />
<strong>Please find below your Examination Result</strong> for the <strong><i>FICCI Online Certificate Course on Intellectual Property(IP), Session- <?php echo $sessionStartMonth; ?> - <?php echo $sessionEndMonth; ?> <?php echo $sessionYear; ?>.</i></strong><br />
<br />
Result: <?php echo $result; ?> <br />
Marks Obtained in MCQS-:<?php echo $marks_obtaine; ?> <br />
Marks obtained in Assignment-: <?php echo $assignment_marks; ?> <br />
Total Marks-: <?php echo $final_marks; ?> <br /> <br /> 
*Re-attempt permitted in the next course session at a reduced fee of Rs 1000 <br /> <br />
<strong><u>Certificate Announcement</u></strong><br /> <br /> 
For issuance of certificates, course participants are requested to kindly confirm their contact details as provided below, immediately: <br /> <br /> 
1. Name <br />
2. Father’s/Husband’s Name <br/>
3. Telephone Number <br/>
4. Complete Address and Pincode <br/>
Should you require any clarification or further information, please feel free to contact the undersigned. <br/> <br/>




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