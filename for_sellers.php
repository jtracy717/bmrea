<?php
//http://all-free-download.com/free-website-templates-preview/synchronize_450/?s=#
//http://findrealestateagents.us
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="Description" content="Let real estate agents come to you" />
<meta name="Keywords" content="real estate agent" />
<title>BeMyRealEstateAgent.com</title>
<link href="jquery-ui/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-ui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="for_sellers.js"></script>
<?php include('gtags.php');?>
</head>

<body>
<div class="heading_spacer">&nbsp;</div>
<div class="main_heading">
<div>BeMyRealEstateAgent.com</div>
<div class="subtitle">Let Real Estate Agents Come to You</div>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="copy_block">
How it works...
<ol>
<li>Fill out the form below.</li>
<li>You will be contacted with info about the qualifications, strategy, and commissions of real estate agents who want your business.</li>
<li>That's it!  You decide which real estate agent to use.  No calling around or filling out multiple contact forms.</li>
</ol>
</div>
<div class="heading_spacer">&nbsp;</div>
<div class="outer_wrapper">
<div class="inner_wrapper">
<div class="table">
<form name="selling_form" id="selling_form" method="get" action="submit_selling.php">
<div class="row">&nbsp;</div>

<div class="row">
	<div class="col1">Type of Home:</div>
	<div class="col2">
		<select name="type" id="type">
			<option value="">Please select</option>
			<option value="Single Family Detached">Single Family Detached</option>
			<option value="Condominium">Condominium</option>
			<option value="Townhouse">Townhouse</option>
			<option value="Rental">Rental</option>
			<option value="Multi-family">Multi-family</option>
			<option value="Vacation Home">Vacation</option>
			<option value="Others">Other</option>
		</select>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Number of Bedrooms:</div>
	<div class="col2">
		<select name="beds" id="beds">
			<option value="">-</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
<div class="row">
	<div class="col1">Number of Bathrooms:</div>
	<div class="col2">
		<select name="baths" id="baths">
			<option value="">-</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
<div class="row">
	<div class="col1">Desired Date of Sale:</div>
	<div class="col2">
		<input size="10" type="text" name="sale_date" id="sale_date"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
<div class="row">
	<div class="col1">Year Built (approx.):</div>
	<div class="col2">
		<input size="4" type="text" name="year" id="year"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>
<div class="row">
	<div class="col1">Desired Sale Price:</div>
	<div class="col2">
		<input size="10" type="text" name="price" id="price"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Reason for Selling:</div>
	<div class="col2">
		<select name="reason" id="reason">
			<option value="" selected>Please select</option>
			<option value="Need a Bigger Home">Need a Bigger Home</option>
			<option value="Corporate Relocation-New Job">Corporate Relocation-New Job</option>
			<option value="Need a Smaller Home">Need a Smaller Home</option>
			<option value="Attracted to a New Community">Attracted to a New Community</option>
			<option value="Retirement">Retirement</option>
			<option value="Investment Property">Investment Property</option>
			<option value="Divorce/Separation">Divorce/Separation</option>
			<option value="Financial Reasons">Financial Reasons</option>
			<option value="Selling Vacation/Other Home">Selling Vacation/Other Home</option>
			<option value="Other">Other</option>
		</select>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

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
	<div class="col2">
		<input size="30" type="text" name="email" id="email"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
<div class="col1">Your Phone:</div>
<div class="col2"><input size="10"
	type="text" name="phone" id="phone" /></div>
<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Property Street Address:</div>
	<div class="col2">
		<input size="45" type="text" name="address" id="address"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">
	<div class="col1">Suite/Apt/Unit/etc.:</div>
	<div class="col2">
		<input size="45" type="text" name="address2" id="address2"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>


<div class="row">
	<div class="col1">Property Zip:</div>
	<div class="col2">
		<input size="5" type="text" name="zip" id="zip"/>
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">&nbsp;</div>

<div class="row">
	<div class="col_1_2">
		<div style="height:20px;float:left;">
		<input name="optin" id="optin" type="checkbox"/>
		</div>			
		I would like BeMyRealEstateAgent.com to email me when real estate agents respond.		
	</div>
	<div class="col3 err">&nbsp;</div>
</div>

<div class="row">&nbsp;</div>

<div class="row">
	<div class="col1">
		&nbsp;
	</div>
	<div class="col2">
		&nbsp;
	</div>
	<div class="col3"><input class="button_link" type="submit" name="doform" id="doform" onclick="return false;" value="Go"/></div>
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