<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>登录 - 客服工资系统</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/login.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="/public/js/html5shiv.min.js"></script>
    <script src="/public/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loginpage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap wrap1" style="display:none;">
                    <p class="form-title">忘记密码</p>
                    <form id="form1" action="" class="login">
                        <input type="tel" placeholder="手机号码" name="phone"/>
                        <a href="" class="btn btn-info btn-sm">发送验证码</a>
                        <input type="tel" placeholder="手机验证码" name="phone_code"/>
                        <a href="javascript:void(0);" id="change_btn" class="btn btn-primary btn-sm btn-login" >提交</a>
                        <div class="remember-forgot">
                            <div class="row">
                                <div class="col-md-12  text-right">
                                    <a href="javascript:void(0);" class="forgot-pass" id="back_login">返回登录</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="wrap wrap2">
                    <p class="form-title">客服薪资管理</p>
                    <form id="form2" class="login">
                        <input type="text" placeholder="用户名/手机号码" name="username" />
                        <input type="password" placeholder="密码" name="password" />
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-login" id="login_btn">登录</a>
                        <div class="remember-forgot">
                            <div class="row">
                                <div class="col-md-12  text-right">
                                    <!-- <a href="javascript:void(0);" class="forgot-pass" id="forget_btn">忘记密码</a> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/public/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/public/js/localization/messages_zh.min.js"></script>
    <script type="text/javascript" src="/public/js/spin.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.loadmask.spin.js"></script>
    <script type="text/javascript" src="/public/js/bootstrap-notify.min.js"></script>
    <script>
         $(document).ready(function () {

            $('#form1').validate({
                rules: {
                    phone: "required",
                    phone_code: "required"
                },
                errorPlacement: function(error, element) {  
                    element.after(error);
                }
            });

            $('#form2').validate({
                rules: {
                    username: "required",
                    password: "required"
                },
                errorPlacement: function(error, element) {  
                    element.after(error);
                }
            });

            $('#forget_btn').click(function(event) {
                $('.wrap1').css('display', '');
                $('.wrap2').css('display', 'none');
            }); 

            $('#back_login').click(function(event) {
                $('.wrap2').css('display', '');
                $('.wrap1').css('display', 'none');
            }); 

            $('#login_btn').click(function(event) {
                
                if($('#form2').valid()) {
                    $('.loginpage').mask({
                        spinner: { lines: 10, length: 5, width: 3, radius: 10}
                    });
                    $.post('/User/auth_login', $('#form2').serialize(), function(data, textStatus, xhr) {
                        jQuery('.loginpage').unmask();
                        if(data.success) {
                            if(data.is_admin)
                                window.location.href = '/Admin/index';
                            else
                                window.location.href = '/Service/index';
                        }else{
                            $.notify({
                                title: '<strong>错误!</strong>',
                                message: data.msg
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

            $('#change_btn').click(function(event) {
                 if($('#form1').valid()) {
                    $('.loginpage').mask({
                        spinner: { lines: 10, length: 5, width: 3, radius: 10}
                    });
                    $.post('/User/change_pwd', $('#form1').serialize(), function(data, textStatus, xhr) {
                        jQuery('.loginpage').unmask();
                        if(data.success) {
                            if(data.is_admin)
                                window.location.href = '/Admin/index';
                            else
                                window.location.href = '/Service/index';
                        }else{
                            $.notify({
                                title: '<strong>错误!</strong>',
                                message: data.msg
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
        });
    </script>

</body>
</html>