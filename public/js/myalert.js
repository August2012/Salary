//init
$(".Mask").css({
    opacity: 0
});

var myAlert = myAlert || {};

/*
	定义全局变量(cfg)
*/
myAlert.cfg = {
    width: $(window).width(),
    height: $(window).height()
}

/*
	定义函数(func)
*/

myAlert.func = {
    /*--
    	@黑色遮罩层
		1:显示
		!1:隐藏
    --*/
    toggleMask: function(flag) {
        $(".Mask").css({
            width: myAlert.cfg.width,
            height: myAlert.cfg.height
        });
        if (flag == 1) {
            $(".Mask").stop().animate({
                opacity: 0.4
            }, 400);
        } else {
            $(".Mask").stop().animate({
                opacity: 0
            }, 400);
        }
    },
    /*--
        @回到顶部
    --*/
    returnTop: function() {
        $('html , body').animate({
            scrollTop: 0
        }, 300);
    },
    /*--
        @提示框

        info : 要显示的内容
        type : 1 : 错误信息
               !1: 正常信息

    --*/
    notice: function(info, type,during,callback) {

        if (type == 1) {
            var demo = "<div class='notice_box' style='position:fixed;z-index:1000;background:rgba(0,0,0,0.8);color:#fff;text-align:center; line-height:30px;top:0;left:0; padding:10px 20px;max-width:280px;border-radius:10px'>" + info + "</div>";

        } else {
            var demo = "<div class='notice_box' style='position:fixed;z-index:1000;background:rgba(246,55,35,1);color:#fff;text-align:center; line-height:30px;top:0;left:0; padding:10px 20px;max-width:280px;border-radius:10px'>" + info + "</div>";
        }
        if($('.notice_box')){
            $('.notice_box').remove();
        }
        $("body").append(demo);
        myAlert.func.vhAlign(".notice_box");
        // $(".notice_box").addClass("animation");
        setTimeout(function() {
            $(".notice_box").animate({
                opacity: 0
            },  500 , function() {
                $(this).remove();
                if(callback){
                    callback;
                }
            })

        }, during || 2000);

    },
    /*--
        @水平垂直定位
    --*/
    vhAlign: function(obj) {

        var aWidth = $(obj).width();
        var aHeight = $(obj).height();
        var aLeft = (myAlert.cfg.width - aWidth) / 2 - 20;
        var aTop = (myAlert.cfg.height - aHeight) / 2 - 40;

        $(obj).css({
            left: aLeft,
            top: aTop
        });

    }
}

/*
	事件
*/

$(window).resize(function() {

    myAlert.cfg = {
        width: $(window).width(),
        height: $(window).height()
    }

})