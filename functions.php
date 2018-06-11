<?php

/**
 * @Author: anchen
 * @Date:   2018-05-31 18:52:13
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-06-11 12:01:42
 */

/*
 * 加载设置面板
 * 如果需要加载子主题，请使用stylesheet_directory
 * instead of template_directory
 */

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

/*
 * 这是一个如何在设置面板中加载自定义脚本的示例
 * 单击复选框时显示/隐藏文本框
 * 如果未使用到下面的内容，可以删除该项
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});

</script>
<?php
}

/*
 * 这是一个如何在设置面板中后面加入自定义内容的示例
 * 我们在右侧添加一个自定义面板
 * 如果未使用到下面的内容，可以删除该项
 */

add_action('optionsframework_after','options_after', 100);

function options_after() { ?>
	<div class="metabox-holder" id="custom-panel">
		<div class="postbox">
	    	<h3><span>DOCYC后台控制面板说明</span></h3>
	    	<div class="inside">
				<p>DOCYC后台控制面板是采用OF后台设置框架进行的二次开发。</p>

	    	</div>
	    </div>
	</div>
	<style>
		#custom-panel{
			position: relative;
			z-index: 0;
			max-width: 782px;
			background: #fff;
		}
		#custom-panel h3{
			cursor: default;
		}
	</style>
<?php }




/**
 * 检测主题更新
 */

require_once(TEMPLATEPATH . '/theme-updates/theme-update-checker.php');
$wpdaxue_update_checker = new ThemeUpdateChecker(
  '企业主题DOCYC', //主题名字
  'http://www.lemacy.wang/Themes/info.json'  //info.json 的访问地址
);

/**
 * smtp发送邮件功能
 */
add_action('phpmailer_init', 'mail_smtp');
function mail_smtp( $phpmailer ) {
    $phpmailer->FromName = '老李'; //名字
    $phpmailer->Host = 'smtp.163.com'; //smtp地址,可以到你使用的邮件设置里面找
    $phpmailer->Port = 465; //端口，一般不用修改
    $phpmailer->Username = 'll620709@163.com';  //邮件账号
    $phpmailer->Password = 'll.620709'; //邮件密码
    $phpmailer->From = 'admin@lemacy.wang';//邮件账号
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = 'ssl'; //tls or ssl （port=25留空，465为ssl）一般不用修改
    $phpmailer->IsSMTP();
}

/**
* 想要wp_title()函数实现，访问首页显示“站点标题-站点副标题”
* 如果存在翻页且正方的不是第1页，标题格式“标题-第2页”
* 当使用短横线-作为分隔符时，会将短横线转成字符实体&#8211;
* 而我们不需要字符实体，因此需要替换字符实体
* wp_title()函数显示的内容，在分隔符前后会有空格，也要去掉
*/
add_filter('wp_title', 'docyc_wp_title', 10, 2);
function docyc_wp_title($title, $sep) {
    global $paged, $page;

    //如果是feed页，返回默认标题内容
    if ( is_feed() ) {
        return $title;
    }

    // 标题中追加站点标题
    $title .= get_bloginfo( 'name' );

    // 网站首页追加站点副标题
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // 标题中显示第几页
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( '第%s页', max( $paged, $page ) );

    //去除空格，-的字符实体
    $search = array('&#8211;', ' ');
    $replace = array('-', '');
    $title = str_replace($search, $replace, $title);

    return $title;
}



/**
* 说明：
*  最新版本的wordpress引入了谷歌字体服务
*  但谷歌服务在中国并不稳定
*  导致网站打开的速度很慢
*  所以要去除谷歌字体服务
*  特别提醒：
*  方式一：安装“remove-google-fonts-references”插件即可去除谷歌字体服务【推荐】
*  方式二：将下面的代码复制到你的主题的functions.php文件中
*  注意事项#1：复制的时候，不需要复制<?php 和 ?>
*  注意事项#2：将复制的代码粘贴到你的funcions.php文件中，一定要在<?php 之间  ?>
*/
add_action( 'init', 'docyc_remove_open_sans' );        //在头部信息输出之前, 调用函数禁止加载
function docyc_remove_open_sans( ) {
    wp_deregister_style('open-sans');      //去除原名为open-sans的样式的加载
    wp_register_style('open-sans', '');      //重新注册一个名字为open-sans的样式，值为空字符串
    wp_enqueue_style('open-sans');        //将新的名为open-sans的样式插入队列
}


