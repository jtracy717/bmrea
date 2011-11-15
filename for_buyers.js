function flag(selector, message) {
	$(selector).closest('.row').find('.err').html(message);
}

$(function() {	
	$("#buy_date").datepicker();
	$("input,select").change(function() {
		var node = $(this);
		node.closest('.row').find('.err').empty();		
	});

	$("#doform").click(function() {
		//alert('here');
		var ok = true;				
		if(!/^\d{5}$/.test($("#zip").val())) {		
			flag('#zip','Please enter a 5-digit zipcode');									
			ok = false;
		}
		
		if(!$("#type").val()) {
			flag('#type','Please select a home type');									
			ok = false;
		}
		
		if(!$("#beds").val()) {
			flag('#beds','Please specify a number of bedrooms');									
			ok = false;
		}

		if(!$("#baths").val()) {
			flag('#baths','Please specify a number of bathrooms');									
			ok = false;
		}		
		
		if(!/^\d{2}\/\d{2}\/\d{4}$/.test($("#buy_date").val())) {
			flag('#buy_date','Please specify a desired sale date');									
			ok = false;
		}		
		
		if(!/^\d+$/.test($("#price").val())) {
			var price = $("#price").val();
			if((price<5000) || (price > 50000000)) {
				flag('#price','Please give your best guess at the sale price');									
				ok = false;
			}
		}		

		if(!$("#f_name").val()) {
			flag('#f_name',"Please enter your first name");									
			ok = false;
		}

		if(!$("#l_name").val()) {
			flag('#l_name',"Please enter your last name");									
			ok = false;
		}

		if(!/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test($("#email").val())) {
			flag('#email',"Please provide a valid email address");									
			ok = false;
		}

		if(!$("#optin").attr('checked')) {		
			flag("#optin","Please give us permission to email you");									
			ok = false;
		}
		
		if(!/^\d{3}[^0-9A-Za-z]?\d{3}[^0-9A-Za-z]?\d{4}$/.test($("#phone").val())) {					
			flag('#phone','Please enter a number in the form 555-555-5555');									
			ok = false;			
		}

		if(!$("#financing").val()) {
			flag('#financing',"Please specify your mortgage status");									
			ok = false;
		}							

		if(ok) {
			$(this).closest("form").submit();
		}
	});
});