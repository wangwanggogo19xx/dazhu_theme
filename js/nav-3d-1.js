//下面是获取可视区域的宽高 start
var box_ul = $(".box-con ul");
var nav_defualt_rect = document.getElementsByTagName("body")[0].getBoundingClientRect();

var nav_defualt_width = Math.floor(nav_defualt_rect.width * 0.88);
var nav_default_hight = Math.floor(nav_defualt_rect.height * 0.65);

var pos = [
    [Math.floor(nav_defualt_width * 0.18), Math.floor(nav_default_hight * 0.57), 0, Math.floor(nav_default_hight * 0.22)],
    [Math.floor(nav_defualt_width * 0.22), Math.floor(nav_default_hight * 0.72), Math.floor(nav_defualt_width * 0.16), Math.floor(nav_default_hight * 0.14)],
    [Math.floor(nav_defualt_width * 0.3), Math.floor(nav_default_hight), Math.floor(nav_defualt_width * 0.35), 0],
    [Math.floor(nav_defualt_width * 0.22), Math.floor(nav_default_hight * 0.72), Math.floor(nav_defualt_width * 0.62), Math.floor(nav_default_hight * 0.14)],
    [Math.floor(nav_defualt_width * 0.18), Math.floor(nav_default_hight * 0.57), Math.floor(nav_defualt_width * 0.817), Math.floor(nav_default_hight * 0.22)]
];


function nextNav() {//向右点击滑动
    box_li = $(".box-con li");
    box_li.eq(0).stop().animate({left: 0}, 500, function () {
        box_li.eq(0).css("left", Math.floor(nav_defualt_width * 0.82)).css("z-index", 10).appendTo(box_ul);
    });
    zindexs = [30, 30, 50, 30, 20];
    for (var i = 0; i < 5; i++) {

        box_li.eq(i + 1).stop().animate({
            width: pos[i][0],
            height: pos[i][1],
            left: pos[i][2],
            top: pos[i][3]
        }, 500).css("z-index", zindexs[i]);
    }
    $(nav_box_selector).eq(3).focus();

}


function prevNav() { //向右滑动

    box_li = $(".box-con li");

    $(".box-con li:last").prependTo(box_ul).css("left", 0).stop().animate({left: 0}, 500);

    var idx = 4;
    box_li.eq(idx).stop().animate({//这是右边隐藏图片
        width: pos[idx][0],
        height: pos[idx][1],
        left: 0,
        top: pos[idx][3]
    }, 500).css("z-index", 10);

    zindexs = [30, 50, 30, 20, 10];
    for (var i = 0; i < 4; i++) {
        box_li.eq(i).stop().animate({
            width: pos[i + 1][0],
            height: pos[i + 1][1],
            left: pos[i + 1][2],
            top: pos[i + 1][3]
        }, 500).css("z-index", zindexs[i]);
    }
    $(nav_box_selector).eq(2).focus();

}


