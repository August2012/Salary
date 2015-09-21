<style>
	a:link, a:hover, a:visited, a:active {
		text-decoration:none;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li>
					<a href="/admin/index">客服管理</a>
				</li>
				<li class="active">薪资发放</li>
			</ol>
		</div>
		<div class="col-sm-12">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="ser_id" class="col-sm-2 control-label">选择客服:</label>
					<div class="col-sm-6">
						<select name="ser_id" id="ser_id" style="width: 300px;" class="form-control">
							<option value=""></option>
							{html_options options=$sers}
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="money" class="col-sm-2 control-label">薪资金额(元):</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="money" name="money" placeholder="填写此次薪资">
					</div>
				</div>
				<div class="form-group">
					<label for="money" class="col-sm-2 control-label">计薪日期:</label>
					<div class="col-sm-6">
						<div class="input-daterange input-group" id="datepicker">
						    <input type="text" class="input-sm form-control" name="start_date" id="start_date" placeholder="开始日期"/>
						    <span class="input-group-addon">to</span>
						    <input type="text" class="input-sm form-control" name="end_date" id="end_date" placeholder="结束日期"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="money" class="col-sm-2 control-label">薪资说明:</label>
					<div class="col-sm-6">
						<textarea name="detail" id="detail" class="form-control" rows="3" placeholder="薪资结构说明"></textarea>
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				    	<a href="javascript:void(0);" class="btn btn-default" id="save_btn">保存</a>
				    </div>
			    </div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="active">薪资发放记录</li>
			</ol>
		</div>
		<div class="col-sm-12">
			<table id="ole_red"></table>
		</div>
	</div>
</div>