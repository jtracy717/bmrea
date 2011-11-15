<?php
include('db.php');

$q="UPDATE agents SET opted_out WHERE id={$_GET['id']}";
mysql_query($q) or die(mysql_error()." $q");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Opt Out</title>
<?php include('gtags.php');?>
</head>
<body>
Thank you for your response.<br/>
We are sorry that you did not value the emails you received from
BeMyRealEstateAgent.com.<br/>
You will no longer receive any emails from us.
</body>
</html>