/**
* 加载前台脚本和样式表
* 加载主样式表style.css
*/
add_action('wp_enqueue_scripts', 'docyc_scripts');
function docyc_scripts() {
    /**
    * wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    * 功能：添加样式表
    * @Param string $handle             【必填】样式表的标识符（名称）
    * @Param string $src                        【可选】样式表的所在地址（url）
    * @Param array $deps                    【可选】加载本样式之前，必须首先加载的
    * @Param string $ver                        【可选】样式表的版本
    * @Param boolen $media              【可选】样式表指定的媒体
    * 例如：wp_enqueue_style( 'docyc-style', get_stylesheet_uri() );
    * 加载主题中的style.css文件
    */
    // wp_enqueue_style( 'docyc-style', get_template_directory_uri().'/style.css' );

    // wp_enqueue_style( 'docyc-style', get_stylesheet_uri() );

    /**
    * wp_register_script( $handle, $src, $deps, $ver, $in_footer )
    * 函数功能：加载js脚本
    * @Param string $handle             【必填】脚本的标识符（名称）
    * @Param string $src                        【可选】脚本所在地址（url）
    * @Param array $deps                    【可选】加载本脚本之前，必须首先加载的
    * @Param string $ver                        【可选】脚本的版本
    * @Param boolen $in_footer          【可选】脚本的位置，是否放在页脚
    * 函数说明，仅仅是注册和备案，并没有真正添加。
    * 真正要添加脚本，用wp_enqueue_script( ) 函数
    * 例如：wp_register_script ('docyc-lazyload', get_template_directory_uri().'/js/jquery.lazyload.js');
    * 解释：注册一个名字为'docyc-lazyload'的脚本，脚本的地址是主题文件夹下的js/juqery.lazyload.js
    */


    /**
    * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer )
    * 函数功能：加载js脚本
    * @Param string $handle             【必填】脚本的标识符（名称）
    * @Param string $src                        【可选】脚本所在地址（url）
    * @Param array $deps                    【可选】加载本脚本之前，必须首先加载的
    * @Param string $ver                        【可选】脚本的版本
    * @Param boolen $in_footer          【可选】脚本的位置，是否放在页脚
    * 例如: wp_enqueue_script ('docyc-tool', get_template_directory_uri().'/js/tool.js', array( 'jquery', 'docyc-lazyload'));
    * 解释：添加名字为‘docyc-tool’的脚本，脚本的地址为主题目录下的js/tool.js，而且在加载此脚本之前先要加载名字叫做'jquery'和'docyc-lazyload'的脚本
    */
}






/**
 * 开启文章信息和页面信息的缩略图功能
 *
 * 在调用发布的特色图像，要使用到两个函数：

1. has_post_thumbnail( $post_id )
此函数的作用是，判断某篇文章是否包含缩略图。
参数$post_id的作用，是告诉wordpress到底要判断那篇文章是否有缩略图。
一般情况下，此参数省略即可

2. the_post_thumbnail( $size, $attr )
此函数的作用是，调用缩略图。
参数$size的作用，是告诉wordpress要用什么样的尺寸来显示缩略图。
参数$size的取值，可以是如下的任何一种：
'thumbnail'               //缩略图，尺寸是你在后台中设置的大小
'medium'                     //中等图，尺寸是你在后台中设置的大小
'large'                      //大    图，尺寸是你在后台中设置的大小
'full'                           //原    图，尺寸是你上上传的原图的尺寸
array(宽度,高度)         //宽度和高度是具体的数值，但不要带单位。

参数$attr，你可以直接忽略，不需要了解它的作用、也不需要使用它。

调用图片的思路是：
判断一篇文章是否存在缩略图，如果有的话，则显示缩略图。否则的话，显示默认的缩略图。
之所以设置默认的缩略图的原因，是为了结构统一，更加的美观。
实现这样思路的具体代码是（你可以直接复制使用）：
<?php if ( has_post_thumbnail() ) : ?>
     <?php the_post_thumbnail( 'thumbnail' ); ?>
<?php else: ?>
    //显示默认图片
<?php endif; ?>
 */
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 370, 279, true );
set_post_thumbnail_size( 294, 191, true );


