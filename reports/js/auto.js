/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */
	      
//adds extra table rows
var i=$('table#invoiceTable tr').length;
$("#addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="productCode" name="data['+i+'][product_id]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><input type="text" data-type="productName" name="data['+i+'][product_name]" id="itemName_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';
	html += '<td><input type="text" name="data['+i+'][price]" id="price_'+i+'" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="data['+i+'][quantity]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="data['+i+'][total]" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>';
	html += '</tr>';
	$('table#invoiceTable').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$("#delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});

//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productCode' )autoTypeNo=0;
	if(type =='productName' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'ajax.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");						
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
			$('#itemNo_'+id[1]).val(names[0]);
			$('#itemName_'+id[1]).val(names[1]);
			$('#quantity_'+id[1]).val(1);
			$('#price_'+id[1]).val(names[2]);
			$('#total_'+id[1]).val( 1*names[2] );
			calculateTotal();
		}		      	
	});
});



//autocomplete address

$("#addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="customerName" name="data[customer_name]" id="customerName_" class="form-control autocomplete_txt" autocomplete="on"></td>';
	html += '<td><input type="text" data-type="customerNo" name="data[phone]" id="customerNo_" class="form-control autocomplete_txt" autocomplete="on"></td>';
	html += '<td><input type="text" data-type="customerAddress" name="data[address]" id="customerAddress_" class="form-control autocomplete_txt" autocomplete="on"  ondrop="return false;" onpaste="return false;"></td>';
	html += '</tr>';
	
});



//autocomplete  customer script
$(document).on('focus','.autocomplete_txt1',function(){
	type = $(this).data('type');
	
	if(type =='customerName' )autoTypeNo=0;
	if(type =='customerNo' )autoTypeNo=1;
	if(type =='customerAddress' )autoTypeNo=2; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'ajax1.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
                                               
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");					
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
			$('#customerName_'+id[1]).val(names[0]);
			$('#customerNo_'+id[1]).val(names[1]);
			$('#customerAddress_'+id[1]).val(names[2]);
		}		      	
	});
});
//address





//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	quantity = $('#quantity_'+id[1]).val();
	price = $('#price_'+id[1]).val();
	if( quantity!='' && price !='' ) $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );	
	calculateTotal();
});

$(document).on('change keyup blur','#discount',function(){
	calculateTotal1();
});

//total price calculation 

function calculateTotal1(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	}); 
	$('#subTotal').val( subTotal.toFixed(2) );
	discount = $('#discount').val();
	if(discount != '' && typeof(discount) != "undefined" ){
		discountAmount = subTotal * ( parseFloat(discount) /100 );
		$('#discountAmount').val(discountAmount.toFixed(2));
		total = subTotal - discountAmount;
	}else{
		$('#discountAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	
}

$(document).on('change keyup blur','#tax',function(){
	calculateTotal();
});

function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	tax = $('#tax').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount - discountAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	
}


$(document).on('change keyup blur','#additonaltax',function(){
	calculateTotal2();
});

function calculateTotal2(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	additonaltax = $('#additonaltax').val();
	if(additonaltax != '' && typeof(additonaltax) != "undefined" ){
		additonaltaxAmount = subTotal * ( parseFloat(additonaltax) /100 );
		$('#additonaltaxAmount').val(additonaltaxAmount.toFixed(2));
		total = subTotal + taxAmount  + additonaltaxAmount - discountAmount;
	}else{
		$('#additonaltaxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );

}



//datepicker
$(function () {
    $('#invoiceDate').datepicker({});
});
$(function () {
    $('#from_date').datepicker({});
});
$(function () {
    $('#expire_date').datepicker({});
});




$(document).ready(function(){
	if(typeof errorFlag !== 'undefined'){
		$('.message_div').delay(5000).slideUp();
	}
});