<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

    // 从样式表获取主题名称
    $themename = wp_get_theme();
    $themename = preg_replace("/\W/", "_", strtolower($themename) );

    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = $themename;
    update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  请阅读:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


    // 将所有分类（categories）加入数组
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // 将所有标签（tags）加入数组
    $options_tags = array();
    $options_tags_obj = get_tags();
    foreach ( $options_tags_obj as $tag ) {
        $options_tags[$tag->term_id] = $tag->name;
    }


    // 将所有页面（pages）加入数组
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // 如果使用图片单选按钮, define a directory path
    $imagepath =  get_template_directory_uri() . '/images/';

    $options = array();

    $options[] = array(
        'name' => __('基本设置', 'options_framework_theme'),
        'type' => 'heading');

    // logo设置
    $options[] = array(
    'name' => __('网站LOGO设置', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为180px * 54px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_logo',
    'type' => 'upload');
    // 联系信息设置
    // 微信二维码
    $options[] = array(
    'name' => __('微信二维码', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为141px * 141px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_ewm',
    'type' => 'upload');
    // 电话
    $options[] = array(
        'name' => __('联系电话①', 'options_framework_theme'),
        'desc' => __('请输入手机号码或座机号码', 'options_framework_theme'),
        'id' => 'docyc_tel1',
        'std' => '028-85613669',
        'type' => 'text');
    $options[] = array(
        'name' => __('联系电话②', 'options_framework_theme'),
        'desc' => __('请输入手机号码或座机号码', 'options_framework_theme'),
        'id' => 'docyc_tel2',
        'std' => '18080049603',
        'type' => 'text');
    // QQ
    $options[] = array(
        'name' => __('联系QQ①', 'options_framework_theme'),
        'desc' => __('请输入QQ号', 'options_framework_theme'),
        'id' => 'docyc_qq1',
        'std' => '363076749',
        'type' => 'text');
    $options[] = array(
        'name' => __('联系QQ②', 'options_framework_theme'),
        'desc' => __('请输入QQ号', 'options_framework_theme'),
        'id' => 'docyc_qq2',
        'std' => '363076749',
        'type' => 'text');
    // 邮箱
    $options[] = array(
        'name' => __('联系邮箱', 'options_framework_theme'),
        'desc' => __('请输入邮箱', 'options_framework_theme'),
        'id' => 'docyc_mail',
        'std' => '363076749@qq.com',
        'type' => 'text');
    // 地址
    $options[] = array(
        'name' => __('联系地址', 'options_framework_theme'),
        'desc' => __('请输入详细的联系地址', 'options_framework_theme'),
        'id' => 'docyc_address',
        'std' => '四川省成都市双流区东升镇XX小区',
        'type' => 'text');
    // 网站备案号
    $options[] = array(
        'name' => __('网站备案号', 'options_framework_theme'),
        'desc' => __('请输入你的网站备案号', 'options_framework_theme'),
        'id' => 'docyc_icp',
        'std' => '网站备案号',
        'type' => 'text');

    // 首页轮播图设置
    $options[] = array(
        'name' => __('首页轮播图设置', 'options_framework_theme'),
        'type' => 'heading');

    // 轮播图设置
    // 第一张
    $options[] = array(
    'name' => __('轮播图一', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为1920px * 669px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_banner1',
    'type' => 'upload');
    $options[] = array(
        'name' => __('轮播图一H2文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner1_h2',
        'std' => '用整合的思想做设计',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图一H3文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner1_h3',
        'std' => '不只用心设计，更提供有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图一H4文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner1_h4',
        'std' => '用心设计，创造有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图一H5文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner1_h5',
        'std' => 'www.lemacy.wang',
        'type' => 'text');
    // 第二张
    $options[] = array(
    'name' => __('轮播图二', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为1920px * 669px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_banner2',
    'type' => 'upload');
    $options[] = array(
        'name' => __('轮播图二H2文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner2_h2',
        'std' => '用整合的思想做设计',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图二H3文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner2_h3',
        'std' => '不只用心设计，更提供有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图二H4文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner2_h4',
        'std' => '用心设计，创造有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图二H5文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner2_h5',
        'std' => 'www.lemacy.wang',
        'type' => 'text');
    // 第三张
    $options[] = array(
    'name' => __('轮播图三', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为1920px * 669px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_banner3',
    'type' => 'upload');
    $options[] = array(
        'name' => __('轮播图三H2文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner3_h2',
        'std' => '用整合的思想做设计',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图三H3文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner3_h3',
        'std' => '不只用心设计，更提供有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图三H4文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner3_h4',
        'std' => '用心设计，创造有价值的思路和整体服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('轮播图三H5文字', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_banner3_h5',
        'std' => 'www.lemacy.wang',
        'type' => 'text');

    // 特色导航设置
    $options[] = array(
        'name' => __('特色导航设置', 'options_framework_theme'),
        'type' => 'heading');
    // 导航图一
    $options[] = array(
    'name' => __('特色图标ICON01', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为134px * 134px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_nav_icon01',
    'type' => 'upload');
    $options[] = array(
        'name' => __('图标ICON01标题', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_nav_icon01_title',
        'std' => '高端设计服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('图标ICON01内容', 'options_framework_theme'),
        'desc' => __('请输入简要的介绍内容', 'options_framework_theme'),
        'id' => 'docyc_nav_icon01_content',
        'std' => '默认文本',
        'type' => 'textarea');
    // 导航图二
    $options[] = array(
    'name' => __('特色图标ICON02', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为134px * 134px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_nav_icon02',
    'type' => 'upload');
    $options[] = array(
        'name' => __('图标ICON02标题', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_nav_icon02_title',
        'std' => '高端设计服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('图标ICON02内容', 'options_framework_theme'),
        'desc' => __('请输入简要的介绍内容', 'options_framework_theme'),
        'id' => 'docyc_nav_icon02_content',
        'std' => '默认文本',
        'type' => 'textarea');
    // 导航图三
    $options[] = array(
    'name' => __('特色图标ICON03', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为134px * 134px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_nav_icon03',
    'type' => 'upload');
    $options[] = array(
        'name' => __('图标ICON03标题', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_nav_icon03_title',
        'std' => '高端设计服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('图标ICON03内容', 'options_framework_theme'),
        'desc' => __('请输入简要的介绍内容', 'options_framework_theme'),
        'id' => 'docyc_nav_icon03_content',
        'std' => '默认文本',
        'type' => 'textarea');
    // 导航图四
    $options[] = array(
    'name' => __('特色图标ICON04', 'options_framework_theme'),
    'desc' => __('建议图像尺寸为134px * 134px，否则可能不正常', 'options_framework_theme'),
    'id' => 'docyc_nav_icon04',
    'type' => 'upload');
    $options[] = array(
        'name' => __('图标ICON04标题', 'options_framework_theme'),
        'desc' => __('请输入你想要的文字，合适为好', 'options_framework_theme'),
        'id' => 'docyc_nav_icon04_title',
        'std' => '高端设计服务',
        'type' => 'text');
    $options[] = array(
        'name' => __('图标ICON04内容', 'options_framework_theme'),
        'desc' => __('请输入简要的介绍内容', 'options_framework_theme'),
        'id' => 'docyc_nav_icon04_content',
        'std' => '默认文本',
        'type' => 'textarea');


    $options[] = array(
        'name' => __('高级设置', 'options_framework_theme'),
        'type' => 'heading');



    return $options;
}