/**
 * 注册导航
 *
 * 完整的调用代码是（可直接复制使用，根据需要更改成员参数值）：
wp_nav_menu( array(
  'theme_location'              => '',                                  //[保留]
  'menu'                                => '',                                  //[可删]
  'container'                           => 'div',                           //[可删]
  'container_class'             => '',                                  //[可删]
  'container_id'                    => '',                                  //[可删]
  'menu_class'                  => 'menu',                      //[可删]
  'menu_id'                         => '',                                  //[可删]
  'echo'                                => true,                            //[可删]
  'fallback_cb'                     => 'wp_page_menu',      //[可删]
  'before'                              => '',                                  //[可删]
  'after'                                   => '',                                  //[可删]
  'link_before'                     => '',                                  //[可删]
  'link_after'                          => '',                                  //[可删]
  'items_wrap'                      => '<ul id="%1$s" class="%2$s">%3$s</ul>',  //[可删]
  'depth'                               => 0,                               //[可删]
  'walker'                              => ''                                   //[可删]
) );
 */
register_nav_menu( 'zhudaohang', '网站的主导航' );     //注册一个菜单
register_nav_menu( 'mdaohang', '移动导航' );   //注册第二个菜单


/**
 * 开启侧边栏功能的代码（根据需要修改参数值）
 *
 *
 register_sidebar( array(
  'name'                        => __( 'Sidebar name', 'theme_text_domain' ),
  'id'                              => 'unique-sidebar-id',
  'description'             => '',
  'class'                       => '',
  'before_widget'           => '<li id="%1$s" class="widget %2$s">',
  'after_widget'            => '</li>',
  'before_title'                => '<h2 class="widgettitle">',
  'after_title'                 => '</h2>'
) );
 *
 * 调用侧边栏时，通常会使用到两个函数：
1.  is_active_sidebar( $index )
此函数的作用，是判断参数$index所指定的侧边栏是否被激活。所谓激活，是指侧边栏中包含小工具。如果指定的侧边栏被激活，此函数的返回结果是true。否则返回false。

2.  dynamic_sidebar( $index )
此函数的做用，是调用$index指定的侧边栏。

调用侧边栏的思维：
如果$index所指定的侧边栏已经被激活了，则显示该侧边栏。否则的话，提示用户到后台添加。

实现此思维的代码：

<?php if ( is_active_sidebar( $index ) ) : ?>
     <?php dynamic_sidebar( $index ); ?>
<?php else: ?>
    //提示用户
    //或者，显示一些默认的边栏效果
<?php endif; ?>
 */
register_sidebar( array(
  'name'                        => __( 'Sidebar name', 'theme_text_domain' ),
  'id'                              => 'footer-sidebar-01',
  'description'             => '',
  'class'                       => '',
  'before_widget'           => '<dl id="%1$s" class="widget %2$s">',
  'after_widget'            => '</dl>',
  'before_title'                => '<dt class="widgettitle">',
  'after_title'                 => '</dt>'
) );




/**
* docyc_strimwidth( ) 函数
* 功能：字符串截取，并去除字符串中的html和php标签
* @Param string $str            要截取的原始字符串
* @Param int $len               截取的长度
* @Param string $suffix     字符串结尾的标识
* @Return string                    处理后的字符串
*/
function docyc_strimwidth( $str, $len, $start = 0, $suffix = '……' ) {
    $str = str_replace(array(' ', '　','&nbsp;', '\r\n'), '', strip_tags( $str ));
    if ( $len>mb_strlen( $str ) ) {
        return mb_substr( $str, $start, $len );
    }
    return mb_substr($str, $start, $len) . $suffix;
}



