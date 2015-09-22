! function(a) {
	"use strict";
	a.fn.bootstrapTable.locales["zh-CN"] = {
		formatSearch: function() {
			return "搜索客服姓名"
		}
	}, a.extend(a.fn.bootstrapTable.defaults, a.fn.bootstrapTable.locales["zh-CN"])
}(jQuery);

$(document).ready(function() {

	function countCommission() {
		var sell_money = Number($('#sell_money').val());
		var sell_percent = Number($('#sell_percent').val());

		$('#commission').val((sell_money*sell_percent).toFixed(2));
	}

	function countMoney() {
		// 此处计算实发薪水
		var basic_salary = Number($('#basic_salary').val());
		var year_salary = Number($('#year_salary').val());
		var store_money = Number($('#store_money').val());
		var commission = Number($('#commission').val());
		var absence_money = Number($('#absence_money').val());
		var overtime_pay = Number($('#overtime_pay').val());
		var per_bonus = Number($('#per_bonus').val());
		var per_debit = Number($('#per_debit').val());
		var income_tax = Number($('#income_tax').val());

		var money = basic_salary+year_salary+store_money+commission-absence_money+overtime_pay+per_bonus-per_debit-income_tax;
		$('#money').val(money.toFixed(2));

	}

	$('#sell_money, #sell_percent').keyup(function(event) {
		countCommission();
		countMoney();
	});

	$('#basic_salary, #year_salary, #store_money, #sell_money, #sell_percent, '+
		'#commission, #absence_money, #overtime_pay, #per_bonus, #per_debit, #income_tax').keyup(function(event) {
			countCommission();
			countMoney();
		});


	$("#ser_id").select2({
		placeholder: "请选择客服",
		allowClear: true
	}).on('change', function(e) {
		if(e.val != '') {
			$(this).closest('.form-group').removeClass('has-error'); 
			$('#ser_id-error').remove();
		}

		$.get('/admin/getwage', {ser_id: e.val}, function(data) {
			if(data) {
				$('#basic_salary').val(data.ser_basic);
				$('#ser_name').val(data.ser_name);
				$('#ser_num').val(data.ser_num);
				$('#sell_percent').val(data.ser_percent);
				$('#year_salary').val(data.ser_year);
				$('#store_money').val(data.ser_store);

				countCommission();
				countMoney();
			}
		}, 'json');
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
			basic_salary: {
				required: true,
				number:true,
				min: 0
			},
			year_salary: {
				required: true,
				number:true,
				min: 0
			},
			store_money: {
				required: true,
				number:true,
				min: 0
			},
			sell_money: {
				required: true,
				number:true,
				min: 0
			},
			sell_percent: {
				required: true,
				number:true,
				max: 1,
				min: 0
			},
			commission: {
				required: true,
				number:true,
				min: 0
			},
			absence_money: {
				required: true,
				number:true,
				min: 0
			},
			overtime_pay: {
				required: true,
				number:true,
				min: 0
			},
			per_bonus: {
				required: true,
				number:true,
				min: 0
			},
			per_debit: {
				required: true,
				number:true,
				min: 0
			},
			income_tax: {
				required: true,
				number:true,
				min: 0
			},
			money: {
				required: true,
				number:true,
				min: 0
			},
			start_date: "required",
			end_date: "required",
			attendance: "required",
			detail: "required"
		},
		messages: {
			ser_id: {
				required: "请选择客服"
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
        		element.after(error);
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
		toolbar: "<div class='text-muted'>点击‘+’查看其他选项</div>",
		detailFormatter: function(index, row) {
			return '<b>销售额 ：</b> '+ row.sell_money+
			'<br /><b>提成比例：</b> '+ row.sell_percent+
			'<br /><b>考勤情况：</b> '+ row.attendance+
			'<br /><b>薪资说明：</b> '+row.detail;
		},
	    columns: [{
	        field: 'add_time',
	        title: '发薪时间'
	    }, {
	        field: 'ser_num',
	        title: '编号'
	    },{
	        field: 'ser_name',
	        title: '客服人员'
	    }, {
	        field: 'basic_salary',
	        title: '底薪'
	    }, {
	        field: 'year_salary',
	        title: '工龄工资'
	    }, {
	        field: 'store_money',
	        title: '店铺'
	    }, {
	        field: 'commission',
	        title: '提成'
	    }, {
	        field: 'absence_money',
	        title: '请假扣款'
	    }, {
	        field: 'overtime_pay',
	        title: '加班费'
	    }, {
	        field: 'per_bonus',
	        title: '绩效奖金'
	    }, {
	        field: 'per_debit',
	        title: '绩效扣款'
	    }, {
	        field: 'income_tax',
	        title: '个税'
	    }, {
	        field: 'money',
	        title: '实发薪资',
	        class: 'text-success'
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
					$.post('/admin/save_wages', $('form').serialize(), function(data, textStatus, xhr) {
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