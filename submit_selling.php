<?php

if($_GET['zip']) {
	include('log.php');
	include('db.php');
	include('jsonwrapper/jsonwrapper.php');
	include('agent_email.php');
	include("PHPMailer_v5.1/class.phpmailer.php");
	include('agent_email_inactive.php');

	$seller = array();
	$seller['zip'] = $zip = str_pad($_GET['zip'],5,"0",STR_PAD_LEFT);
	$seller['type'] = $type = $_GET['type'];
	$seller['beds'] = $beds = $_GET['beds'];
	$seller['baths'] = $baths = $_GET['baths'];
	$seller['sale_date'] = $sale_date = date('Y-m-d',strtotime($_GET['sale_date']));
	$seller['year_built'] = $year_built = $_GET['year'];
	$seller['sale_price'] = $sale_price = $_GET['price'];
	$seller['reason'] = $reason = $_GET['reason'];
	$seller['f_name'] = $f_name = addslashes(ucwords(strtolower($_GET['f_name'])));
	$seller['l_name'] = $l_name = addslashes(ucwords(strtolower($_GET['l_name'])));
	$seller['email'] = $email = $_GET['email'];
	$seller['phone'] = $phone = $_GET['phone'];
	$seller['address'] = $address = addslashes(ucwords(strtolower($_GET['address'])));
	$seller['address2'] = $address2 = addslashes(ucwords(strtolower($_GET['address2'])));	

	$q="SELECT * FROM sellers WHERE email='$email' ORDER BY DATE(datetime_entered) DESC";
	$result = mysql_query($q) or die(mysql_error()." $q");
	if(mysql_num_rows($result)>0) {
		$sell = mysql_fetch_array($result);
		if(strtotime("+1 month",strtotime($sell['datetime_entered']))>time()) {
			mail('jtracy717@gmail.com',"double submit within a month",var_export($seller,true));
			//header('Location:submit_selling.php');
			//exit();
		}
	}

	$q="INSERT INTO sellers (zip,type,beds,baths,sale_date,year_built,sale_price,reason,f_name,l_name,email,phone,address,address2) VALUES ($zip,'$type',$beds,$baths,'$sale_date',$year_built,$sale_price,'$reason','$f_name','$l_name','$email','$phone','$address','$address2')";
	$result = mysql_query($q) or die(mysql_error()." $q");
	if(!$result) {
		throw new Exception(mysql_error()." $q");
	}
	$seller['id'] = mysql_insert_id();

	////////////////////////////////
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "brokerprospects.com";	
	
	$mail->From="contact@brokerprospects.com";
	$mail->FromName="BrokerProspects.com";
	$mail->Sender="contact@brokerprospects.com";	
	
	$mail->AddAddress('clete@cmacapital.com');
	$mail->AddAddress('jtracy717@gmail.com');
	//$mail->AddAddress("check-auth-jtracy717=gmail.com@verifier.port25.com");
	$mail->Subject = "New seller lead submitted";
	
	$mail->IsHTML(true);
	$mail->Body = "{$seller['f_name']} ".substr($seller['l_name'],0,1)." is selling their {$seller['beds']} bedroom {$seller['baths']} bath {$seller['type']} property in zipcode {$seller['zip']}";	
	$mail->IsSendmail();	
	
	$result = $mail->Send();
	///////////////////////////////////////
	
	header('Location:submit_selling.php');

	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BeMyRealEstateAgent.com</title>
<link href="jquery-ui/development-bundle/themes/base/jquery.ui.all.css"
	rel="stylesheet" type="text/css" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<?php include('gtags.php');?>
</head>
<body>
<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Let Agents Compete for Your Business</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="spacer">&nbsp;</div>
<div class="big_thanks">Thank you for your business!</div>
<div class="spacer">&nbsp;</div>
<div class="reg_info">Please be on the lookout for emails from
BeMyRealEstateAgent.com with information about agent candidates.</div>
<div class="spacer">&nbsp;</div>
<div class="side_note">Please pay special attention to your spam or bulk
mail folders, as our messages may inadvertently end up there.</div>
<div class="spacer">&nbsp;</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer">Problems? Email us at <a class="mailto_link"
	href="mailto:support@BeMyRealEstateAgent.com">support@BeMyRealEstateAgent.com</a></div>

<!-- Google Code for Lead Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1037542521;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "xSrICOPHkQIQ-cje7gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript"
	src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display: inline;"><img height="1" width="1"
	style="border-style: none;" alt=""
	src="http://www.googleadservices.com/pagead/conversion/1037542521/?label=xSrICOPHkQIQ-cje7gM&amp;guid=ON&amp;script=0" />
</div>
</noscript>

</body>
</html>