/**
* 数字分页函数
* 因为wordpress默认仅仅提供简单分页
* 所以要实现数字分页，需要自定义函数
* @Param int $range         数字分页的宽度
* @Return string|empty      输出分页的HTML代码
*/
function docyc_pagenavi( $range = 4 ) {
    global $paged,$wp_query;
    if ( !$max_page ) {
        $max_page = $wp_query->max_num_pages;
    }
    if( $max_page >1 ) {
        echo "<div class='fenye'>";
        if( !$paged ){
            $paged = 1;
        }
        if( $paged != 1 ) {
            echo "<a href='".get_pagenum_link(1) ."' class='extend' title='跳转到首页'>首页</a>";
        }
        previous_posts_link('上一页');
        if ( $max_page >$range ) {
            if( $paged <$range ) {
                for( $i = 1; $i <= ($range +1); $i++ ) {
                    echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";echo ">$i</a>";
                }
            }elseif($paged >= ($max_page -ceil(($range/2)))){
                for($i = $max_page -$range;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                    }
                }elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
                    for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){
                        echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";
                    }
                }
            }else{
                for($i = 1;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                }
            }
        next_posts_link('下一页');
        if($paged != $max_page){
            echo "<a href='".get_pagenum_link($max_page) ."' class='extend' title='跳转到最后一页'>尾页</a>";
        }
        echo '<span>共['.$max_page.']页</span>';
        echo "</div>\n";
    }
}






/**
* getPostViews()函数
* 功能：获取阅读数量
* 在需要显示浏览次数的位置，调用此函数
* @Param object|int $postID   文章的id
* @Return string $count       文章阅读数量
*/
function getPostViews( $postID ) {
     $count_key = 'post_views_count';
     $count = get_post_meta( $postID, $count_key, true );
     if( $count=='' ) {
         delete_post_meta( $postID, $count_key );
         add_post_meta( $postID, $count_key, '0' );
         return "0";
     }
    return $count;
 }


/**
* setPostViews()函数
* 功能：设置或更新阅读数量
* 在内容页(single.php，或page.php )调用此函数
* @Param object|int $postID   文章的id
* @Return string $count       文章阅读数量
*/
 function setPostViews( $postID ) {
     $count_key = 'post_views_count';
     $count = get_post_meta( $postID, $count_key, true );
     if( $count=='' ) {
         $count = 0;
         delete_post_meta( $postID, $count_key );
         add_post_meta( $postID, $count_key, '0' );
     } else {
         $count++;
         update_post_meta( $postID, $count_key, $count );
     }
 }





 /**
* docyc_breadcrumbs()函数
* 功能是输出面包屑导航HTML代码
* @Param null           不需要输入任何参数
* @Return string        输出HTML代码
*/
function docyc_breadcrumbs() {
    /* === OPTIONS === */
    $text['home']     = '网站首页'; // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['search']   = '"%s"的搜索结果'; // text for a search results page
    $text['tag']      = '%s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = '404错误'; // text for the 404 page

    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 0; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ' &raquo; '; // delimiter between crumbs
    $before         = '<span class="current">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $home_link    = home_url('/');
    $link_before  = '<span typeof="v:Breadcrumb">';
    $link_after   = '</span>';
    $link_attr    = ' rel="v:url" property="v:title"';
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

    } else {

        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
        if ($show_home_link == 1) {
            echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }

        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }

        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;

        } elseif ( has_post_format() && !is_singular() ) {
            echo get_post_format_string( get_post_format() );
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div><!-- .breadcrumbs -->';

    }
}



/**
*   docyc_pagesize()函数
*   作用：修正使用WP_Query时，无法正确分页
*   在此代码段，告诉wordpress每页你要显示多少篇文章
*   设置每页显示的篇数示例代码：
*   $query->set( 'posts_per_page', 1 ); 每页显示1篇文章信息
*/
function docyc_pagesize( $query ) {
    /**
        示例代码1：
        作用是，设置首页显示1篇文章
        if ( is_home() ) {
            // Display only 1 post for the original blog archive
            $query->set( 'posts_per_page', 1 );
            return;
        }
    */

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
}
add_action( 'pre_get_posts', 'docyc_pagesize', 1 );

