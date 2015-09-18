<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table data-toggle="table" data-pagination="true" data-page-size="10" data-search="true" data-toolbar='
			<div class="btn-group" role="group" aria-label="...">
				<a href="/admin/add_service" class="btn btn-default">添加</a>
			</div>' 
			data-locale="zh-CN"
			>
				<thead>
					<tr>
						<th>客服姓名</th>
						<th>手机号码</th>
						<th>邮箱地址</th>
						<th>添加时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$data item=item}
					<tr>
						<td>{$item.ser_name}</td>
						<td>{$item.ser_phone}</td>
						<td>{$item.ser_email}</td>
						<td>{$item.ser_time}</td>
						<td>
							{if $item.is_use eq 1}
								<font color="green">{$item.ser_use}</font>
							{else}
								<font color="red">{$item.ser_use}</font>
							{/if}</td>
						<td>
							<a data-id="{$item.ser_id}" class="btn btn-primary" href="/admin/edit_service?ser_id={$item.ser_id}">修改</a>
							&nbsp; | &nbsp;
							{if $item.is_use eq 1}
								<a href="javascript:void(0);" data-id="{$item.ser_id}" class="btn btn-danger close_btn">关闭</a>
							{else}
								<a href="javascript:void(0);" data-id="{$item.ser_id}" class="btn btn-success open_btn">激活</a>
							{/if}
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>