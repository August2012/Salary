$(document).ready(function() {
	
	$('form').validate({
		ignore: "",
		errorElement : 'span',  
        errorClass : 'help-block',
		rules: {
			oldpassword: {
				minlength: 6,
				required: true,
			},
			password: {
				minlength: 6,
				required: true
				
			},
			repwssord: {
				minlength: 6,
				required: true,
				equalTo:"#password"
			}
		},
		messages: {
			oldpassword: {
				minlength: "密码长度至少6位",
				required: "此项必填",
			},
			password: {
				minlength: "密码长度至少6位",
				required: "此项必填"
				
			},
			repwssord: {
				minlength: "密码长度至少6位",
				required: "此项必填",
				equalTo: "两次输入的密码不一致"
			}
		},
		highlight : function(element) {  
            $(element).closest('.form-group').addClass('has-error');  
        },  
        success : function(label) {  
            label.closest('.form-group').removeClass('has-error');  
            label.remove();  
        },  
        errorPlacement : function(error, element) {  
    		element.parent('div').append(error);
        },  
        submitHandler : function(form) {  
            form.submit();  
        } 
	});

	$('#change_btn').click(function(event) {
		if($('form').valid()) {
			$('body').mask({
                spinner: { lines: 10, length: 5, width: 3, radius: 10}
            });

            $.post('/user/change_pwd', $('form').serialize(), function(data, textStatus, xhr) {
            	$('body').unmask();
            	if(data.success) {
            		$('form')[0].reset();
                    $.notify({
                        title: '<strong>成功!</strong>',
                        message: data.message
                    },{
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
            	}else{
            		$.notify({
                        title: '<strong>错误!</strong>',
                        message: data.message
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
            	}
            }, 'json');
		}
	});

});