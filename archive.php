<?php get_header(); ?>

<div id="bd">
<div id="ban-in" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/14415956337556.jpg)">
    <div class="ban-bg"></div>
</div>
<div class="wp">
<div class="tit-i">
  	<?php if(is_category( array('fuwu','post-production','brand-promotion','advertisingdesign','event-planning') )) : ?>
    <h3>品牌服务</h3>
    <h5><span>Brand</span> OF Server</h5>
  	<?php elseif(is_category( array(5,10,11))):?>
    <h3>新闻动态</h3>
    <h5><span>NEWS</span> OF Dynamic</h5>
  	<?php elseif(is_category(3)):?>
    <h3>案例欣赏</h3>
    <h5><span>Case</span> OF Webthlink</h5>
  	<?php else:?>
  	<h3>其他</h3>
  	<?php endif; ?>
</div>
<!-- <div class="sub-nav">
    <ul>
        <li><a  href="case4_8-1">政府机关</a></li>
        <li><a  href="case4_12-1">教育培训</a></li>
        <li><a  href="case4_13-1">生物医疗</a></li>
        <li><a  href="case4_11-1">影视传媒</a></li>
        <li><a  href="case4_14-1">科技电子</a></li>
        <li><a  href="case4_9-1">汽车地产</a></li>
        <li><a  href="case4_15-1">金融投资</a></li>
        <li><a  href="case4_10-1">酒店餐饮</a></li>
        <li><a  href="case4_16-1">加工制造</a></li>
        <li><a  href="case4_1-1">集团公司</a></li>
        <li><a  href="case4_2-1">企业网站</a></li>
        <li><a  href="case4_4-1">HTML5</a></li>
        <li><a  href="case4_3-1">平台电商</a></li>
        <li><a  href="case4_5-1">移动微站</a></li>
    </ul>
</div> -->
<div class="c"></div>
<ul class="ul-case">



    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <li>
            <div class="block">
                <div class="pic">
                                <?php if ( has_post_thumbnail() ) : ?>
                                     <?php the_post_thumbnail('post-thumbnail'); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/14429937588106.jpg" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                </div>
                <div class="txt">
                    <a href="<?php the_permalink(); ?>" style="width:100%;height:100%;display:block;">
                        <b></b>
                        <div class="pad">
                            <h5>
                              <?php
                              $category = get_the_category();
                              echo $category[0]->cat_name;
                              ?>
                          	</h5>
                            <em></em>
                            <h3><?php the_title(); ?></h3>
                            <span class="more">案例详情</span>
                        </div>
                    </a>
                </div>
            </div>
        </li>
    <?php endwhile; ?>
    <?php else : ?>
        <h3>暂无内容</h3>
    <?php endif; ?>


</ul>
<div class="c"></div>
<div class="pages">

    <?php docyc_pagenavi(); ?>
    <!-- <a href='' class='a-prev'><</a> <a class='page-on'>1</a> <a href="/case4_0-2">2</a> <a href="/case4_0-3">3</a> <a href="/case4_0-4">4</a> <a href="/case4_0-5">5</a> <a class='a-next' href="/case4_0-2">></a> -->
</div>
</div>
</div>
<div class="c"></div>

<script>
    var isMobile;
    function mobileCheck(){
        isMobile  = $('#m-hd').is(':visible');
    }

    $(window).resize(function(event) {
        mobileCheck();
        $('.ul-case li').removeClass('on');
        if(isMobile){
            $('.ul-case').attr('id','ul-mobile');
        }else{
            $('.ul-case').attr('id','ul-pc');
        }
    });

    $('body').on('mouseenter mouseleave', '#ul-pc li', function(){
        $(this).toggleClass('on');
    })

    $('body').on('click', '#ul-mobile li', function(){
        $(this).toggleClass('on');
    })

    $(window).load(function(){
        $(window).trigger('resize');
    })
</script>




<?php get_footer(); ?>