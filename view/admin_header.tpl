<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span
                    class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0);"> 客服薪资管理系统 </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li {if $_s->act eq 'index'}class="active"{/if}>
                    <a href="/admin/index">
                        <span class="glyphicon glyphicon-home"></span>
                        客服管理
                    </a>
                </li>
                <li {if $_s->act eq 'salary'}class="active"{/if}>
                    <a href="/admin/salary">
                        <span class="glyphicon glyphicon-calendar"></span>
                        薪资发放
                    </a>
                </li>
                <li {if $_s->act eq 'admin_manage'}class="active"{/if}>
                    <a href="/admin/admin_manage">
                        <span class="glyphicon glyphicon-user"></span>
                        管理员列表
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>
                        {$_s->admin_name}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/user/change_info">
                                <span class="glyphicon glyphicon-user"></span>
                                修改个人信息
                            </a>
                        </li>
                        <li>
                            <a href="/user/change_pwd">
                                <span class="glyphicon glyphicon-cog"></span>
                                修改密码
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/user/logout">
                                <span class="glyphicon glyphicon-off"></span>
                                退出登录
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse --> </nav>
</div>