/**
* 数字分页函数
* 因为wordpress默认仅仅提供简单分页
* 所以要实现数字分页，需要自定义函数
* @参数 $custom_query             自定义的查询对象【必填】
* @参数 $range                                数字分页的宽度
* @返回 string|empty                      输出分页的HTML代码
*/
function docyc_custom_pagenavi($custom_query, $range = 4 ) {
    global $paged;
    if ( !$max_page ) {
        $max_page = $custom_query->max_num_pages;
    }
    if( $max_page >1 ) {
        echo "<div class='fenye'>";
        if( !$paged ){
            $paged = 1;
        }
        if( $paged != 1 ) {
            echo "<a href='".get_pagenum_link(1) ."' class='extend' title='跳转到首页'>首页</a>";
        }
        previous_posts_link('上一页');
        if ( $max_page >$range ) {
            if( $paged <$range ) {
                for( $i = 1; $i <= ($range +1); $i++ ) {
                    echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";echo ">$i</a>";
                }
            }elseif($paged >= ($max_page -ceil(($range/2)))){
                for($i = $max_page -$range;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                    }
                }elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
                    for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){
                        echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";
                    }
                }
            }else{
                for($i = 1;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                }
            }
        next_posts_link('下一页');
        if($paged != $max_page){
            echo "<a href='".get_pagenum_link($max_page) ."' class='extend' title='跳转到最后一页'>尾页</a>";
        }
        echo '<span>共['.$max_page.']页</span>';
        echo "</div>\n";
    }
}




