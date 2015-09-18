<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>客服薪资管理系统</title>

<!-- Begin styles Rendering -->
{$_s->cssHeader}
<!-- End styles Rendering -->

    <!--[if lt IE 9]>
    <script src="/public/js/html5shiv.min.js"></script>
    <script src="/public/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
           <h1 class="logo">楼口<span>12349</span></h1>
            <span class="slogan">后台管理系统</span>
            <br clear="all" />
        </div><!--left-->
        
        <div class="right">
            <div class="userinfo">
                <span>{$_s->login_user}</span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
                <div class="userdata">
                    <h4>{$_s->login_user}</h4>
                    <ul>
                        <li><a href="/user/logout">退出登录</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
    
    <!-- Begin Top-Menu Rendering -->
    <div class="vernav2 iconmenu">
        <ul>
            {$_s->leftMenu}
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div>
    <!-- End Top-Menu Rendering -->
    
    <div class="centercontent tables">
    
        <!-- Begin Content Rendering -->
        {include file="{$_s->mainContentLink}" title=foo}
        <!-- End Content Rendering -->
        
        <br clear="all" />
        
    </div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

<!-- Begin Javascript Renderring -->
{$_s->jsHeader}
<!-- End Javascript Renderring -->

</body>
</html>
