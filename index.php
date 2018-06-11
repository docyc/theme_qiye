<?php get_header(); ?>

<div id="bd">
    <div id="banner">
        <div class="banner-bg"></div>
        <div class="flexslider">
            <ul class="slides">
                <!--
                fadeInDown 从上往下 从透明变不透明
                fadeInUp 从下往上 从透明变不透明
                fadeInLeft 从左往右 从透明变不透明
                fadeInRight 从右往左 从透明变不透明
                 -->
                <li class="s1">
                    <img src="<?php echo docyc_get_option('docyc_banner1'); ?>">
                    <div class="ban-txt">
                        <h5 data-animate="fadeInDown" class="animated"><?php echo docyc_get_option('docyc_banner1_h5'); ?></h5>
                        <h2 data-animate="fadeInRight" class="animated"><?php echo docyc_get_option('docyc_banner1_h2'); ?></h2>
                        <h3 data-animate="fadeInUp" class="animated"><?php echo docyc_get_option('docyc_banner1_h3'); ?></h3>
                    </div>
                </li>
                <li class="s2">
                    <img src="<?php echo docyc_get_option('docyc_banner2'); ?>">
                    <div class="ban-txt">
                        <h2 data-animate="fadeInLeft" class="animated"><?php echo docyc_get_option('docyc_banner2_h2'); ?></h2>
                        <h3 data-animate="fadeInDown" class="animated"><?php echo docyc_get_option('docyc_banner2_h3'); ?></h3>
                        <h4 data-animate="fadeInUp" class="animated"><?php echo docyc_get_option('docyc_banner2_h4'); ?></h4>
                        <h6 data-animate="fadeInUp" class="animated"><?php echo docyc_get_option('docyc_banner2_h5'); ?></h6>
                    </div>
                </li>
                <li class="s3">
                    <img src="<?php echo docyc_get_option('docyc_banner3'); ?>">
                    <div class="ban-txt">
                        <h2 data-animate="fadeInDown" class="animated"><?php echo docyc_get_option('docyc_banner3_h2'); ?></h2>
                        <h3 data-animate="fadeInRight" class="animated"><?php echo docyc_get_option('docyc_banner3_h3'); ?></h3>
                        <h4 data-animate="fadeInUp" class="animated"><?php echo docyc_get_option('docyc_banner3_h4'); ?></h4>
                    </div>
                </li>
            </ul>
        </div>
    </div><!-- #banner -->
    <div class="row1 fix">
        <div class="wp">
            <div class="tit-i">
                <h3>乐马服务</h3>
                <h5>LEMA <span>SERVICE</span></h5>
            </div>
            <ul class="ul-icon-i">
                <li class="li1">
                    <div class="pad">
                        <a href="">
                            <span></span>
                            <h3><?php echo docyc_get_option('docyc_nav_icon01_title'); ?></h3>
                            <em></em>
                            <p><?php echo docyc_get_option('docyc_nav_icon01_content'); ?></p>
                            <div class="pic">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m1.png" alt="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m2.png" alt="" class="pic-icon">
                            </div>
                        </a>
                    </div>
                </li>
                <li class="li2">
                    <div class="pad">
                        <a href="">
                            <span></span>
                            <h3><?php echo docyc_get_option('docyc_nav_icon02_title'); ?></h3>
                            <em></em>
                            <p><?php echo docyc_get_option('docyc_nav_icon02_content'); ?></p>
                            <div class="pic">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m3.png" alt="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m4.png" alt="" class="pic-icon">
                            </div>
                        </a>
                    </div>
                </li>
                <li class="li3">
                    <div class="pad">
                        <a href="">
                            <span></span>
                            <h3><?php echo docyc_get_option('docyc_nav_icon03_title'); ?></h3>
                            <em></em>
                            <p><?php echo docyc_get_option('docyc_nav_icon03_content'); ?></p>
                            <div class="pic">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m5.png" alt="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m6.png" alt="" class="pic-icon">
                            </div>
                        </a>
                    </div>
                </li>
                <li class="li4">
                    <div class="pad">
                        <a href="">
                            <span></span>
                            <h3><?php echo docyc_get_option('docyc_nav_icon04_title'); ?></h3>
                            <em></em>
                            <p><?php echo docyc_get_option('docyc_nav_icon04_content'); ?></p>
                            <div class="pic">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m7.png" alt="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/m8.png" alt="" class="pic-icon">
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div><!-- .row1 -->
    <div class="row2 fix">
        <div class="wp">
            <div class="tit-i">
                <h3>乐马案例</h3>
                <h5><span>LEMA</span> Of CASE</h5>
            </div>
            <div class="case-i">

                <div class="case-i-r" style="width: 100%;">
                    <ul class="ul-case-i">

                        <?php $my_query = new WP_Query( array(
                            // 'post_type'                 =>          'post',
                            'category__in'                          =>      array(6, 7, 8, 9),
                            'posts_per_page'        =>          8,
                            'paged'                     =>          get_query_var('paged')
                        ) ); ?>

                        <?php if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="pic">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                             <?php the_post_thumbnail('post-thumbnail'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/14429937588106.jpg">
                                        <?php endif; ?>
                                    </div>
                                    <div class="hover">
                                        <b></b>
                                        <div class="txt">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                            <h3><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <li>
                            <a href="case_info_4_110.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14429937588106.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>LMP品牌站官网</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_54.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14425590613750.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>连洋鞋业网站</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_52.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14423045107241.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>礼悦利达</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_49.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14423036593132.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>竣腾影业网站</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_20.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14422959085097.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>国家信息安全中心网站</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_102.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14429911135818.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>中亿行官网</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_100.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14429905909518.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>中粮集团</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="case_info_4_70.html">
                                <div class="pic"><img src="<?php echo get_template_directory_uri(); ?>/images/14429012824914.jpg"></div>
                                <div class="hover">
                                    <b></b>
                                    <div class="txt">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" alt="">
                                        <h3>十方天使基金</h3>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <?php endif; ?>

                    </ul>
                </div>
                <div class="c"></div>
                <div class="more-i"><a href="case4_0-1"></a></div>
            </div>
        </div>
    </div><!-- .row2 -->
    <div class="row3 news-bg">
        <div class="wp">
            <div class="tit-i tit-i-1">
                <h3>乐马动态</h3>
                <h5>LEMA <span>news</span></h5>
            </div>
            <ul class="ul-news-i">


                <?php $my_query = new WP_Query( array(
                            // 'post_type'                 =>          'post',
                            'category__in'                          =>      array(5, 10, 11),
                            'posts_per_page'        =>          4,
                            'paged'                     =>          get_query_var('paged')
                        ) ); ?>

                <?php if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
                <li>
                    <div class="pad">
                        <div class="txt">
                            <span><em><?php the_time("m/d"); ?></em></span>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p>
                                <?php $docyctxt = get_the_content(); ?>
                                <?php echo docyc_strimwidth( $docyctxt, 36	 ); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="more"></a>
                        </div>
                        <div class="hover">
                            <div class="img" style="overflow: hidden;">
                                <?php if ( has_post_thumbnail() ) : ?>
                                     <?php the_post_thumbnail('post-thumbnail'); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/14568143499060.jpg">
                                <?php endif; ?>
                            </div>
                            <div class="pad">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo docyc_strimwidth( $docyctxt, 36 ); ?></p>
                            </div>
                        </div>
                    </div>
                </li>

                <?php endwhile; ?>
                <?php else : ?>
                <li>
                    <div class="pad">
                        <div class="txt">
                            <span><em>03/01</em>2016</span>
                            <h3><a href="news_info_5_313.html">给设计师的网页动画设计基础</a></h3>
                            <p>随着技术的积累，网页中的动画也已经是遍地开花，它时尚，有趣，也人性化。不断涌现的新技术和新工</p>
                            <a href="news_info_5_313.html" class="more"></a>
                        </div>
                        <div class="hover">
                            <div class="img" style="background: url(<?php echo get_template_directory_uri(); ?>/images/14568143499060.jpg) 0 0 /100% 100% no-repeat;background: url(<?php echo get_template_directory_uri(); ?>/images/14568143499060.jpg) 0 0 no-repeat\9;"></div>
                            <div class="pad">
                                <h3><a href="news_info_5_313.html">给设计师的网页动画设计基础</a></h3>
                                <p>随着技术的积累，网页中的动画也已经是遍地开花，它时尚，有趣，也人性化。不断涌现的新技术和新工</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="pad">
                        <div class="txt">
                            <span><em>02/22</em>2016</span>
                            <h3><a href="news_info_5_310.html">常见的网站交互设计错误</a></h3>
                            <p>好的交互设计可以区分开有质量的网站和其他普通网站。然而，如果有明显的设计错误，它只会给予你本</p>
                            <a href="news_info_5_310.html" class="more"></a>
                        </div>
                        <div class="hover">
                            <div class="img" style="background: url(<?php echo get_template_directory_uri(); ?>/images/14561176714477.png) 0 0 /100% 100% no-repeat;background: url(<?php echo get_template_directory_uri(); ?>/images/14561176714477.png) 0 0 no-repeat\9;"></div>
                            <div class="pad">
                                <h3><a href="news_info_5_310.html">常见的网站交互设计错误</a></h3>
                                <p>好的交互设计可以区分开有质量的网站和其他普通网站。然而，如果有明显的设计错误，它只会给予你本</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="pad">
                        <div class="txt">
                            <span><em>02/15</em>2016</span>
                            <h3><a href="news_info_5_305.html">聊聊WEB网站和移动APP的六大交</a></h3>
                            <p>交互设计中的Web网站和移动App的设计，前者依托于PC的浏览器，后者则是依托于手机/平板电脑。不同的设</p>
                            <a href="news_info_5_305.html" class="more"></a>
                        </div>
                        <div class="hover">
                            <div class="img" style="background: url(<?php echo get_template_directory_uri(); ?>/images/14555070718366.jpg) 0 0 /100% 100% no-repeat;background: url(<?php echo get_template_directory_uri(); ?>/images/14555070718366.jpg) 0 0 no-repeat\9;"></div>
                            <div class="pad">
                                <h3><a href="news_info_5_305.html">聊聊WEB网站和移动APP的六大交</a></h3>
                                <p>交互设计中的Web网站和移动App的设计，前者依托于PC的浏览器，后者则是依托于手机/平板电脑。不同的设</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="pad">
                        <div class="txt">
                            <span><em>01/26</em>2016</span>
                            <h3><a href="news_info_5_299.html">设计注册/登录界面时注意的常</a></h3>
                            <p>随着时代的发展，新用户注册、登录到真正加入一个网站的过程一直在变化，从简单的信息填写发展到全</p>
                            <a href="news_info_5_299.html" class="more"></a>
                        </div>
                        <div class="hover">
                            <div class="img" style="background: url(<?php echo get_template_directory_uri(); ?>/images/14537972384811.jpg) 0 0 /100% 100% no-repeat;background: url(<?php echo get_template_directory_uri(); ?>/images/14537972384811.jpg) 0 0 no-repeat\9;"></div>
                            <div class="pad">
                                <h3><a href="news_info_5_299.html">设计注册/登录界面时注意的常</a></h3>
                                <p>随着时代的发展，新用户注册、登录到真正加入一个网站的过程一直在变化，从简单的信息填写发展到全</p>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <div class="c"></div>
            <div class="news-more"><a href="news5_0-1">load more</a></div>
        </div>
    </div><!-- .row3 -->
    <div id="lianxiwomen" class="row4 fix">
        <div class="wp">
            <div class="tit-i">
                <h3>联系我们</h3>
                <h5><span>contact</span> LEMA</h5>
            </div>
            <div class="contact-l">
                <ul class="ul-contact">
                    <li class="li1"><?php echo docyc_get_option('docyc_address'); ?></li>
                    <li class="li2"><a href="tel:<?php echo docyc_get_option('docyc_tel1'); ?>"><?php echo docyc_get_option('docyc_tel1'); ?> (咨询) / <a href="tel:<?php echo docyc_get_option('docyc_tel1'); ?>"><?php echo docyc_get_option('docyc_tel1'); ?> (售后)<br /><a href="tel:<?php echo docyc_get_option('docyc_tel2'); ?>"><?php echo docyc_get_option('docyc_tel2'); ?> (咨询)</a><br /><a href="tel:<?php echo docyc_get_option('docyc_tel2'); ?>"><?php echo docyc_get_option('docyc_tel2'); ?> (咨询)</li>
                    <li class="li3"><a href="mailto:<?php echo docyc_get_option('docyc_mail'); ?>"><?php echo docyc_get_option('docyc_mail'); ?></a></li>
                </ul>
            </div>
            <div class="contact-r">

                <form action="" class="contact-form" method="post">
                    <div class="">
                        <input type="text" class="inp l" name="name" id="name" placeholder="您的姓名">
                        <input type="text" class="inp r" name="tel" id="tel" placeholder="您的联系方式">
                    </div>
                    <textarea cols="30" rows="10" name="txt_con" id="txt"></textarea>
                    <input type="submit" value="提交您的需求" class="sub" id="sub">
                </form>
            </div>
        </div>
    </div><!-- .row4 -->

    <div class="map">
            <div class="map-s">
                <a href="javascript:void(0);" class="btn"><em></em>点击展开地图</a>
            </div>
            <div class="map-pop">
                <a href="javascript:void(0);" class="btn-down"></a>
                <div class="map-bg1"></div>
                <div class="map-bg2"></div>
                <div id="map" class="map-i" style="width:100%; height: 100%;">
                </div>
            </div>
        </div><!-- .map -->
    </div>
    <div class="c"></div>
<?php get_footer(); ?>