/**
*   创建一种新的分类方式的代码
*/
add_action( 'init', 'docyc_create_taxonomies', 0);
function docyc_create_taxonomies() {
    /******************************************************************************************************
    *   register_taxonomy( $taxonomy, $object_type, $args )
    *   函数描述：该函数可以增加一种新的分类方式，或者修改原有的分类方式。
    *
    *
    *******************************************************************************************************/
        /*
            @【必填参数】$taxonomy, 要增加的分类方式的名称。
            #   1. 该参数值只能包含小写字母和下划线
            #   2. 且不能与wordpress已经的定义的分类方式重名。比如，category, post_tag等。
            #   3. 除此之外，该参数值还不能与wordpress保留关键词(73个单词)重复。
            #   4. 该参数的长度不能超过32个字符
            因此，在命名新的分类方式前最好增加你的姓名作为前缀，例如docyc_book_category
        */
        $taxonomy = 'docyc_book_category';

        /*
            @【必填参数】$object_type, 该参数填写的内容是指定要给哪个信息类型添加新的分类方式。
            @【参数类型】字符串或数组，当为数组时，意思是同时为多种信息类型添加分类方式。
            @【可选的值】
                post                                        文章信息
                page                                    页面信息
                attachment                          附件信息
                revision                                修订信息
                nav_menu_item                   菜单项目
                {custom_post_type}          自定义类型的信息，填写自定义信息类型的名称
                null                                        暂不指定信息类型
        */
        $object_type = 'post';

        /*
            @【可选参数】$args,  创建新的分类方式时还需要提供更多的信息，这些信息在此参数中指定
            @【参数类型】数组，其下还包含多个成员参数。
        */
        $args = array(
            /*
                @【成员参数】【可选】labels，该参数指定分类方式的各种标记
            */
            'labels'    => array(
                        /*
                            @[成员参数]name, 分类方式的显示名称
                        */
                        'name'                          =>  'name'  ,

                        /*
                            @[成员参数]singular_name,
                        */
                        'singular_name'         =>  'singular_name',

                        /*
                            @[成员参数]menu_name,
                        */
                        'menu_name'             =>  'menu_name',

                        /*
                            @[成员参数]all_items,
                        */
                        'all_items'                 =>  'all_items',

                        /*
                            @[成员参数]edit_item,
                        */
                        'edit_item'                 =>  'edit_item',

                        /*
                            @[成员参数]view_item,
                        */
                        'view_item'                 =>  'view_item',

                        /*
                            @[成员参数]update_item,
                        */
                        'update_item'               =>  'update_item',

                        /*
                            @[成员参数]add_new_item,
                        */
                        'add_new_item'          =>  'add_new_item',

                        /*
                            @[成员参数]new_item_name,
                        */
                        'new_item_name'     =>  'new_item_name',

                        /*
                            @[成员参数]parent_item,
                        */
                        'parent_item'               =>  'parent_item',

                        /*
                            @[成员参数]parent_item_colon,
                        */
                        'parent_item_colon' =>  'parent_item_colon',

                        /*
                            @[成员参数]search_items,
                        */
                        'search_items'          =>  'search_items',

                        /*
                            @[成员参数]popular_items,
                        */
                        'popular_items'         =>  'popular_items',

                        /*
                            @[成员参数]separate_items_with_commas,
                        */
                        'separate_items_with_commas'    =>  'separate_items_with_commas',

                        /*
                            @[成员参数]add_or_remove_items,
                        */
                        'add_or_remove_items'                   =>  'add_or_remove_items',

                        /*
                            @[成员参数]choose_from_most_used,
                        */
                        'choose_from_most_used'         =>  'choose_from_most_used',

                        /*
                            @[成员参数]not_found,
                        */
                        'not_found'                                     =>  'not_found',
            ),

            /*
                @【成员参数】 public，新创建的分类方式是否可以被查询和调用
                @【可选的值】
                    true                可以直接被查询和调用
                    false           不可以直接被查询和调用
                @【默认的值】 true
            */
            'public'                                    =>  true,

            /*
                @【成员参数】 show_ui，是否提供用户界面用于管理分类方式？
                @【可选的值】
                    true                显示用户界面
                    false           不显示用户界面
                @【默认的值】 null
            */
            'show_ui'                               =>  true,

            /*
                @【成员参数】show_in_nav_menus，用户在创建菜单时是否提供分类方式的选项
                @【可选的值】
                    true            用户在创建菜单时提供新的分类方式的选项
                    false       用户在创建菜单时不提供新的分类方式的选项
                    null            和成员参数public的值相同
                @【默认的值】 null
            */
            'show_in_nav_menus'     =>  true,

            /*
                @【成员参数】show_tagcloud, 是否允许标签云小工具使用此分类方式
                @【可选的值】
                    true                允许
                    false           不允许
                    null                和show_ui参数的值相同
                @【默认的值】null
            */
            'show_tagcloud'                 =>  null,

            /*
                @【成员参数】meta_box_cb, 在发布信息时，是否使用分类项目的信息框
                @【可选的值】
                false           在发布信息时，不使用分类项目的信息框
                null                使用信息框
                @【默认的值】null
            */
            'meta_box_cb'                   =>  null,

            /*
                @【成员参数】show_admin_column, 分类方式要添加到一种信息类型，在查看该种信息类型时是否显示该分类方式？
                @【可选参数】
                true            显示
                false       不显示
                @【默认的值】false
            */
            'show_admin_column'     =>  true,

            /*
                @【成员参数】hierarchical, 分类方式是否允许层级？
                @【可选的值】
                    true                允许层级（和分类目录相似）
                    false           不允许层级（和标签类似）
                @【默认的值】 false
            */
            'hierarchical'                      =>  true,

            /*
                @【成员参数】 update_count_callback，不需要理解，推荐直接使用默认值
                @【默认的值】 ''
            */
            'update_count_callback' =>  '',

            /*
                @【成员参数】query_var, 是否让查询参数失效？
                @【可选的值】
                    $taxonomy           不失效
                    fasle                   使失效
                @【默认的值】 $taxonomy
                @【特别说明】建议使用默认值，在查询数据时很方便
            */
            'query_var'                         =>  $taxonomy,

            /*
                @【成员参数】rewrite
                @【可选的值】
                    false                   不实用固定链接即网址伪静态
                    true                        使用默认的网址伪静态规则
                    array(xxx)          自定义网址伪静态规则
            */
            'rewrite'                               =>  array(
                                                        /*
                                                            @[成员参数]slug, 伪静态网址中显示的名称
                                                            @[默认的值]$taxonomy, 也就是分类方式的名称
                                                        */
                                                        'slug'                  =>  $taxonomy,
                                                        /*
                                                            @[成员参数]with_front, 是否允许有前缀
                                                            @[默认的值]true, 允许有前缀
                                                        */
                                                        'with_front'            =>   true,
                                                        /*
                                                            @[成员参数]hierarchical, 是否允许层级化网址
                                                            @[可选的值]
                                                            true            允许
                                                            false       不允许
                                                            @[默认的值]false
                                                        */
                                                        'hierarchical'      =>  false,
                                                        /*
                                                            @[成员参数]ep_mask, 不需要理解
                                                            @[默认的值]EP_NONE
                                                        */
                                                        'ep_mask'           =>  EP_NONE,
            ),

            /*
                @【成员参数】capabilities, 分类方式的操作权限
                @【默认的值】无
            */
            'capabilities'                      =>  array(
                                                        /*
                                                            @[成员参数]manage_terms，什么权限可以管理分类方式下的项目
                                                            @[推荐的值]manage_categories，可以管理分类目录权限的用户有此权限
                                                        */
                                                        'manage_terms'      => 'manage_categories',
                                                        /*
                                                            @[成员参数]edit_terms，什么权限可以编辑分类方式下的项目
                                                            @[推荐的值]manage_categories，可以管理分类目录权限的用户有此权限
                                                        */
                                                        'edit_terms'                => 'manage_categories',
                                                        /*
                                                            @[成员参数]manage_terms，什么权限可以删除分类方式下的项目
                                                            @[推荐的值]manage_categories，可以管理分类目录权限的用户有此权限
                                                        */
                                                        'delete_terms'          => 'manage_categories',
                                                        /*
                                                            @[成员参数]manage_terms，什么权限可以分配分类方式下的项目
                                                            @[推荐的值]manage_categories，可以管理分类目录权限的用户有此权限
                                                        */
                                                        'assign_terms'      => 'manage_categories',
            ),

            /*
                @【成员参数】sort, 是否记录分类项目发布的顺序？
                @【可选的值】
                true            记录
                false       不记录
                @【默认的值】false
            */
            'sort'                                  =>  false,

            /*
                @【成员参数】_builtin,  不需要理解，使用默认值即可
                @【默认的值】false
            */
            '_builtin'                              =>  false,
        );

    register_taxonomy( $taxonomy, $object_type, $args );

} //docyc_create_taxonomies()结尾



