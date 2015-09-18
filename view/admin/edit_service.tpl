<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li>
					<a href="/admin/index">客服管理</a>
				</li>
				<li class="active">添加客服人员</li>
			</ol>
		</div>
		<div class="col-sm-12">
			<form>
				<input type="hidden" id="ser_id" name="ser_id" value="{$ser_id}" />
				<div class="form-group">
					<label for="ser_name"><font color="red">*</font> 客服姓名</label>
					<input type="text" class="form-control" id="ser_name" name="ser_name" value="{$ser_name}" placeholder="客服姓名"></div>
				<div class="form-group">
					<label for="ser_phone"><font color="red">*</font> 手机号码</label>
					<input type="tel" class="form-control" id="ser_phone" name="ser_phone" value="{$ser_phone}" placeholder="手机号码"></div>
				<div class="form-group">
					<label for="ser_email">邮箱</label>
					<input type="tel" class="form-control" id="ser_email" name="ser_email" value="{$ser_email}" placeholder="邮箱"></div>
				<a href="javascript:void(0);" class="btn btn-primary" id="save_btn">提交</a>
			</form>
		</div>
	</div>
</div>