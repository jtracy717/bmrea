<?php
session_start();

include('/var/www/html/db.php');

$ptype = $_GET['ptype'];
$pid = $_GET['pid'];

if($_GET['submitted']) {	
	$zip = str_pad($_GET['zip'],5,"0",STR_PAD_LEFT);
	$f_name = addslashes(ucwords(strtolower($_GET['f_name'])));
	$l_name = addslashes(ucwords(strtolower($_GET['l_name'])));
	$address = addslashes(ucwords(strtolower($_GET['address'])));
	$address2 = addslashes(ucwords(strtolower($_GET['address2'])));	
	
	$q="UPDATE agents SET active=1,f_name='$f_name',l_name='$l_name',email='{$_GET['email']}',phone='{$_GET['phone']}',address='$address',address2='$address2',zip='$zip' WHERE id={$_GET['agent_id']}";
	mysql_query($q) or die(mysql_error()." $q");
	
	if($ptype=="S") {
		$q="REPLACE INTO seller_invites (seller_id,agent_id) VALUES ($pid,{$_GET['agent_id']})";
	} else {
		$q="REPLACE INTO buyer_invites (buyer_id,agent_id) VALUES ($pid,{$_GET['agent_id']})";
	}
	mysql_query($q) or die(mysql_error()." $q");
	
	include('/var/www/html/mgmt/send_email.php');
	send_email($_GET['agent_id'],$ptype,$pid);
					
	header('Location:mgmt_landing');			
	exit();	
} else {
	$q="SELECT * FROM agents WHERE email='{$_GET['email']}'";
	$result = mysql_query($q) or die(mysql_error()." $q");
	if(mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);	
		$phone = $row['phone'];
		$f_name = $row['f_name'];
		$l_name = $row['l_name'];
		$address = $row['address'];
		$address2 = $row['address2'];
		$zip = $row['zip'];
		$agent_id=$row['id'];
	} else{
		$q="INSERT INTO agents (email) VALUES ('{$_GET['email']}')";
		$result = mysql_query($q) or die(mysql_error()." $q");
		$agent_id=mysql_insert_id();		
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BeMyRealEstateAgent.com - Email Agent</title>
<link href="../jquery-ui/development-bundle/themes/base/jquery.ui.all.css"
	rel="stylesheet" type="text/css" />
<link href="../styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="../jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script>
function flag(selector, message) {
	//alert(selector+' '+message);
	$(selector).closest('.row').find('.err').html(message);
}

$(function() {	
	$("input,select").change(function() {
		var node = $(this);
		node.closest('.row').find('.err').empty();		
	});

	$("#doform").click(function() {				
		var ok = true;


		if(!/^\w+@\w+\.\w+$/.test($("#email").val())) {
			flag('#email',"Please provide a valid email address");									
			ok = false;
		}

		if(!$("#f_name").val()) {
			flag('#f_name',"Please enter your first name");									
			ok = false;
		}

		if(!$("#l_name").val()) {
			flag('#l_name',"Please enter your last name");									
			ok = false;
		}

		if(!/\d{3}[^0-9A-Za-z]?\d{3}[^0-9A-Za-z]?\d{4}/.test($("#phone").val())) {					
			flag('#phone','Please provide a valid phone in the form ###-###-####');									
			ok = false;			
		}

		if(!$("#address").val()) {
			flag('#address',"Please enter a street address");									
			ok = false;
		}

		if(!/^\d{5}$/.test($("#zip").val())) {		
			flag('#zip','Please enter a 5-digit zipcode');									
			ok = false;
		}					
				
		if(ok) {
			form = $(this).closest("form");						
			form.submit();
		} 
	});
});

var form;

</script>

</head>

<body>

<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Management Interface</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="copy_block">
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="table">
<form method="GET">
<div class="row">&nbsp;</div>

<div class="row">
	<div class="col1">Email:</div>
	<div class="col2">
		<input size="30" type="text" name="email" id="email" value="<?php echo $_GET['email'];?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">First Name:</div>
	<div class="col2">
		<input size="30" type="text" name="f_name" id="f_name" value="<?php echo $f_name;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Last Name:</div>
	<div class="col2">
		<input size="30" type="text" name="l_name" id="l_name" value="<?php echo $l_name;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Phone:</div>
	<div class="col2">
		<input size="30" type="text" name="phone" id="phone" value="<?php echo $phone;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
<div class="address">
	<div class="col1">Address:</div>
	<div class="col2">
		<input size="30" type="text" name="address" id="address" value="<?php echo $address;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
</div>

<div class="row">
<div class="address">
	<div class="col1">Address (line 2):</div>
	<div class="col2">
		<input size="30" type="text" name="address2" id="address2" value="<?php echo $address2;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
</div>

<div class="row">
<div class="zip">
	<div class="col1">Zipcode:</div>
	<div class="col2">
		<input size="30" type="text" name="zip" id="zip" value="<?php echo $zip;?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
</div>

<div class="row">
	<div class="col1">&nbsp;</div>
	<div class="col2">&nbsp;</div>
	<div class="col3">
		<input onclick="return false;" class="button_link" type="button" value="Submit" name="doform" id="doform"/>
	</div>
</div>

<div class="row">&nbsp;</div>
<input type="hidden" name="submitted" value="1"/>
<input type="hidden" name="agent_id" value="<?php echo $agent_id;?>"/>
<input type="hidden" name="ptype" value="<?php echo $ptype;?>"/>
<input type="hidden" name="pid" value="<?php echo $pid;?>"/>
</form>
</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer"></div>
</body>
</html>