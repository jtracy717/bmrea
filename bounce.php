<?php
/*
{
  "ID" : 42,
  "Type" : "HardBounce",
  "Email" : "jim@test.com",
  "BouncedAt" : "2010-04-01",
  "Details" : "test bounce",
  "DumpAvailable" : true,
  "Inactive" : true,
  "CanActivate" : true
}
 */

include('db.php');

$q="UPDATE agents SET bounce_count=(bounce_count+1) WHERE email='{$_POST['Email']}'";
mysql_query($q);

$q="UPDATE sellers SET bounce_count=(bounce_count+1) WHERE email='{$_POST['Email']}'";
mysql_query($q);


?>