$(document).ready(function() {
	
	$('form').validate({
		ignore: "",
		errorElement : 'span',  
        errorClass : 'help-block',
		rules: {
			email: {
				email: true,
				required: true,
			},
			phone: {
				required: true
			}
		},
		messages: {
			email: {
				email: "需要正确的邮箱格式",
				required: "此项必填",
			},
			phone: {
				required: "此项必填"
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

            $.post('/user/change_info', $('form').serialize(), function(data, textStatus, xhr) {
            	$('body').unmask();
            	if(data.success) {
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
                    window.location.reload();
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