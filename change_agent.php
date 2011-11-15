<?php

session_start();
include('db.php');

if($_POST['l_name']) {
	$q="SELECT * FROM agents WHERE email='{$_POST['email']}'";
	$result = mysql_query($q) or die(mysql_error()." $q");
	if(mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);
		$agent_id = $row['id'];
		$q="UPDATE agents SET active=1,f_name='{$_POST['f_name']}',l_name='{$_POST['l_name']}',email='{$_POST['email']}' WHERE id=$agent_id";
		mysql_query($q) or die(mysql_error()." $q");
	} else  {
		$q="INSERT INTO agents (f_name,l_name,email,zip,source) VALUES ('{$_POST['f_name']}','{$_POST['l_name']}','{$_POST['email']}','{$_POST['zip1']}','{$_SESSION['source']}')";
		mysql_query($q) or die(mysql_error()." $q");
		$agent_id = mysql_insert_id();
	}
	
	header('Location:change_agent.php');	
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
<div class="subtitle">Affordable Marketing Targeting Fresh Prospects</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="spacer">&nbsp;</div>
<div class="big_thanks">Thank you for your business!</div>
<div class="spacer">&nbsp;</div>
<div class="reg_info">Please be on the lookout for emails from
BeMyRealEstateAgent.com with information about prospects.</div>
<div class="spacer">&nbsp;</div>
<div class="side_note">Please pay special attention to your spam or bulk
mail folders, as our messages may inadvertently end up there.</div>
<div class="spacer">&nbsp;</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer">Problems? Email us at <a class="mailto_link"
	href="mailto:support@BeMyRealEstateAgent.com">support@BeMyRealEstateAgent.com</a></div>

<!-- Google Code for Register Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1037542521;
var google_conversion_language = "ar";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "ZdQCCNvmkQIQ-cje7gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037542521/?label=ZdQCCNvmkQIQ-cje7gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
