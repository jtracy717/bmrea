<?php
session_start();
if($_GET['source']) {
	$_SESSION['source']=$_GET['source'];
}
if(!$_SESSION['source']) {
	$_SESSION['source']='Direct';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="Description" content="Leads and prospects for real estate agents marketing to home sellers." />
<meta name="Keywords" content="real estate leads, home seller leads, real estate agent leads, real estate agent prospects, real estate agent marketing, home marketing" />
<title>BeMyRealEstateAgent.com</title>
<link href="jquery-ui/development-bundle/themes/base/jquery.ui.all.css"
	rel="stylesheet" type="text/css" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
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


		if(!$("#f_name").val()) {
			flag('#f_name',"Please enter your first name");									
			ok = false;
		}		
		
		if(!$("#l_name").val()) {
			flag('#l_name',"Please enter your last name");									
			ok = false;
		}

		if(!/^\w+@\w+\.\w+$/.test($("#email").val())) {
			flag('#email',"Please provide a valid email address");									
			ok = false;
		}

		if(!(/^\d{5}$/.test($("#zip1").val())||!$("#zip1").val())) {		
			flag('#zip1','Please enter a 5-digit zipcode');									
			ok = false;
		}
		
		if(!$("#optin").attr('checked')) {		
			flag("#optin","Please give us permission to email you");									
			ok = false;
		}		
				
		if(ok) {
			form = $(this).closest("form");
			//alert(form.serialize()); 
			//store all the data in the session
			$.post("store_in_session.php",form.serialize(),function(data) {
				//alert(data);
				form.submit();
			},"text");			
		} 
	});
});

var form;

</script>
<?php include('gtags.php');?>
</head>

<body>
<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Affordable Marketing Targeting Fresh Prospects</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="copy_block">Have prospects in your area emailed directly
to you. It's as simple as filling out the form below...
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="table">
<form name="selling_form" id="selling_form"
	action="change_agent.php" method="post">
<div class="row">&nbsp;</div>

<div class="row">
	<div class="col1">First Name:</div>
	<div class="col2">
		<input size="30" type="text" name="f_name" id="f_name"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Last Name:</div>
	<div class="col2">
		<input size="30" type="text" name="l_name" id="l_name"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
<div class="col1">Your Email Address:</div>
<div class="col2"><input size="30"
	type="text" name="email" id="email" /></div>
<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Your Office Zipcode:</div>
	<div class="col2">
		<input size="5" type="text" name="zip1" id="zip1"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col_1_2">
		<div style="height:20px;float:left;">
		<input name="optin" id="optin" type="checkbox"/>
		</div>			
		I would like BeMyRealEstateAgent.com to email me when prospects are 
		identified in my area.		
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">&nbsp;</div>
	<div class="col2">&nbsp;</div>
	<div class="col3">
		<input onclick="return false;" class="button_link" type="button" value="Submit" name="doform" id="doform"/>
	</div>
</div>

<div class="row">&nbsp;</div>
</form>
</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer">Problems? Email us at <a class="mailto_link"
	href="mailto:support@BeMyRealEstateAgent.com">support@BeMyRealEstateAgent.com</a></div>
</body>
</html>