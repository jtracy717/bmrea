<?
include('/var/www/html/jsonwrapper/jsonwrapper.php');


function send_email($agent_id,$type_abbr,$prospect_id) {

	$log = fopen('/var/www/logs/ipn','a+');
	fwrite($log,"==============================================\n");
	include('/var/www/html/db.php');
	fwrite($log,"here1\n");

	fwrite($log,"type_abbr:$type_abbr\n");
	fwrite($log,"prospect_id:$prospect_id\n");
	fwrite($log,"agent_id:$agent_id\n");

	if($type_abbr=="S") {
		$q="SELECT *,sellers.email AS s_email,sellers.f_name AS s_f_name,sellers.l_name AS s_l_name,agents.l_name AS a_l_name,agents.f_name AS a_f_name,agents.email AS a_email,sellers.zip AS s_zip, sellers.phone AS s_phone FROM seller_invites,sellers,agents WHERE seller_invites.seller_id=sellers.id AND seller_invites.agent_id=agents.id AND agents.id=$agent_id AND sellers.id=$prospect_id";
	} else {
		$q="SELECT *,buyers.email AS b_email,buyers.f_name AS b_f_name,buyers.l_name AS b_l_name,agents.l_name AS a_l_name,agents.f_name AS a_f_name,agents.email AS a_email, buyers.zip AS b_zip, buyers.phone AS b_phone FROM buyer_invites,buyers,agents WHERE buyer_invites.buyer_id=buyers.id AND buyer_invites.agent_id=agents.id AND agents.id=$agent_id AND buyers.id=$prospect_id";
	}
	$result = mysql_query($q);
	if(!$result) {
		fwrite($log,mysql_error()." $q\n");
	}
	$row = mysql_fetch_array($result);
	fwrite($log,"row: ".var_export($row,true)."\n");
	fwrite($log,"here3\n");
	fwrite($log,"here4\n");
	//put the transaction id and maybe the amount paid in this table as well
	if($type_abbr=="S") {
		$q="UPDATE seller_invites SET contact_datetime=NOW() WHERE seller_id=$prospect_id AND agent_id=$agent_id";
	} else {
		$q="UPDATE buyer_invites SET contact_datetime=NOW() WHERE buyer_id=$prospect_id AND agent_id=$agent_id";
	}
	$result = mysql_query($q);
	if(!$result) {
		fwrite($log,mysql_error()." $q\n");
	}
	fwrite($log,"here5\n");

	ob_start();
	?>
<div
	style="width: 98%; margin: auto; text-align: left; background-color: #415B62; font-family: Arial, Helvetica, sans-serif;">
<div style="height: 25px; font-size: 0px;">&nbsp;</div>
<div
	style="padding-left: 15px; padding-right: 15px; text-align: left; color: #FFFFFF; font-size: 46px;">
<div>BeMyRealEstateAgent.com</div>
<div style="font-size: 23px; font-style: italic;">Affordable Marketing
Targeting Fresh Prospects</div>
</div>
<div style="height: 25px; font-size: 0px;">&nbsp;</div>

<div
	style="margin: auto; border-width: 15px; border-style: solid; border-color: #E6EBEB;">
<div
	style="padding-left: 15px; padding-right: 15px; padding-top: 15px; padding-bottom: 15px; background-color: #FFFFFF; font-size: 12px; color: #696969; font-weight: strong; border-width: 1px; border-style: solid; border-color: #808080;">
Dear <?php echo $row['a_f_name']." ".$row['a_l_name'];?>:<br />
<br />
<p style="text-align: justify;">You are receiving this email from
BeMyRealEstateAgent.com as a result of your recent discussion with a
BeMyRealEstateAgent.com representative. Below are the details of the
lead you discussed:<br />
<br />

	<?php
	if($type_abbr=="S") {
		echo "Lead Type: Seller<br/>";
		echo "Seller Name: ".$row['s_f_name']." ".$row['s_l_name']."<br/>";
		echo "Property Type: ".$row['type']."<br/>";
		echo "Property Address: ".$row['address']."<br/>";
		echo "Property Suite/Unit: ".$row['address2']."<br/>";
		echo "Property Zip: ".$row['s_zip']."<br/>";
		echo "Number of Bedrooms: ".$row['beds']."<br/>";
		echo "Number of Bathrooms: ".$row['baths']."<br/>";
		echo "Desired Date of Sale: ".date('m/d/Y',strtotime($row['sale_date']))."<br/>";
		echo "Year Built: ".$row['year_built']."<br/>";
		echo "Desired Sale Price: $".number_format($row['sale_price'],0,'.',',')."<br/>";
		echo "Reason For Selling: ".$row['reason']."<br/>";
		echo "Prospect Email: ".$row['s_email']."<br/>";
		echo "Prospect Phone: ".$row['s_phone']."<br/>";
	} else {
		echo "Lead Type: Buyer<br/>";
		echo "Name: ".$row['b_f_name']." ".$row['b_l_name']."<br/>";
		echo "Desired Property Type: ".$row['type']."<br/>";
		echo "Desired Number of Bedrooms: ".$row['beds']."<br/>";
		echo "Desired Number of Bathrooms: ".$row['baths']."<br/>";
		echo "Desired Zipcode: ".$row['b_zip']."<br/>";
		echo "Desired Date of Purchase: ".date('m/d/Y',strtotime($row['buy_date']))."<br/>";
		echo "Desired Sale Price: $".number_format($row['price'],0,'.',',')."<br/>";
		echo "Mortgage Status: ".$row['financing']."<br/>";
		echo "Prospect Email: ".$row['b_email']."<br/>";
		echo "Prospect Phone: ".$row['b_phone']."<br/>";
	}
	?> <br />
<br />
We appreciate your business and look forward to providing you more
prospects in the future. If you have any questions at all, simply email
support@bemyrealestateagent.com or contact your representative.</p>

<br />
Regards,<br />
The BeMyRealEstateAgent.com Team</div>
</div>
<br />
<br />
This e-mail was sent by BeMyRealEstateAgent.com, located at 13510
Tranquility Ct, Herndon, VA 20171 (USA). To receive no further e-mails,
simply <a
	href="http://bemyrealestateagent.com/opt_out.php?id=<?php echo $agent_id;?>">opt
out</a>.</div>

	<?php
	$offer_email = ob_get_contents();
	fwrite($log,"here6\n");
	ob_end_clean();
	$offer_email = wordwrap($offer_email,900, "\n");

	ob_start();
	?>
BeMyRealEstateAgent.com Affordable Marketing Targeting Fresh Prospects
Dear
	<?php echo $row['a_f_name']." ".$row['a_l_name'];?>
: You are receiving this email from BeMyRealEstateAgent.com as a result
of your recent discussion with a BeMyRealEstateAgent.com representative.
Below are the details of the lead you discussed:

	<?php
	if($type_abbr=="S") {
		echo "Lead Type: Seller\n";
		echo "Seller Name: ".$row['s_f_name']." ".$row['s_l_name']."\n";
		echo "Property Type: ".$row['type']."\n";
		echo "Property Address: ".$row['address']."\n";
		echo "Property Suite/Unit: ".$row['address2']."\n";
		echo "Property Zip: ".$row['s_zip']."\n";
		echo "Number of Bedrooms: ".$row['beds']."\n";
		echo "Number of Bathrooms: ".$row['baths']."\n";
		echo "Desired Date of Sale: ".date('m/d/Y',strtotime($row['sale_date']))."\n";
		echo "Year Built: ".$row['year_built']."\n";
		echo "Desired Sale Price: $".number_format($row['sale_price'],0,'.',',')."\n";
		echo "Reason For Selling: ".$row['reason']."\n";
		echo "Prospect Email: ".$row['s_email']."\n";
		echo "Prospect Phone: ".$row['s_phone']."\n";
	} else {
		echo "Lead Type: Buyer\n";
		echo "Name: ".$row['b_f_name']." ".$row['b_l_name']."\n";
		echo "Desired Property Type: ".$row['type']."\n";
		echo "Desired Number of Bedrooms: ".$row['beds']."\n";
		echo "Desired Number of Bathrooms: ".$row['baths']."\n";
		echo "Desired Zipcode: ".$row['b_zip']."\n";
		echo "Desired Date of Purchase: ".date('m/d/Y',strtotime($row['buy_date']))."\n";
		echo "Desired Sale Price: $".number_format($row['price'],0,'.',',')."\n";
		echo "Mortgage Status: ".$row['financing']."\n";
		echo "Prospect Email: ".$row['b_email']."\n";
		echo "Prospect Phone: ".$row['b_phone']."\n";
	}
	?>

We appreciate your business and look forward to providing you
prospects in the future. If you have any questions at all, simply email
support@bemyrealestateagent.com or contact your representative. Regards,
The BeMyRealEstateAgent.com Team This e-mail was sent by
BeMyRealEstateAgent.com, located at 13510 Tranquility Ct, Herndon, VA
20171 (USA). To receive no further e-mails, simply visit
http://bemyrealestateagent.com/opt_out.php?id=
	<?php echo $agent_id;?>
".

	<?php
	$plain_email = ob_get_contents();
	fwrite($log,"here6\n");
	ob_end_clean();
	$plain_email = wordwrap($plain_email,900, "\n");


	$agent_email = $row['a_email'];

	include("/var/www/html/postmark.php");

	$postmark = new Postmark("271846bd-96a5-4c2a-af31-047f9e10c7ae","prospects@BeMyRealEstateAgent.com");
	$postmark->to($agent_email);
	$postmark->subject("Details on your BeMyRealEstateAgent.com Lead");
	$postmark->html_message($offer_email);
	$postmark->plain_message($plain_email);
	$postmark->tag("seller");
if($postmark->send()){
	fwrite($log,"message sent\n");
} else {
	fwrite($log,"message failed\n");
}
fwrite($log,"here7\n");
fclose($log);
}

?>