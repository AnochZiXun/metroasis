$(function() {
  // This button will increment the value
	  $('.qtyplus').click(function(e) {
		// Stop acting like a button
		e.preventDefault();
		// Get the field name
		fieldName = $(this).attr('field');
		// Get its current value
		var fieldElement = $(this).siblings('input[name=' + fieldName + ']');
		console.log(fieldElement);
		var currentVal = parseInt(fieldElement.val());
		// If is not undefined
		if (!isNaN(currentVal)) {
		  // Increment
		  fieldElement.val(currentVal + 1);
		} else {
		  // Otherwise put a 0 there
		  fieldElement.val(0);
		}
		calculateAmount($(this));
	  });
	  // This button will decrement the value till 0
	  $(".qtyminus").click(function(e) {
		// Stop acting like a button
		e.preventDefault();
		// Get the field name
		fieldName = $(this).attr('field');
		// Get its current value
		var fieldElement = $(this).siblings('input[name=' + fieldName + ']');
		console.log(fieldElement);
		var currentVal = parseInt(fieldElement.val());
		// If it isn't undefined or its greater than 0
		if (!isNaN(currentVal) && currentVal > 0) {
		  // Decrement one
		  fieldElement.val(currentVal - 1);
		} else {
		  // Otherwise put a 0 there
		  fieldElement.val(0);
		}
		calculateAmount($(this));
	  });
	  
	  $('input[name=quantity]').change(function(){
		  var quantity = Number($(this).val());
		  calculateAmount($(this), quantity);
	  })
	  
	  function calculateAmount(e,quantity) {
		var basketItemRowElement = e.closest('.basketItemRow');
		var unitPriceElement = basketItemRowElement.find('#unitPrice');
		if(unitPriceElement) {
			var unitPriceStr = unitPriceElement.text();
			var quantity = quantity ? quantity : Number(e.siblings('input[name=quantity]').val());
			var unitPrice = Number(unitPriceStr.substring(unitPriceStr.indexOf('$')+1));
			var newPrice = (quantity*unitPrice);			
			basketItemRowElement.find('.item_total_amount').text('$'+newPrice);
			
			var totalAmount = 0;
			$('.item_total_amount').each(function(){
				var totalElement = $(this);
				var total = Number(totalElement.text().substring(totalElement.text().indexOf('$')+1));
				totalAmount = totalAmount + total;
			})
			//$('#totalAmount').text('$'+addCommas(totalAmount));
			//$('#totalAmountB').text('$'+addCommas(totalAmount-300));
			//console.log('111111111');
			//console.log($('#totalAmount'));
		}
	  }
	  
	  function addCommas(nStr)
		{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
		}
});