$(function () {

    // console.log(JSON.stringify(nav_defualt_rect));

    // $('header h2').html(nav_defualt_width+" "+nav_default_hight);


    if (box_ul.length <= 0) {
        console.log('no nav-3d');
        return;
    }

    // console.log($("#cur_cate").val());
    var cur_cate = $.parseJSON($("#cur_cate").val());


    resetPageStyle();
    getCates();


    function resetPageStyle() {
       // $("body").css('background-image', 'url(' + template_dir_url + '/resource/image/nav-bg.jpg)')

    }

    function getCates() {

        console.log(cur_cate);
        var cate_name = cur_cate.name;
        var cate_id = cur_cate.cat_ID;
        var getUrl = ajax_prefix + 'categories';
        $.get(getUrl, {parent: cate_id}, function (data) {
            // console.log(data);
            render3dNav(data);
            $(nav_box_selector).eq(2).focus();

        })


    }

    function render3dNav(data) {

        creatLi(data, 0);//根据数据生成li
        function creatLi(cate, start) {//根据数据生成li
            var html = '';
            var navCateId = $.cookie('nav_cate_id');
            console.log(navCateId);
            if (navCateId && navCateId > 0) {
                //记录了上一次分类，现在要重排序，navCateId 要放在中间
                for (var i = start; i < cate.length; i++) {
                    if (cate[i].id === parseInt(navCateId)) {
                        console.log(i);
                        if (i === 2) {
                            //已经在中间了
                            break;
                        }
                        var tmp = cate[2];
                        cate[2] = cate[i];
                        cate[i] = tmp;
                    }
                }

            }
            for (var i = start; i < cate.length; i++) {
                var imgUrl = template_dir_url + "/resource/nav-img/" + cur_cate.name + "/" + cate[i].name + ".png";
                var cateUrl = cur_url + "/" + cate[i].name;
                //缺少在线举报，现在直接添加静态链接
//                 console.log(cate[i].name);
                if (cate[i].name === '在线举报') {
// 							console.log("kongxianmgu");
                    cateUrl = "/dazhu/department/qrcode.html";
                }
						if (cate[i].name === '空项目') {
// 							console.log("kongxianmgu");
                    cateUrl = "http://10.215.40.2:8048/up_portal/146/setportal/preview/setportal/index.htm";
                }
                //
                html += '<li class="">';
                // html += '<a href="javascript:;"></a>';
                html += '<a  href="' + cateUrl + '" ' + 'cate_id="' + cate[i].id + '"' +
                    'style="background-image: url(' + imgUrl + ');background-size: contain;background-repeat: no-repeat"></a>';


                //html += '<div style="opacity: 0; "></div>';

                // html += '<p class="b_tit"><span class="liPOpacity"></span>';
                // html += '<span class="tit">';
                // // html += '<span>' + newData[i].name + '</span>';
                // html += '</span></p></li>';
                html += '</li>';
            }
            $(".list")[0].innerHTML = html;
        }


        var prev = $(".prev")[0];
        var next = $(".next")[0];
        var box_li = $(".box-con li");
        //生成超出五个数量li位置和样式
        for (var i = 5; i < box_li.length; i++) {
            console.log(i);
            box_li.eq(i).stop().animate({
                width: Math.floor(nav_defualt_width * 0.15),
                height: Math.floor(nav_default_hight * 0.57),
                top: Math.floor(nav_default_hight * 0.22),
                left: Math.floor(nav_defualt_width * 0.82)
            }, 500).css("z-index", 10);
        }


        var zindexs = [20, 30, 50, 30, 20];
        for (var i = 0; i < 5; i++) {
            box_li.eq(i).stop().animate({
                width: pos[i][0],
                height: pos[i][1],
                left: pos[i][2],
                top: pos[i][3]
            }, 500).css("z-index", zindexs[i]);
        }
        listenNavLinkClick();

        function listenNavLinkClick() {
            $(".box .list a").click(function (e) {
                var navCateId = $(e.target).attr('cate_id');
                console.log(navCateId);
                $.cookie('nav_cate_id', navCateId, cookie_options);
            });
        }

    }


    // for (var i = 0; i < listA.length; i++) {
    //     listAclick(i);
    // }

    // function listAclick(i) {
    //     listA[i].onclick = function () {
    //         console.log(i);
    //         // letvIfraem(data.letv[i].ul);
    //
    //     }
    // }


//     function letvIfraem(ul) {
//
//         var letv3D = document.createElement("div");
//         letv3D.className = "letvIframe";
//
//         var body = document.getElementsByTagName("body")[0];
//
//         body.appendChild(letv3D);
//         letv3D.innerHTML = '<span class="letvclose cursor poA">退出</span><iframe src="' + ul + '" width="100%" height="100%"></iframe>';
//
//         var letvclose = document.querySelector(".letvIframe .letvclose");
//
//         //console.log(document.parentNode);
//         //var quit3D = document.querySelector(".div3D .quit3D");
//
//         //window.parent.document.querySelector(".div3D .quit3D").style.display ="none";//获取iframe父级的元素
//
//         letvclose.onclick = function () {
//             body.removeChild(letv3D);
// //		window.parent.document.querySelector(".div3D .quit3D").style.display ="block";
//         }
//
//
//     }


//滑动

//     isTouchDevice();
//
// //touchstart事件
//     function touchSatrtFunc(evt) {
//         try {
//             //evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
//             var touch = evt.touches[0]; //获取第一个触点
//             var x = Number(touch.pageX); //页面触点X坐标
//             var y = Number(touch.pageY); //页面触点Y坐标
//             //记录触点初始位置
//             startX = x;
//             startY = y;
//             touchchange = 0;
//             clearInterval(timer);
//         } catch (e) {
//             alert('touchSatrtFunc：' + e.message);
//         }
//     }

// //touchmove事件，这个事件无法获取坐标
//     var touchchange = 0;
//
//     function touchMoveFunc(evt) {
//         touchchange = 0;
//         try {
//             //evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
//             var touch = evt.touches[0]; //获取第一个触点
//             var x = Number(touch.pageX); //页面触点X坐标
//             var y = Number(touch.pageY); //页面触点Y坐标
//
//             console.log(x - startX);
//             if (x - startX > 70) {
//                 touchchange = 1;
//                 console.log("向you");
//
//             } else if (x - startX < -70) {
//                 console.log("向zuo");
//                 touchchange = 2;
//                 //swipeLeft();//你自己的方法
//
//             }
//         } catch (e) {
// //      alert('touchMoveFunc：' + e.message);
//         }
//     }
//
// //touchend事件
//     function touchEndFunc(evt) {
//         timer = setInterval(nextNav, 5000);
//         if (touchchange === 2) {
//             nextNav();
//         } else if (touchchange === 1) {
//             nextNav();
//         }
//
//         try {
//             //evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
//
//         } catch (e) {
//             alert('touchEndFunc：' + e.message);
//         }
//     }
//
// //绑定事件
// //     function bindEvent(box) {
// //         box.addEventListener('touchstart', touchSatrtFunc, false);
// //         box.addEventListener('touchmove', touchMoveFunc, false);
// //         box.addEventListener('touchend', touchEndFunc, false);
// //     }
//
// //判断是否支持触摸事件
//     function isTouchDevice() {
//         //document.getElementById("version").innerHTML = navigator.appVersion;
//
//         try {
//             document.createEvent("TouchEvent");
// //        alert("支持TouchEvent事件！");
//
//             var box = document.getElementsByClassName("list")[0];
//             bindEvent(box); //绑定事件
//         } catch (e) {
// //      alert("不支持TouchEvent事件！" + e.message);
//         }
//     }


});