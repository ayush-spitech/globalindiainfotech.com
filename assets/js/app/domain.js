//----------common module-------------
	function clearForm(form_id) {
		$(':input','#'+form_id)
		.not(':button, :submit, :reset, :hidden')
		.val('');
	}

	//----------client module-------------
	function loadClientModal(modalId,formId){
		clearForm(formId);				
		$('#'+modalId).modal('show');
	}


	function saveForm(form_id){
		if(formValidateOnly(form_id)){
			var formData=$('#'+form_id).serialize();
			$.ajax({
				url:BASE_URL+'client/ajaxAdd/',
				type:'POST',
				data:formData,
				success:function(response){
					if(response>0){	
						clearForm('form1');					
						$('#'+form_id+' #errorMessages').html('');
						$('#clientModal').modal('hide');
						getClients();
					}else{
						$('#'+form_id+' #errorMessages').html(response);
					}    
				}
			});
		}
	}			

	function getClients(){
		$.ajax({
			url:BASE_URL+'client/ajaxGetList/',
			type:'POST',
			data:{},
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success:function(response){				
				var result='<option value="">Select Client</option>';
				if(response.length>0){                     	
					$.each(response,function(index,value){
						result+='<option value="'+value.client_id+'">'+value.company_name+'</option>';
					});
				}
				$('#client_id').html(result);
			}
		});
	}

	function getClientDetails(){
		var client_id=$('#client_id').val();
		$.ajax({
			url:BASE_URL+'client/ajaxGetDetails/',
			type:'POST',
			data:{client_id:client_id},			
			dataType: "json",
			success:function(response){
				if(response!=null){
					$('#company_name').val(response.company_name);
					$('#contact_name').val(response.contact_name);
					$('#mobile').val(response.mobile);
					$('#email').val(response.email);
				}
			}
		});
	}

	//----------registrar module-------------
	function loadRegistrarModal(modalId,formId,registrarType){
		clearForm(formId);				
		$('#'+formId+' #type').val(registrarType);				
		$('#'+formId+' #type').attr('disabled','disabled');
		var type_hidden_field='<input type="hidden" name="type" id="type_new" value="'+registrarType+'" />';
		$('#'+formId).append(type_hidden_field);
		$('#'+modalId).modal('show');
	}

	function saveRegistrar(form_id){				
		if(formValidateOnly(form_id)){
			var formData=$('#'+form_id).serialize();
			$.ajax({
				url:BASE_URL+'registrar/ajaxAdd/',
				type:'POST',
				data:formData,
				success:function(response){					
					if(response>0){	
						$('#'+form_id+' #errorMessages').html('');
						$('#registrarModal').modal('hide');								
						getRegistrar(form_id);
					}else{					      		
						$('#'+form_id+' #errorMessages').html(response);
					}       
				}
			});
		}
	}


	function getRegistrar(form_id){	
		var formData=$('#'+form_id).serialize();	    
		$.ajax({
			url:BASE_URL+'registrar/ajaxGetList/',
			type:'POST',
			data:formData,			
			dataType: "json",
			success:function(response){
				var type=response.type;
				var data=response.data;
				var container='';
				var result='';
				if(type=='Domain Registrar'){
					container=$('#domain_registrar_id').html(result);	
					result='<option value="">Select Domain Registrar</option>';
				}else if(type=='Hosting Company'){
					container=$('#hosting_company_id').html(result);	
					result='<option value="">Select Hosting Company</option>';
				}else if(type=='Email Hosting Company'){
					container=$('#email_hosting_company_id').html(result);	
					result='<option value="">Select Email Hosting Company</option>';
				}				
				if(data.length>0){                     	
					$.each(data,function(index,value){
						result+='<option value="'+value.registrar_id+'">'+value.company_name+'</option>';
					});
				}
				if(container!=null && container!=''){
					container.html(result);		
				}	
			}
		});
	}

	function getDomainRegistrarDetails(){
		var domain_registrar_id=$('#domain_registrar_id').val();
		$.ajax({
			url:BASE_URL+'registrar/ajaxGetDetails/',
			type:'POST',
			data:{registrar_id:domain_registrar_id,type:'Domain Registrar'},			
			dataType: "json",
			success:function(response){
				if(response!=null){
					$('#username').val(response.username);
					$('#password').val(response.password);
					$('#hash_checksum').val(response.hash_checksum);
					$('#pin_no').val(response.pin_no);
				}
			}
		});
	}

	function getHostingRegistrarDetails(){
		var hosting_company_id=$('#hosting_company_id').val();
		$.ajax({
			url:BASE_URL+'registrar/ajaxGetDetails/',
			type:'POST',
			data:{registrar_id:hosting_company_id,type:'Hosting Company'},			
			dataType: "json",
			success:function(response){
				if(response!=null){					
					$('#pin_no').val(response.pin_no);
				}
			}
		});
	}