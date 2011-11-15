<?php
session_start();

include('/var/www/html/db.php');


$q="SELECT *,sellers.id AS pid,DATE(datetime_entered) AS indate FROM sellers,uszip WHERE phone IS NOT NULL AND phone != '' AND sellers.zip=uszip.zip GROUP BY sellers.id";
$result = mysql_query($q) or die(mysql_error()." $q");
$leads = array();
while($row = mysql_fetch_array($result)) {
	$row['ptype']='S';
	$leads[] = $row;		
}

$q="SELECT *,buyers.id AS pid,DATE(datetime_entered) AS indate FROM buyers,uszip WHERE phone IS NOT NULL AND phone != '' AND buyers.zip=uszip.zip GROUP BY buyers.id";
$result = mysql_query($q) or die(mysql_error()." $q");
while($row = mysql_fetch_array($result)) {
	$row['ptype']='B';
	$leads[] = $row;		
}

usort($leads,"cmp");

$lstr = "";
foreach($leads as $lead) {
	//$lstr .= var_export($lead,true)."<br/>";
	$lstr .= "<div class=\"row\">";
	$lstr .= "<div class=\"lname_col\"><a href=\"lead_view?ptype=".$lead['ptype']."&pid=".$lead['pid']."\">".$lead['l_name']."</a></div>";
	$lstr .= "<div class=\"ptype_col\">".$lead['ptype']."</div>";
	$lstr .= "<div class=\"state_col\">".$lead['state']."</div>";
	$lstr .= "<div class=\"city_col\">".$lead['city']."</div>";
	$lstr .= "<div class=\"zip_col\">".$lead['zip']."</div>";
	$lstr .= "<div class=\"beds_col\">".$lead['beds']."</div>";
	$lstr .= "<div class=\"baths_col\">".$lead['baths']."</div>";
	$lstr .= "<div class=\"type_col\">".$lead['type']."</div>";		
	$lstr .= "<div class=\"dtime_col\">".$lead['indate']."</div>";
	$lstr .= "</div>";
}

function cmp($a,$b) {
	if(strtotime($a['indate'])>strtotime($b['indate'])) {
		return -1;
	} 
	return 1;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>BeMyRealEstateAgent.com - Lead Directory</title>
<link href="../jquery-ui/development-bundle/themes/base/jquery.ui.all.css"
	rel="stylesheet" type="text/css" />
<link href="../styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="../jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<style>
.lname_col {
	float:left;
	width:145px;	
}

.ptype_col {
	float:left;
	width:50px;	
}
.state_col {
	float:left;
	width:50px;	
}
.city_col {
	float:left;
	width:140px;	
}
.zip_col {
	float:left;
	width:50px;	
}
.beds_col {
	float:left;
	width:30px;
}
.baths_col {
	float:left;
	width:30px;	
}
.type_col {
	float:left;
	width:175px;	
}

.dtime_col {
	float:left;
	width:75px;	
}

.ltable {
	width:750px;
	margin-left:20px;
}

.lhead {
	font-weight:bold;
	font-size:16px;
}
</style>
<script>

</script>

</head>

<body>
<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Lead Directory</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="copy_block">
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="ltable">
<div class="row">&nbsp;</div>

<div class="row">
	<div class="lname_col lhead">Last Name</div>
	<div class="ptype_col lhead">Lead</div>
	<div class="state_col lhead">State</div>
	<div class="city_col lhead">City</div>
	<div class="zip_col lhead">Zip</div>
	<div class="beds_col lhead">BR</div>
	<div class="baths_col lhead">BA</div>
	<div class="type_col lhead">Type</div>
	<div class="dtime_col lhead">Received</div>
</div>


<?php echo $lstr;?>

<div class="row">&nbsp;</div>

</div>
</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="footer"></div>
</body>
</html>