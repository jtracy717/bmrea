<?php
session_start();
if($_SESSION['logged_in']) {
	header('Location:mgmt_landing');			
	exit();
}

include('/var/www/html/db.php');
$msg = "&nbsp;";
if($_POST['submitted']) {	
	$_SESSION['post'] = $_POST;
	$q="SELECT * FROM mgmt WHERE email='{$_POST['email']}'";
	$result = mysql_query($q) or die(mysql_error()." $q");
	$row = mysql_fetch_array($result);
	if($row['password']!=$_POST['password']) {				
		$msg = "Your username/password combo was incorrect.";
	} else {
		$_SESSION['logged_in']=true;
		header('Location:mgmt_landing');			
		exit();
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BeMyRealEstateAgent.com - Mgmt Interface</title>
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

		if(!$("#password").val()) {
			flag('#password',"Please enter your password");									
			ok = false;
		}		
					
				
		if(ok) {
			form = $(this).closest("form");
						
			form.submit();

			/*
			$.post("mgmt_login.php",form.serialize(),function(data) {				
				form.submit();
			},"text");
			*/			
		} 
	});
});

var form;

</script>

</head>

<body>
<!-- 
begin var dump
<?php var_dump($_SESSION);?>
end var dump
 -->
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
<form method="POST">
<div class="row">&nbsp;</div>

<div class="row">
	<div class="col1">Email:</div>
	<div class="col2">
		<input size="30" type="text" name="email" id="email" value="<?php echo $_SESSION['post']['email'];?>"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Password:</div>
	<div class="col2">
		<input size="30" type="password" name="password" id="password"/>
	</div>
	<div class="col3 err"><?php echo $msg;?></div>
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
</form>
</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer"></div>
</body>
</html>