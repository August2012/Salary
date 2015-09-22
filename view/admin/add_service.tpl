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
			<form class="form-horizontal">
				<div class="form-group">
					<label for="ser_num" class="col-sm-2 control-label"><font color="red">*</font> 客服编号</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_num" name="ser_num" placeholder="客服编号">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_name" class="col-sm-2 control-label"><font color="red">*</font> 客服姓名</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_name" name="ser_name" placeholder="客服姓名">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_phone" class="col-sm-2 control-label"><font color="red">*</font> 手机号码</label>
					<div class="col-sm-6">
						<input type="tel" class="form-control" id="ser_phone" name="ser_phone" placeholder="手机号码">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_email" class="col-sm-2 control-label">邮箱</label>
					<div class="col-sm-6">
						<input type="email" class="form-control" id="ser_email" name="ser_email" placeholder="邮箱">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_basic" class="col-sm-2 control-label">底薪</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_basic" name="ser_basic" placeholder="底薪">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_year" class="col-sm-2 control-label">工龄工资</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_year" name="ser_year" placeholder="工龄工资">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_store" class="col-sm-2 control-label">店铺工资</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_store" name="ser_store" placeholder="店铺工资">
					</div>
				</div>
				<div class="form-group">
					<label for="ser_percent" class="col-sm-2 control-label">提成比例</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="ser_percent" name="ser_percent" placeholder="提成比例">
						<span class="text-muted">(如: 0.05)</span>
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
						<a href="javascript:void(0);" class="btn btn-primary" id="save_btn">提交</a>
				    </div>
			    </div>
			</form>
		</div>
	</div>
</div>