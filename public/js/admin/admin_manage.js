! function(a) {
	"use strict";
	a.fn.bootstrapTable.locales["zh-CN"] = {
		formatSearch: function() {
			return "搜索管理员账号"
		}
	}, a.extend(a.fn.bootstrapTable.defaults, a.fn.bootstrapTable.locales["zh-CN"])
}(jQuery);

$(document).ready(function() {
	
	$('form').validate({
		ignore: "",
		errorElement : 'span',  
        errorClass : 'help-block',
		rules: {
			admin_name: "required",
			admin_pwd: "required",
			admin_email: "required",
			admin_phone: "required"
		},
		messages: {
			admin_name: "请填写管理员账号",
			admin_pwd: "请填写管理员密码",
			admin_email: "请填写管理员邮箱",
			admin_phone: "请填写管理员手机号码"
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

	$('#ole_red').bootstrapTable({
		url: '/admin/getAdmins',
		search: true,
		pagination: true,
		sidePagination: 'server',
		showRefresh: true,
		pageSize: 10,
	    columns: [{
	        field: 'admin_name',
	        title: '管理员账号'
	    }, {
	        field: 'admin_email',
	        title: '邮箱'
	    }, {
	        field: 'admin_phone',
	        title: '手机号'
	    }, {
	    	field: 'admin_id',
	    	title: '操作',
	    	formatter: function(value, row, index) {
	    		return '<a href="javascript:void(0);" data-id="'+value+'" class="del_rec">删除</a>'
	    	}
	    }],
	    onLoadSuccess: function(data){
	    	$('.del_rec').unbind('click').click(function(event) {
	    		var admin_id = $(this).attr('data-id');

	    		bootbox.confirm('你确定删除这个账号？', function(result) {
	    			if(result) {
	    				$('body').mask({
			                spinner: { lines: 10, length: 5, width: 3, radius: 10}
			            });
			            $.post('/admin/del_admin', {admin_id: admin_id}, function(data, textStatus, xhr) {
			            	$('body').unmask();
			            	$('#ole_red').bootstrapTable('refresh');
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
			            }, 'json');
	    			}
	    		});

	    	});
	    }
	});

	$('#save_btn').click(function(event) {
		if($('form').valid()) {

			bootbox.confirm('<b><span class="text-danger">请核实填写数据！ 确认提交吗？</span></b>', function(result) {
				if(result) {
					$('body').mask({
		                spinner: { lines: 10, length: 5, width: 3, radius: 10}
		            });
					$.post('/admin/save_admin', $('form').serialize(), function(data, textStatus, xhr) {
						$('body').unmask();
		                if(data.success) {
		                    $('form')[0].reset();
							$('#ole_red').bootstrapTable('refresh');
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

		}
	});

});