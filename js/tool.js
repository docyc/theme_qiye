/*
* @Author: anchen
* @Date:   2018-05-31 20:00:32
* @Last Modified by:   anchen
* @Last Modified time: 2018-05-31 20:01:18
*/
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
            url:"ajax_guest.php",
            type:'GET',
            data:{'name':name,'tel':tel,'txt':txt},
            //dataType:"text",
            async:false,
            error: function(){ alert("error");},
            success: function(data){alert(data);}
        })
    });

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