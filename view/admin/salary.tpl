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
				<input type="hidden" id="ser_name" name="ser_name" />
				<input type="hidden" id="ser_num" name="ser_num" />
				<div class="form-group col-sm-6">
					<label for="ser_id" class="col-sm-4 control-label">选择客服:</label>
					<div class="col-sm-8">
						<select name="ser_id" id="ser_id" style="width: 300px;" class="form-control">
							<option value=""></option>
							{html_options options=$sers}
						</select>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="money" class="col-sm-4 control-label">计薪日期:</label>
					<div class="col-sm-8">
						<div class="input-daterange input-group" id="datepicker">
						    <input type="text" class="input-sm form-control" name="start_date" id="start_date" placeholder="开始日期"/>
						    <span class="input-group-addon">to</span>
						    <input type="text" class="input-sm form-control" name="end_date" id="end_date" placeholder="结束日期"/>
						</div>
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label for="basic_salary" class="col-sm-4 control-label">底薪(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="basic_salary" name="basic_salary" placeholder="底薪">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="year_salary" class="col-sm-4 control-label">工龄工资(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="year_salary" name="year_salary" placeholder="工龄工资">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="store_money" class="col-sm-4 control-label">店铺奖金(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="store_money" name="store_money" placeholder="店铺奖金">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="sell_money" class="col-sm-4 control-label">销售额(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="sell_money" name="sell_money" placeholder="销售额">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="sell_percent" class="col-sm-4 control-label">提成比例:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="sell_percent" name="sell_percent" placeholder="提成比例(小数如0.05)">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="commission" class="col-sm-4 control-label">提成金额(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="commission" name="commission" readOnly="readOnly" placeholder="提成金额">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="absence_money" class="col-sm-4 control-label">请假扣款(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="absence_money" name="absence_money" placeholder="请假扣款">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="overtime_pay" class="col-sm-4 control-label">加班费(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="overtime_pay" name="overtime_pay" placeholder="加班费">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="per_bonus" class="col-sm-4 control-label">绩效奖金(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="per_bonus" name="per_bonus" placeholder="绩效奖金">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="per_debit" class="col-sm-4 control-label">绩效扣款(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="per_debit" name="per_debit" placeholder="绩效扣款">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="income_tax" class="col-sm-4 control-label">个人所得税(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="income_tax" name="income_tax" placeholder="个人所得税">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="money" class="col-sm-4 control-label">实发薪资(￥):</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="money" name="money" readOnly="readOnly" placeholder="实发薪资">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="attendance" class="col-sm-4 control-label">考勤情况:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="attendance" name="attendance" placeholder="考勤情况">
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="money" class="col-sm-4 control-label">薪资说明:</label>
					<div class="col-sm-8">
						<textarea name="detail" id="detail" class="form-control" rows="3" placeholder="薪资结构说明"></textarea>
					</div>
				</div>
				<div class="form-group col-sm-6">
				    <div class="col-sm-offset-2 col-sm-10">
				    	<a href="javascript:void(0);" class="btn btn-primary" id="save_btn">保存</a>
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