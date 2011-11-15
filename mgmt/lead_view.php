<?php 
session_start();
include('/var/www/html/db.php');

$type_abbr = $_GET['ptype'];

if($type_abbr=="S") {
	$q="SELECT * FROM sellers,uszip WHERE sellers.id={$_GET['pid']} AND sellers.zip=uszip.zip GROUP BY sellers.id";	
} else {
	$q="SELECT * FROM buyers,uszip WHERE buyers.id={$_GET['pid']} AND buyers.zip=uszip.zip GROUP BY buyers.id";
}

$result = mysql_query($q) or die(mysql_error()." $q");
$row = mysql_fetch_array($result);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Thank You</title>
<link href="../jquery-ui/development-bundle/themes/base/jquery.ui.all.css"
	rel="stylesheet" type="text/css" />
<link href="../styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="../jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script>
function do_email()  {
	if(/^\w+@\w+\.\w+$/.test($("#agent_email").val())) {
		window.location = "email_agent?ptype=<?php echo $_GET['ptype'];?>&pid=<?php echo $_GET['pid'];?>&email="+$("#agent_email").val();
		return;
	} else {
		alert('You must enter a valid email in the Agent Email box to use this function.');
	}
}
</script>
</head>


<body>
<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Lead View</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="spacer">&nbsp;</div>

<div class="regular">

<?php 
if($type_abbr=="S") {
	echo "Lead Type: Seller<br/>";
	echo "Seller Name: ".$row['f_name']." ".$row['l_name']."<br/>";
	echo "Property Type: ".$row['type']."<br/>";
	echo "Property Address: ".$row['address']."<br/>";
	echo "Property Suite/Unit: ".$row['address2']."<br/>";
	echo "Property City: ".$row['city']."<br/>";
	echo "Property State: ".$row['state']."<br/>";
	echo "Property Zip: ".$row['zip']."<br/>";
	echo "Number of Bedrooms: ".$row['beds']."<br/>";
	echo "Number of Bathrooms: ".$row['baths']."<br/>";
	echo "Desired Date of Sale: ".date('m/d/Y',strtotime($row['sale_date']))."<br/>";
	echo "Year Built: ".$row['year_built']."<br/>";
	echo "Desired Sale Price: $".number_format($row['sale_price'],0,'.',',')."<br/>";
	echo "Reason For Selling: ".$row['reason']."<br/>";
	echo "Prospect Email: ".$row['email']."<br/>";
	echo "Prospect Phone: ".$row['phone']."<br/>";
} else {
	echo "Lead Type: Buyer<br/>";
	echo "Name: ".$row['f_name']." ".$row['l_name']."<br/>";
	echo "Desired Property Type: ".$row['type']."<br/>";		
	echo "Desired Number of Bedrooms: ".$row['beds']."<br/>";
	echo "Desired Number of Bathrooms: ".$row['baths']."<br/>";
	echo "Desired City: ".$row['city']."<br/>";
	echo "Desired State: ".$row['state']."<br/>";
	echo "Desired Zipcode: ".$row['zip']."<br/>";
	echo "Desired Date of Purchase: ".date('m/d/Y',strtotime($row['buy_date']))."<br/>";	
	echo "Desired Sale Price: $".number_format($row['price'],0,'.',',')."<br/>";
	echo "Mortgage Status: ".$row['financing']."<br/>";
	echo "Prospect Email: ".$row['email']."<br/>";
	echo "Prospect Phone: ".$row['phone']."<br/>";		
}	
?>	
	<br/>
	<br/>
	Agent Email: <input type="text" id="agent_email" /> <a href="javascript:do_email();">Email Lead</a>
</div>

<div class="spacer">&nbsp;</div>
<div><a class="button_link agent_link_button" href="javascript:window.print();">Print Lead</a></div>
<div class="spacer">&nbsp;</div>
<div><a class="button_link agent_link_button" href="/mgmt">Mgmt Home</a></div>
<div class="spacer">&nbsp;</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer"></div>



</body>
</html>