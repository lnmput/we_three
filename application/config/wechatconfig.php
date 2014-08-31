<?php 
/**
 * 自定义配置文件
 */
//自定义token值
$config['token'] = 'weixin';

//是否开启错误调试，默认开启
$config['debug']=TRUE;

//是否开启自定义菜单，默认关闭
$config['ismenu']=FALSE;
//发件人地址
$config['fromemail']='ceshi1192@163.com';

/*
 * 自定义菜单结构
 * ------------特别说明----------------
 * 目前自定义菜单最多包括3个一级菜单
 * 每个一级菜单最多包含5个二级菜单
 * 一级菜单最多4个汉字，二级菜单最多7个汉字
 * 多出来的部分将会以“...”代替
 * 请注意，创建自定义菜单后
 * 由于微信客户端缓存 需要24小时微信客户端才会展现出来
 * 建议测试时可以尝试取消关注公众账号后再次关注
 * 则可以看到创建后的效果
 * 请按照以下格式修改菜单内容 
 * ----------------------------------
 */
$config['menu']= array (
			'button' => array (
					array (
							'name' => urlencode ( "幸运女生" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "幸运转盘" ),
											'type' => 'view',
											'url' => 'http://www.yangguoqi.com' 
									),
									array (
											'name' => urlencode ( "今日名单" ),
											'type' => 'click',
											'key' => 'CLICK_EMAIL' 
									) 
							) 
					),
					array (
							'name' => urlencode ( "水果商城" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "套餐购买" ),
											'type' => 'view',
											'url' => 'http://1.wetestapp.sinaapp.com/index.php/show/buybypack' 
									),
									array (
											'name' => urlencode ( "按斤购买" ),
											'type' => 'view',
											'url' => 'http://1.wetestapp.sinaapp.com/index.php/show/buybykilo' 
									),
									array (
											'name' => urlencode ( "自己定义" ),
											'type' => 'view',
											'url' => 'http://1.wetestapp.sinaapp.com/index.php/show/buybycus'
									),
							) 
					),
					array (
							'name' => urlencode ( "关于我们" ),
							'sub_button' => array (
									array (
											'name' => urlencode ( "历史消息" ),
											'type' => 'click',
											'key' => 'CLICK_MESSAGE' 
									),
									array (
											'name' => urlencode ( "关于我们" ),
											'type' => 'click',
											'key' => 'CLICK_THREE' 
									) 
							) 
					) 
			) 
	);
/*
 * ----------------------------------------------------------------------------------------
 */

//自定义图文消息
$config['arr']=array(
		array(
				"title"=>"获得位置",
				"description"=>"我是标题一",
				"picurl"=>"http://wechat1192.qiniudn.com/1.jpg",
				"url"=>"http://1.buschat.sinaapp.com/index.php/jumplink/getUserPosition"
			
		),
		array(
				"title"=>"百度以下",
				"description"=>"我是标题二",
				"picurl"=>"http://wechat1192.qiniudn.com/2.jpg",
				"url"=>"http://www.baidu.com"
		
		),
		array(
				"title"=>"给我留言",
				"description"=>"我是标题三",
				"picurl"=>"http://wechat1192.qiniudn.com/3.jpg",
				"url"=>"http://sexapp.sinaapp.com/index.php/jumplink/gotoleavemessage"
		)
);
//可以定义多组图文消息，发送的时候加载不同的结构就可以了
$config['arr1']=array(
		array(
				"title"=>"标题一",
				"description"=>"我是标题一",
				"picurl"=>"http://wechat1192.qiniudn.com/1.jpg",
				"url"=>"http://www.baidu.com"
		
		),
		array(
				"title"=>"标题二",
				"description"=>"我是标题二",
				"picurl"=>"http://wechat1192.qiniudn.com/2.jpg",
				"url"=>"http://www.qq.com"

		),
		array(
				"title"=>"标题三",
				"description"=>"我是标题三",
				"picurl"=>"http://wechat1192.qiniudn.com/3.jpg",
				"url"=>"http://www.yangguoqi.com"
		)
);






?>