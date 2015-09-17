<?php

// 定义菜单
return array(

	'dashboard' => array(
		'title' => '控制台',
		'subs'	=> array(
			'admin' => '管理员设置',
			'group' => '用户组管理',
			'changepwd' => '修改密码',
		),
	),
	'order'		=> array(
		'title' => '订单管理',
		'subs'	=> array(
			'addcouponorder' => '包年券下单',
			'addorder' => '后台快速下单',
			'waitorder' => '待审核订单',
			'processorder' => '待分配订单',
			'weitpayprder' => '待支付订单',
			'finishorder' => '待回访订单',
			'completeorder' => '已完结订单',
			'complainorder' => '投诉订单',
			'allorder' => '全部订单',
		),
	),
	'finance' 	=> array(
		'title' => '财务管理',
		'subs'	=> array(
			// 'shop' => '商家报表',
			'bill' => '对账管理',
			// 'return' => '退款处理',
			// 'deposit' => '保证金管理',
		),
	),
	'marketing' => array(
		'title' => '营销管理',
		'subs'	=> array(
			'coupon' => '优惠券管理',
			'couponrule' => '优惠券类型管理',
			'yearcoupon' => '包年用户'
		),
	),
	'shop' 		=> array(
		'title' => '商家管理',
		'subs'	=> array(
			'shoplist' => '商家列表',
			'verifyshop' => '待审核商家',
			'shoptype' => '商家类型',
			'recycle' => '回收站',
			'worker' => '服务人员列表',
		),
	),
	'statistics' => array(
		'title' => '统计管理',
		'subs'	=> array(
			'shoporder' => '商家下单排名',
			'shopcomment' => '商家评价排名',
			'orderuser' => '下单用户',
			'servicetype' => '服务类型',
			'orderaddress' => '下单地址',
		),
	),
	'phone' 	=> array(
		'title' => '手机APP',
		'subs'	=> array(
			'shoporder' => '广告位管理',
		),
	),

);
