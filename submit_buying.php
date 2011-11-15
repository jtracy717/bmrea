<?php

if($_GET['zip']) {
	include('log.php');
	include('db.php');
	include('jsonwrapper/jsonwrapper.php');
	include('agent_email.php');
	include("PHPMailer_v5.1/class.phpmailer.php");
	include('agent_email_inactive.php');

	$buyer = array();
	$buyer['zip'] = $zip = str_pad($_GET['zip'],5,"0",STR_PAD_LEFT);
	$buyer['type'] = $type = $_GET['type'];
	$buyer['beds'] = $beds = $_GET['beds'];
	$buyer['baths'] = $baths = $_GET['baths'];
	$buyer['buy_date'] = $buy_date = date('Y-m-d',strtotime($_GET['buy_date']));	
	$buyer['price'] = $price = $_GET['price'];	
	$buyer['f_name'] = $f_name = addslashes(ucwords(strtolower($_GET['f_name'])));
	$buyer['l_name'] = $l_name = addslashes(ucwords(strtolower($_GET['l_name'])));
	$buyer['email'] = $email = $_GET['email'];
	$buyer['phone'] = $phone = $_GET['phone'];
	$buyer['financing'] = $financing = $_GET['financing'];	

	$q="SELECT * FROM buyers WHERE email='$email' ORDER BY DATE(datetime_entered) DESC";
	$result = mysql_query($q);
	if(!$result) {
		lwrite(mysql_error()." $q");
	}
	if(mysql_num_rows($result)>0) {
		$buy = mysql_fetch_array($result);
		if(strtotime("+1 month",strtotime($buy['datetime_entered']))>time()) {
			mail('jtracy717@gmail.com',"double submit within a month",var_export($buyer,true));
			//header('Location:submit_selling.php');
			//exit();
		}
	}

	$q="INSERT INTO buyers (zip,type,beds,baths,buy_date,price,f_name,l_name,email,phone,financing) VALUES ($zip,'$type',$beds,$baths,'$buy_date',$price,'$f_name','$l_name','$email','$phone','$financing')";
	$result = mysql_query($q);
	
	if(!$result) {
		lwrite(mysql_error()." $q");
	}
	
	$buyer['id'] = mysql_insert_id();


	/*
	$q="SELECT agents.* FROM agents,agent_zips WHERE agents.opted_out=0 AND agent_zips.agent_id=agents.id AND agent_zips.zip=$zip";
	$result = mysql_query($q);
	if(!$result) {
		throw new Exception(mysql_error()." $q");
	}

	while($agent=mysql_fetch_array($result)){
		if($agent['active']) {
			agent_email($agent,$buyer);
		} else {
			if($agent['email']) {
				agent_email_inactive($agent_seller);
			}
		}
	}
	*/
	
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
	$mail->Subject = "New buyer lead submitted";
	
	$mail->IsHTML(true);
	$mail->Body = "{$buyer['f_name']} ".substr($buyer['l_name'],0,1)." wants to buy a {$buyer['beds']} bedroom {$buyer['baths']} bath {$buyer['type']} property in zipcode {$buyer['zip']}";	
	$mail->IsSendmail();	
	
	$result = $mail->Send();
	///////////////////////////////////////

	header('Location:submit_buying.php');

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
