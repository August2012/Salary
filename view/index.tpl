<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>楼口12349 后台管理系统</title>

<!-- Begin styles Rendering -->
{$_s->cssHeader}
<!-- End styles Rendering -->


<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/public/js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="/public/css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="/public/css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
    <script src="/public/js/plugins/css3-mediaqueries.js"></script>
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


<!-- 通用方法， 检查浏览器是否支持WebSocket技术，并建立Socket链接 -->
<!-- 广播接收机，用于接受及时消息 -->
<script type="text/javascript">
    
    // jQuery(document).ready(function($) {
        
    //     window.WebSocket = window.WebSocket || window.MozWebSocket;
    //     if(!window.WebSocket) {
    //         jAlert("您的浏览器并不支持WebSocket，请更换新式浏览器访问，不然您将不能收到及时消息通知");
    //         return;
    //     }

    //     var socket = new WebSocket("ws://{$_s->websocket_url}:{$_s->websocket_port}");
    //     socket.onopen    = function(msg) { 
    //        // jAlert("Welcome - status "+this.readyState);
    //        //建立成功
    //     };

    //     socket.onmessage = function(msg) { 
    //         // 广播消息
    //        jAlert("Received: "+msg.data); 
    //     };

    //     socket.onclose   = function(msg) { 
    //         // 失去链接
    //        // jAlert("后台消息通知服务停止，代码："+this.readyState); 
    //     };

    // });

</script>

</body>
</html>
