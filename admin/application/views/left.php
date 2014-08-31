<?php
/**
 * left.php
 * 页面的左边菜单，用于显示一些基本的后台操作菜单
 */
$preurl="http://1.wetestapp.sinaapp.com/admin/index.php/";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<base href="<?php echo base_url();?>"/>
	<link rel="stylesheet" href="css/left.css" />
</head>
<body>
	<div class="content">
		<ul class="menu-one">
			<li class="firstChild">
				<div class="header">
					<span class="txt">一、用户管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看用户</li>
					<li>发送消息</li>
					<li>修改用户</li>
					<li>删除用户</li>
				</ul>
			</li>
			<li>
				<div class="header">
					<span class="txt">二、商品管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看水果</li>
					<li>增加水果	</li>
					<li>修改水果</li>
					<li>删除水果</li>
				</ul>
			</li>
			<li>
				<div class="header">
					<span class="txt">三、学校管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看学校</li>
					<li>增加学校</li>
					<li>修改学校</li>
					<li>删除学校</li>
				</ul>
			</li>
			<li>
				<div class="header">
					<span class="txt">四、订单管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看订单</li>
					<li>增加订单</li>
					<li>修改订单</li>
					<li>删除订单</li>
				</ul>
			</li>
						<li>
				<div class="header">
					<span class="txt">五、订单管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看订单</li>
					<li>增加订单</li>
					<li>修改订单</li>
					<li>删除订单</li>
				</ul>
			</li>
			<li>
				<div class="header">
					<span class="txt">六、管理员管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li class="firstChild">查看管理员</li>
					<li>增加管理员</li>
					<li>修改管理员</li>
					<li>删除管理员</li>
				</ul>
			</li>
						<li>
				<div class="header">
					<span class="txt">七、系统管理</span>
					<span class="arrow"></span>
				</div>
				<ul class="menu-two">
					<li  class="firstChild" id="sysinfo">运行环境</li>
				</ul>
			</li>
			
		</ul>
	</div>

<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var aMenuOneLi = $(".menu-one > li");
		var aMenuTwo = $(".menu-two");
		$(".menu-one > li > .header").each(function (i) {
			$(this).click(function () {
				if ($(aMenuTwo[i]).css("display") == "block") {
					$(aMenuTwo[i]).slideUp(300);
					$(aMenuOneLi[i]).removeClass("menu-show")
				} else {
					for (var j = 0; j < aMenuTwo.length; j++) {
						$(aMenuTwo[j]).slideUp(300);
						$(aMenuOneLi[j]).removeClass("menu-show");
					}
					$(aMenuTwo[i]).slideDown(300);
					$(aMenuOneLi[i]).addClass("menu-show")
				}
			});
		});
		//根据点击不同的菜单切换不同的src
		//获得frame_right
		var frame_right=window.top.document.getElementById("frame_right");
		//显示系统信息
        $("#sysinfo").click(function(){
                     frame_right.src="<?php echo $preurl ;?>loadview/get_right/sysinfo";
                });
		//


	});
</script>
</body>
</html>