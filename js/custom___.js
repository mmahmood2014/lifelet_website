(function($){
	$('#collects').on('change', function(){
	var collect_id=this.value;
	
	var url=removeParam('collect_id', window.location.href);
	url=removeParam('page', url);
	
	var lastChar=url.substr(url.length - 1);
	if(lastChar=='?'){
		url=url.substring(0, url.length-1);	
	}
	
	var qs_mark=hasQueryString(url);
	if(collect_id==''){
		window.location.href=url;
	}
	else{
		url=url + qs_mark + 'collect_id=' + collect_id;		
		window.location.href=url;
	}
});
$('#keyword').on("keypress", function(e){
	if(e.keyCode==13){
		var keyword=document.getElementById('keyword').value;
		
		var url=removeParam('keyword', window.location.href);
		url=removeParam('page', url);
		
		var lastChar=url.substr(url.length - 1);
		if(lastChar=='?'){
			url=url.substring(0, url.length-1);
		}
		
		var qs_mark=hasQueryString(url);
		if(keyword==''){
			alert('a');
			window.location.href=url;
		}
		else{
			keyword=encodeURIComponent(keyword);
			url=url + qs_mark + 'keyword=' + keyword;
			window.location.href=url;
			return false;
		}
	}
});
})(jQuery);
function removeParam(key, sourceURL){
	var rtn=sourceURL.split("?")[0],
		param,
		params_arr=[],
		queryString=(sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
	if (queryString!== "") {
		params_arr=queryString.split("&");
		for (var i = params_arr.length - 1; i >= 0; i -= 1) {
			param=params_arr[i].split("=")[0];
			if(param===key){
				params_arr.splice(i, 1);
			}
		}
		rtn = rtn + "?" + params_arr.join("&");
	}
	return rtn;
}
function hasQueryString(url){
	if(url.indexOf('?') > -1){
  		return '&';
	}
	else{
		return '?';	
	}
}

/* ################################################### */
$(window).load(function(){
jQuery(document).ready(function ($) {
    $('[data-popup-target]').click(function () {
        $('html').addClass('overlay');
        var activePopup = $(this).attr('data-popup-target');
        $(activePopup).addClass('visible');
    });
    $(document).keyup(function(e){
        if (e.keyCode == 27 && $('html').hasClass('overlay')) {
            clearPopup();
        }
    });
    $('.popup-exit').click(function(){
        clearPopup();
    });
	$('.popup-clear').click(function(){
        uncheckedRadio();
    });
	$('.popup-add-to-cart').click(function(){
        addCart();
    });
    $('.popup-overlay').click(function(){
        clearPopup();
    });
    function clearPopup(){
		$('.popup.visible').addClass('transitioning').removeClass('visible');
        $('html').removeClass('overlay');
        setTimeout(function(){
            $('.popup').removeClass('transitioning');
        }, 200);
    }
	function returnDigit(str){
		var num = parseInt(str.match(/\d+/),10);
		return num;	
	}
	function checkedRadioValue(numeric){
		var radioId='';
		radioValue=$("input[name='var_opt_" + numeric + "']:checked").val();
		if(radioValue){
			$("#price_"+numeric).html("$"+radioValue);
			radioId=$("input[name='var_opt_" + numeric + "']:checked").attr('id');
		}
		else{
			$("#price_"+numeric).html('...');
		}
		ajaxCall(numeric, radioId);
	}
	function uncheckedRadio(){
		pop_id=getVisiblePopId();
		numeric=returnDigit(pop_id);
		$("input[name='var_opt_" + numeric + "']:checked").removeAttr('checked');
		ajaxRemove(numeric);
		clearPopup();
		$("#price_"+numeric).html('...');
		//$('.var_opt_'+numeric).prop('checked', false);
	}
	function getVisiblePopId(){
		pop_id=$('.popup.visible').attr('id');
		return pop_id;
	}
	function addCart(){
		pop_id=getVisiblePopId();
		numeric=returnDigit(pop_id);
		if(isVariantChecked(numeric)){
			checkedRadioValue(numeric);
			clearPopup();
		}
		else{
			alert('select variant');
			return 0;	
		}
	}
	function isVariantChecked(numeric){
		radioValue=$("input[name='var_opt_" + numeric + "']:checked").val();
		if(radioValue){
			$("#price_"+numeric).html("$"+radioValue);
			radioId=$("input[name='var_opt_" + numeric + "']:checked").attr('id');
			return radioId;
		}
		else{
			return 0;	
		}
	}
});
});
function addPrice(pid,vid){
	
	count_life_exp=$('#count_life_exp').val();
	total_life_exp=$('#total_life_exp').val();
	
	if(parseInt(count_life_exp) >= parseInt(total_life_exp)){
		alert("You can't add more than " + total_life_exp + ' products');
		return false;
	}
	else{
		$('#tr_'+pid).remove();
		price_variant=$('#var_price_'+vid).val();
		$('#price_'+pid).html('$'+price_variant);
		
		addBucket(pid, vid);
		$('#selected_options_btn_'+pid).addClass('selected_options_btn');
		
		$('button[id^="choose_material_' + pid + '"]').each(function(){
			$(this).removeClass('selected_options_btn');
		});
		$('#choose_material_'+pid+'_'+vid).addClass('selected_options_btn');
	}
	bsAlert();
	
}
function addBucket(pid, vid){
	item_count=$('[id^=tr_]').length + 1;
	$('#count_life_exp').val(item_count);
	
	
	
	var dataString='pid='+ pid + '&vid='+ vid;
	$.ajax({
		type:"POST",
		url:"server/ajax.php",
		data:dataString,
		cache:false,
		success:function(response){
			var JSONObject=JSON.parse(response);
  			order_id=JSONObject.order_id;
			p_id=JSONObject.p_id;
			p_title=JSONObject.p_title; 
			p_src=JSONObject.p_src; 
			v_id=JSONObject.v_id; 
			v_title=JSONObject.v_title; 
			v_price=JSONObject.v_price;
			total=JSONObject.total;
			bundle_name=JSONObject.bundle_name;
			number=JSONObject.number;
			
			var row='<tr id="tr_' + p_id + '"><td class="text-center"><img src="' + p_src + '" class="img_con"></td><td class="text-left">' + p_title + '</td><td class="text-center"> $' + v_price + '  </td><td class="text-right"><a class="remove_item_a" href="javascript:void(0)" onclick="removeBuckItem('+ p_id +')" title="Remove Item"><i class="far fa-trash-alt"></i></td></tr>';
			$('#bundle_name').html('(' + item_count + '/' + number + ')' + ' - ' + bundle_name);
			$('#tbl_popup').append(row);
			$('#subTotal').html('$'+total);
			$('#total_life_exp').val(number);
			$('#order_id').val(order_id);
			/*var result="";
			$.each(response, function(k, v){
    			alert(k + "  " + v);
  			});*/
		}
	});
}
function removeBuckItem(pid){
		
	var dataString='pid='+ pid + '&remove=1';
	$.ajax({
		type:"POST",
		url:"server/ajax.php",
		data:dataString,
		cache:false,
		success:function(response){
			
			
			$('#tr_'+pid).remove();
			item_count=$('[id^=tr_]').length;
			$('#count_life_exp').val(item_count);
			
			
			
			var JSONObject=JSON.parse(response);
  			bundle_name=JSONObject.bundle_name;
			number=JSONObject.number;
			price_range=JSONObject.price_range;
			total=JSONObject.total;
			
			$('#bundle_name').html(item_count + '/' + number + ' - ' + bundle_name);
			$('#subTotal').html('$'+total);
			$('#price_'+pid).html(price_range);
			$('#selected_options_btn_'+pid).removeClass('selected_options_btn');
			$('button[id^="choose_material_' + pid + '"]').each(function(){
				$(this).removeClass('selected_options_btn');
			});
			bsAlert();
		}
	});
}
function addToCart(){
	total_life_exp=$('#total_life_exp').val();
	count_life_exp=$('#count_life_exp').val();
	if(total_life_exp==count_life_exp){
		return true;
	}
	else{
		alert('To proceed, add exactly ' + total_life_exp + ' items in cart');
		return false;
	}
}
function changeState(option){
	if(option==''){
		$('#tax').val('');
		$('#tax_check').html('0.00');
		$('#shipping').val('');
		$('#ship_check').html('0.00');
		sub_total=$('#sub_total').val();
		sub_total_check=$('#sub_total_check').html();
		$('#grand_total').val(sub_total);
		$('#grand_total_check').html('$'+parseFloat(sub_total).toFixed(2));
		return false;	
	}
	stateCode=$('#province').find(':selected').attr('data-code');
	var dataString='stateCode='+ stateCode;
	$.ajax({
		type:"POST",
		url:"server/tax.php",
		data:dataString,
		cache:false,
		success:function(response){
			
			var JSONObject=JSON.parse(response);
  			tax=JSONObject.tax;
			tax_format=JSONObject.tax_format;
			code=JSONObject.code;
			$('#tax').val(tax);
			getShipping(tax);
			$('#tax_check').html(tax_format);
		}
	});
}
function getShipping(tax){
	
	if(tax==''){
		tax=0;	
	}
	subTotal=$('#sub_total').val();
	var dataString='subTotal='+subTotal+'&tax='+tax;
	$.ajax({
		type:"POST",
		url:"server/shipping.php",
		data:dataString,
		cache:false,
		async:false,
		success:function(response){
			var JSONObject=JSON.parse(response);
  			amount=JSONObject.amount;
			amount_format=JSONObject.amount_format;
			discount=JSONObject.amount;
			discount_format=JSONObject.amount_format;
			ship_cost=JSONObject.ship_cost;
			ship_cost_format=JSONObject.ship_cost_format;
			grand_total=JSONObject.grand_total;
			grand_total_format=JSONObject.grand_total_format;
			//alert(ship_cost + "  " + ship_cost_format + "  " + grand_total + "  " + grand_total_format);
			$('#ship_check').html(ship_cost_format);
			$('#shipping').val(ship_cost);
			$('#grand_total_check').html(grand_total_format);
			$('#grand_total').val(grand_total);
		}
	});
}
function bsAlert(){
	
	count_life_exp=$('#count_life_exp').val();
	total_life_exp=$('#total_life_exp').val();
	
	if(parseInt(count_life_exp)==parseInt(total_life_exp)){
		var html='<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Success!</strong> You have added '+ total_life_exp +' items. Now you can proceed!';
		$('#popup_msg').html(html);
		$('#popup_msg').removeClass('alert-warning').addClass('alert-success');
		$('#warning_bundle_msg').show();
	}
	else{
		var html='<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Warning!</strong> You have to add exactly '+ total_life_exp +' symbols for your bracelet';
		$('#popup_msg').html(html);
		$('#popup_msg').removeClass('alert-success').addClass('alert-warning');
		$('#warning_bundle_msg').hide();
	}
}