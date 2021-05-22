
function saveEnquiry(form_id){
	if(formValidateOnly(form_id)){
		var form_data=$('#'+form_id).serialize();
		form_data+='&'+csrf_token_name+'=' + csrf_hash;			
		$.ajax({
			url:BASE_URL+'home_ajax/save_enquiry/',
			type:'POST',
			data:form_data,
			dataType: 'json',
			success:function(response){
				//hideMsg();				
				csrf_token_name=response.csrf_token_name;
				csrf_hash=response.csrf_hash;
				if(response.is_error==0){
					$('#'+form_id).before('<div class="msg response-success">'+response.msg+'</div><br/>');				
					$('#'+form_id)[0].reset();
				}else{
					$('#'+form_id).before('<div class="msg response-error">'+response.msg+'</div><br/>');
				}				
			}
		});
	}
}
function saveFeedback(form_id){
	if(formValidateOnly(form_id)){
		var form_data=$('#'+form_id).serialize();
		form_data+='&'+csrf_token_name+'=' + csrf_hash;			
		$.ajax({
			url:BASE_URL+'home_ajax/save_feedback/',
			type:'POST',
			data:form_data,
			dataType: 'json',
			success:function(response){
				//hideMsg();				
				csrf_token_name=response.csrf_token_name;
				csrf_hash=response.csrf_hash;
				if(response.is_error==0){
					$('#'+form_id).before('<div class="msg response-success">'+response.msg+'</div><br/>');				
					$('#'+form_id)[0].reset();
				}else{
					$('#'+form_id).before('<div class="msg response-error">'+response.msg+'</div><br/>');
				}				
			}
		});
	}
}

function jobApply(form_id){
	if(formValidateOnly(form_id)){
		var form_data = new FormData();
		$("#" + form_id).serializeArray().forEach(function (field) {
			form_data.append(field.name, field.value);
		});
		var name='resume'+form_id;
		form_data.append('resume'+form_id, $('input[name='+name+']')[0].files[0]);
		form_data.append(csrf_token_name,csrf_hash);

		$.ajax({
			url:BASE_URL+'home_ajax/job_apply/',
			type:'POST',
			data:form_data,
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,  
			success:function(response){
				hideMsg();
				csrf_token_name=response.csrf_token_name;
				csrf_hash=response.csrf_hash;
				if(response.is_error==0){
					$('#'+form_id).before('<div class="msg response-success">'+response.msg+'</div><br/>');				
					$('#'+form_id)[0].reset();
					$("#country_id option:eq(0)").attr('selected','selected');
					$("#state_id option:eq(0)").attr('selected','selected');				
					$("#city_id option:eq(0)").attr('selected','selected');
				}else{
					$('#'+form_id).before('<div class="msg response-error">'+response.msg+'</div><br/>');
				}	
			}
		});
	}
}

function loadStateHome(country_id,state_id){    
	var country=$('#'+country_id).val();   
	$.ajax({
		url:BASE_URL+'home_ajax/load_state',
		type:'POST',
		data:{country_id:country,csrf_token_name:csrf_hash},
		dataType:'json',
		success:function(response){
			csrf_token_name=response.csrf_token_name;
			csrf_hash=response.csrf_hash;
			var strHtml='<option value="0">Select State</option>';
			if(response.data.length>0){
				$.each(response.data,function(index,value){
					strHtml+='<option value="'+value.state_id+'">'+value.state_name+'</option>';
				});
			}
			$('#'+state_id).html(strHtml);
		}
	});
}

function loadCityHome(state_id,city_id){
	var state=$('#'+state_id).val();
	$.ajax({
		url:BASE_URL+'home_ajax/load_city',
		type:'POST',
		data:{state_id:state,csrf_token_name:csrf_hash},
		dataType:'json',
		success:function(response){
			csrf_token_name=response.csrf_token_name;
			csrf_hash=response.csrf_hash;
			var strHtml='<option value="0">Select City</option>';
			if(response.data.length>0){
				$.each(response.data,function(index,value){
					strHtml+='<option value="'+value.city_id+'">'+value.city_name+'</option>';
				});
			}
			$('#'+city_id).html(strHtml);
		}
	});
}

function hideMsg(){
	setTimeout(function () {
		$('.msg').hide();
	}, 6000);	
}