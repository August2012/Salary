$(document).ready(function() {
	$('.close_btn').click(function(event) {
		var ser_id = $(this).attr('data-id');
		$.post('/admin/change_status', {ser_id: ser_id, status: 1}, function(data, textStatus, xhr) {
			$.notify({
		        title: '<strong>成功!</strong>',
		        message: '更改状态成功'
		    },{
		        type: 'success',
		        placement: {
		            from: "top",
		            align: "center"
		        }
		    });

		    setTimeout(function(){
		    	window.location.href = "/admin/index";
		    }, 1000);

		}, 'json');
	});

	$('.open_btn').click(function(event) {
		var ser_id = $(this).attr('data-id');
		$.post('/admin/change_status', {ser_id: ser_id, status: 2}, function(data, textStatus, xhr) {
			$.notify({
		        title: '<strong>成功!</strong>',
		        message: '更改状态成功'
		    },{
		        type: 'success',
		        placement: {
		            from: "top",
		            align: "center"
		        }
		    });

		    setTimeout(function(){
		    	window.location.href = "/admin/index";
		    }, 1000);

		}, 'json');
	});

});