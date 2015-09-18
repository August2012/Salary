$(document).ready(function() {
	$('form').validate({
		errorElement : 'span',  
        errorClass : 'help-block',
		rules: {
			ser_name: "required",
			ser_phone: "required",
		},
		messages: {
			ser_name: {
				required: "请填写客服姓名",
			},
			ser_phone: {
				required: "请填写客服手机号码",
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

	$('#save_btn').click(function(event) {
		if($('form').valid()) {
			$('body').mask({
                spinner: { lines: 10, length: 5, width: 3, radius: 10}
            });

            $.post('/admin/add_service', $('form').serialize(), function(data, textStatus, xhr) {
            	jQuery('body').unmask();
                if(data.success) {
                    $('form')[0].reset();
                    $.notify({
                        title: '<strong>成功!</strong>',
                        message: '添加客服成功'
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