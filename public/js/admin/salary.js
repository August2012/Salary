! function(a) {
	"use strict";
	a.fn.bootstrapTable.locales["zh-CN"] = {
		formatSearch: function() {
			return "搜索客服姓名"
		}
	}, a.extend(a.fn.bootstrapTable.defaults, a.fn.bootstrapTable.locales["zh-CN"])
}(jQuery);

$(document).ready(function() {
	
	$("#ser_id").select2({
		placeholder: "请选择客服",
		allowClear: true
	}).on('change', function(e) {
		if(e.val != '') {
			$(this).closest('.form-group').removeClass('has-error'); 
			$('#ser_id-error').remove();
		}
	});;

	$('#datepicker').datepicker({
	    format: "yyyy-mm-dd",
	    todayBtn: "linked",
	    clearBtn: true,
	    language: "zh-CN",
	    orientation: "top auto",
	    todayHighlight: true
	});

	$('form').validate({
		ignore: "",
		errorElement : 'span',  
        errorClass : 'help-block',
		rules: {
			ser_id: {
				required: true
			},
			money: {
				number:true,
				required: true,
				min: 0
			},
			start_date: "required",
			end_date: "required",
			detail: "required",
		},
		messages: {
			ser_id: {
				required: "请选择客服"
			},
			money: {
				required: "请填写薪资金额"
			},
			start_date: {
				required: "请选择开始时间"
			},
			end_date: {
				required: "请选择结束时间"
			},
			detail: {
				required: "请填写薪资结构说明"
			}
		},
		highlight : function(element) {  
            $(element).closest('.form-group').addClass('has-error');  
        },  
        success : function(label) {  
            label.closest('.form-group').removeClass('has-error');  
        	if(label.attr('id') == 'start_date-error' || label.attr('id') == 'end_date-error' ) {
        		$('#start_date-error').remove();
        		$('#end_date-error').remove();
        	}
            label.remove();  
        },  
        errorPlacement : function(error, element) {  
        	if(element.attr('id') == 'start_date' || element.attr('id') == 'end_date' ) {
        		element.parent('div').after(error);
        	}else{
        		element.parent('div.col-sm-6').append(error); 
        	}
        },  
        submitHandler : function(form) {  
            form.submit();  
        }  
	});

	$('#ole_red').bootstrapTable({
		url: '/admin/getWagesRecords',
		search: true,
		pagination: true,
		sidePagination: 'server',
		showRefresh: true,
		detailView: true,
		pageSize: 10,
		toolbar: "<div class='text-muted'>点击‘+’查看薪资说明</div>",
		detailFormatter: function(index, row) {
			return '<b>薪资发放说明：</b> '+row.detail;
		},
	    columns: [{
	        field: 'add_time',
	        title: '发薪时间'
	    }, {
	        field: 'ser_name',
	        title: '客服人员'
	    }, {
	        field: 'money',
	        title: '薪资金额'
	    }, {
	        field: 'start_date',
	        title: '计薪开始时间'
	    }, {
	        field: 'end_date',
	        title: '计薪结束时间'
	    }, {
	    	field: 'id',
	    	title: '操作',
	    	formatter: function(value, row, index) {
	    		return '<a href="javascript:void(0);" data-id="'+value+'" class="del_rec">删除</a>'
	    	}
	    }],
	    onLoadSuccess: function(data){
	    	$('.del_rec').unbind('click').click(function(event) {
	    		var wage_id = $(this).attr('data-id');

	    		bootbox.confirm('你确定删除这条记录？', function(result) {
	    			if(result) {
	    				$('body').mask({
			                spinner: { lines: 10, length: 5, width: 3, radius: 10}
			            });
			            $.post('/admin/del_wage', {wage_id: wage_id}, function(data, textStatus, xhr) {
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

			bootbox.confirm('<b><span class="text-danger">提交之后不能更改, 请核实填写数据！ 确认提交吗？</span></b>', function(result) {
				if(result) {
					$('body').mask({
		                spinner: { lines: 10, length: 5, width: 3, radius: 10}
		            });
					$.post('/admin/save_wages', {
						ser_id : $('#ser_id').val(),
						money : $('#money').val(),
						start_date : $('#start_date').val(),
						end_date : $('#end_date').val(),
						detail : $('#detail').val()
					}, function(data, textStatus, xhr) {
						$('body').unmask();
		                if(data.success) {
		                    $('form')[0].reset();
							$('#ser_id').val('').trigger('change');
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