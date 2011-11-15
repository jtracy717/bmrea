<?php

include('db.php');
include('jsonwrapper/jsonwrapper.php');
session_start();

if($_POST['a_active']) {
	$active = 1;
} else {
	$active = 0;
}

$retval = array();
$a_f_name = addslashes(ucwords(strtolower($_POST['a_f_name'])));
$a_l_name = addslashes(ucwords(strtolower($_POST['a_l_name'])));
$agent_email = $_POST['a_email'];

$prospect_type = $_SESSION['prospect_type'];
$prospect_id = $_SESSION['prospect_id'];

$q="SELECT * FROM agents WHERE email='$agent_email'";
$result = mysql_query($q);
if(!$result) {
	$retval['success']=false;
	$retval['message']=mysql_error()." $q";
	echo json_encode($retval);
	exit();
}
if(mysql_num_rows($result)>0) {
	$arow = mysql_fetch_array($result);
	$agent_id = $arow['id'];
	$q="UPDATE agents SET f_name='$a_f_name',l_name='$a_l_name',email='{$_POST['a_email']}',website='{$_POST['website']}',phone='{$_POST['phone']}',active=$active WHERE id=$agent_id";
	$result = mysql_query($q);
	if(!$result) {
		$retval['success']=false;
		$retval['message']=mysql_error()." $q";
		echo json_encode($retval);
		exit();
	}
} else {
	$q="INSERT INTO agents (f_name,l_name,email,website,phone,active) VALUES('$a_f_name','$a_l_name','{$_POST['a_email']}','{$_POST['website']}','{$_POST['phone']}',$active)";
	$result = mysql_query($q);
	if(!$result) {
		$retval['success']=false;
		$retval['message']=mysql_error()." $q";
		echo json_encode($retval);
		exit();
	}	
	$agent_id = mysql_insert_id();
}
$_SESSION['arow']=array('f_name'=>$a_f_name,'l_name'=>$a_l_name,'email'=>$_POST['a_email'],'website'=>$_POST['website'],'phone'=>$_POST['phone'],'active'=>$active,'id'=>$agent_id);

if($prospect_type=="S") {
	$q="REPLACE INTO seller_invites (topaypal_datetime,agent_id,seller_id) VALUES(NOW(),$agent_id,$prospect_id)";
} else {
	$q="REPLACE INTO buyer_invites (topaypal_datetime,agent_id,buyer_id) VALUES(NOW(),$agent_id,$prospect_id)";
}
$result = mysql_query($q);
if(!$result) {
	$retval['success']=false;
	$retval['message']=mysql_error()." $q";
	echo json_encode($retval);
	exit();
}
$retval['success']=true;
$retval['item_number']=$prospect_type.str_pad($prospect_id,8,"0",STR_PAD_LEFT).str_pad($agent_id,8,"0",STR_PAD_LEFT);
echo json_encode($retval);

?>