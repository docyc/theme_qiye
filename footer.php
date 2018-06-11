
<div id="fd" class="index-fd pr">
    <div class="map-bg3"></div>
    <div class="wp">
        <div class="fd-top">


                <?php if ( is_active_sidebar( 'footer-sidebar-01' ) ) : ?>
                     <?php dynamic_sidebar( 'footer-sidebar-01' ); ?>
                <?php else: ?>
                    <dl>
                    <dt>关于乐马</dt>
                    <ul class="ul-fd">
                            <li><a href="">我们是谁</a></li>
                            <li><a href="">我们服务的客户</a></li>
                            <li><a href="">我们的团队</a></li>
                            <li><a href="">客户系统</a></li>
                    </ul>
                    </dl>
                    <dl>
                    <dt>关于乐马</dt>
                    <ul class="ul-fd">
                            <li><a href="">我们是谁</a></li>
                            <li><a href="">我们服务的客户</a></li>
                            <li><a href="">我们的团队</a></li>
                            <li><a href="">客户系统</a></li>
                    </ul>
                    </dl>
                                <dl>
                    <dt>关于乐马</dt>
                    <ul class="ul-fd">
                            <li><a href="">我们是谁</a></li>
                            <li><a href="">我们服务的客户</a></li>
                            <li><a href="">我们的团队</a></li>
                            <li><a href="">客户系统</a></li>
                    </ul>
                    </dl>
                                <dl>
                    <dt>关于乐马</dt>
                    <ul class="ul-fd">
                            <li><a href="">我们是谁</a></li>
                            <li><a href="">我们服务的客户</a></li>
                            <li><a href="">我们的团队</a></li>
                            <li><a href="">客户系统</a></li>
                    </ul>
                    </dl>
                <?php endif; ?>


            <dl class="r">
                <dt>联系我们</dt>
                <dd class="pr">
                    <p><a href="" class="weixin"></a><a href="" class="sina"></a><span class="weixin-pic"><img src="<?php echo docyc_get_option('docyc_ewm'); ?>" alt=""></span></p>
                    <p><b class="tel"><?php echo docyc_get_option('docyc_tel1'); ?></b></p>
                    <h5>乐马服务热线</h5>
                </dd>
            </dl>
        </div>
    </div>
    <div class="fd-copy">
        <div class="wp">
            <p>
                <span>乐马创意设计（成都）有限公司 Copyright&copy; 2014-2018 </span><a href="//www.miibeian.gov.cn" target="_blank"><span><?php echo docyc_get_option('docyc_icp'); ?></span></a> <a href=""></a>
            </p>
        </div>
    </div>
</div>
<div class="side">
    <ul>
        <li><a href="#lianxiwomen"><div class="sidebox"><img src="<?php echo get_template_directory_uri(); ?>/images/side_icon02.png">在线咨询</div></a></li>
        <li><a href=""><div class="sidebox"><img src="<?php echo get_template_directory_uri(); ?>/images/side_icon01.png">在线咨询<!-- QQ: --></div></a></li>
        <li><a href="javascript:void(0);" ><div class="sidebox"><img src="<?php echo get_template_directory_uri(); ?>/images/side_icon03.png"><?php echo docyc_get_option('docyc_tel2'); ?></div></a></li>
    </ul>
</div>
<div class="side2">
    <ul>
        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/r_icon1.png" alt=""></a><div class="weixin"><em></em><img src="<?php echo docyc_get_option('docyc_ewm'); ?>" alt=""></div></li>
        <li><a href="javascript:goTop();" class="sidetop"><img src="<?php echo get_template_directory_uri(); ?>/images/r_icon2.png"></a></li>
    </ul>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/flexslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/banner.js"></script>
<script>
    $("#sub").click(function(e) {
        var name=$("#name").val();
        var tel=$("#tel").val();
        var txt=$("#txt").val();
        var re = /^[1][3587]\d{9}$/;
        if(name==""){
            alert("姓名不能为空");
            return false;
        }
        if(!re.test(tel)){
            alert("请输入正确的联系方式");
            return false;
        }
        if(txt==""){
            alert("请输入您的需求");
            return false;
        }



         $.ajax({
             url:"<?php echo get_template_directory_uri(); ?>/to_commtents_mail.php",
             type:'post',
             data:{'name':name,'tel':tel,'txt':txt},
             //dataType:"text",
             async:false,
             error: function(e){ alert("error\:"+e);},
             success: function(data){alert(data);}
         })
    });
</script>
<script>
    $('.ul-news-i li').hover(function(){
        $(this).toggleClass('on');
    })
    $('.ul-icon-i li').hover(function(){
        $(this).find('img:first').fadeIn(100);
        $(this).find('.pic-icon').animate({top:0});
    },function(){
        $(this).find('.pic-icon').animate({top:-134});
        $(this).find('img:first').fadeOut(100);
    })

    $('.case-img').hover(function(){
        $(this).toggleClass('on');
    })

    $('.map .btn').click(function(){
        $('.map-pop').show();
        $(this).parents('.map').addClass('map-big-i');
        var winW = $(window).width();
        var winH = $(window).height();
        console.log(winH);
        if(winW < 768){
            $('.map-pop').height($(window).height()-50-80);
            $('.map-big-i').height($(window).height()-50-80);
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        }else{

            $('.map-pop').height($(window).height()-344);
            $('.map-big-i').height($(window).height()-344);
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        }
        initMap();
    })
    $('.map .btn-down').click(function(){
        $('.map-pop').hide();
        $(this).parents('.map').removeClass('map-big-i');
        $('.map').height('107');
    })
</script>

<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=5b31afcdea6af2d7d3677ca5c1a22c46"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/map.js"></script>
<?php wp_footer(); ?>
</body>
</html>