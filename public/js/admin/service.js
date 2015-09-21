$(document).ready(function() {
	$('#wage_table').bootstrapTable({
		url: '/service/getMyWages',
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
	    }]
	});
});