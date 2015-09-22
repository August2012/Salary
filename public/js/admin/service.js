$(document).ready(function() {
	$('#wage_table').bootstrapTable({
		url: '/service/getMyWages',
		search: true,
		pagination: true,
		sidePagination: 'server',
		showRefresh: true,
		detailView: true,
		pageSize: 10,
		toolbar: "<div class='text-muted'>点击‘+’查看其他项目</div>",
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
	    }]
	});
});