//开启wordpress友情链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' );





/**
 * 优化 一 删除 emjo 表情的脚本
 */
remove_action( 'admin_print_scripts',   'print_emoji_detection_script');
remove_action( 'admin_print_styles',    'print_emoji_styles');
remove_action( 'wp_head',       'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles',   'print_emoji_styles');
remove_filter( 'the_content_feed',  'wp_staticize_emoji');
remove_filter( 'comment_text_rss',  'wp_staticize_emoji');
remove_filter( 'wp_mail',       'wp_staticize_emoji_for_email');

/**
 * 优化 二  删除head头部多余脚本
 */

remove_action( 'wp_head', 'feed_links_extra', 3 ); //去除评论feed
remove_action( 'wp_head', 'feed_links', 2 ); //去除文章feed
remove_action( 'wp_head', 'rsd_link' ); //针对Blog的远程离线编辑器接口
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writer接口
remove_action( 'wp_head', 'index_rel_link' ); //移除当前页面的索引
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //移除后面文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //移除最开始文章的url
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//自动生成的短链接
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); ///移除相邻文章的url
remove_action( 'wp_head', 'wp_generator' ); // 移除版本号

/**
 * 优化 三 禁用embeds功能
 */

function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    add_filter( 'embed_oembed_discover', '__return_false' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

/**
 * 优化 四 移除REST API、wp-json链接
 */
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

/**
 * 优化 五 禁止后台加载谷歌字体
 */

function wp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'wp_remove_open_sans_from_wp_core' );

/**
 * 优化 六 通过多说服务器加速Gravatar头像
 */

function mytheme_get_avatar($avatar) {
$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );

?>