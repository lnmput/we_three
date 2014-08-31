<?php
define ( 'APP_ID', 'wx2fcd7d7113430e08' ); // 改成自己的APPID
define ( 'APP_SECRET', '9d7fabccfa346052053f73dfc7dad524' ); // 改成自己的APPSECRET
/*
 * 获取access_token
 */
function get_access_token() {
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . APP_ID . "&secret=" . APP_SECRET;
	$data = json_decode ( file_get_contents ( $url ), true );
	if ($data ['access_token']) {
		return $data ['access_token'];
	} else {
		return "获取access_token错误";
	}
}

/*
 * 创建菜单 @parma $access_token 
 */
function createmenu() {
	$CI =& get_instance();
	$menu=$CI->config->item('menu');
    $access_token =get_access_token();
	$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
	$jsondata = urldecode ( json_encode ( $menu ) );
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $jsondata );
	curl_exec ( $ch );
	curl_close ( $ch );
}

/*
 * 查询菜单
 * 
 * @param $access_token 已获取的ACCESS_TOKEN        	
 *
 */
function getmenu($access_token) {
	// code...
	$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=" . $access_token;
	$data = file_get_contents ( $url );
	return $data;
}
/*
 * 删除菜单
 * 
 * @param $access_token 已获取的ACCESS_TOKEN        	
 *
 */
function delmenu($access_token) {
	// code...
	$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $access_token;
	$data = json_decode ( file_get_contents ( $url ), true );
	if ($data ['errcode'] == 0) {
		// code...
		return true;
	} else {
		return false;
	}
}

/*
* 获取用户基本信息
*
* @param $access_token 已获取的ACCESS_TOKEN
* @parma $openid  用户的全网唯一id,即$fromusername,$uid
* @return array
* Array(
* [subscribe] => 1
* [openid] => o6_bmjrPTlm6_2sgVt7hMZOPfL2M
* [nickname] => Band
* [sex] => 1
* [language] => zh_CN
* [city] => 广州
* [province] => 广东
* [country] => 中国
* [headimgurl] => http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0
* [subscribe_time] => 1382694957
* [unionid] =>  o6_bmasdasdsad6_2sgVt7hMZOPfL)
*
*/
function getUserBasicInfo(){
      $CI =& get_instance();
      $openid=$CI->session->userdata('fromusername');
      $access_token =get_access_token();
      $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";    
      $data = json_decode ( file_get_contents ( $url ), true );
      return $data;
}

/*
 * 生成带参数的二维码
 * @param $access_token 已获取的ACCESS_TOKEN
 * @parma $url 微信提供的链接
 * @parma vars 需要post的json数据
 * @parma $type二维码类型，QR_SCENE为临时,QR_LIMIT_SCENE为永久
 * @parma action_info  二维码详细信息
 * @parma scene_id  场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
 * @parma expire_seconds 该二维码有效时间，以秒为单位。 最大不超过1800。
 */
function makeQrcode()
{ 
    $type="QR_SCENE";
    $scene_id=1200;
    $action_info="你哈";
    $expire_seconds=1800;
    $vars="";
    $access_token =get_access_token();
    $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token ; 
    if($type == "QR_SCENE"){
       $vars='{"expire_seconds": '.$expire_seconds.', "action_name": "QR_SCENE", '.$action_info.': {"scene": {"scene_id":'.$scene_id.'}}}';      
    }else{
       $vars='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
    }
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		return $data;
	} else {
		return false;
	}
}

/*
 * 获取生成的带参数的二维码图片
 * 
 */
function getQrcode(){
	$data=makeQrcode();
	$data=json_decode($data,TRUE);
	$url="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$data['ticket'];
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);     //超时时间
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($curl);
	curl_close($curl);
	return $data;
}

/*
 * 获取关注者列表,关注者少于10000
 * @parma access_token
 * @parma next_openid 第一个拉取的OPENID，不填默认从头开始拉取
 * @parma return array
 * Array ( [total] => 2 [count] => 2 [data] => Array ( [openid] => Array ( [0] => opIdYuIq4ryzpCNFTxP5hmvrO_FQ [1] => opIdYuLtqx_FWbZZWX-ybXhVyUlM ) ) [next_openid] => opIdYuLtqx_FWbZZWX-ybXhVyUlM )
 * @total 关注该公众账号的总用户数
 * @count 拉取的OPENID个数，最大值为10000
 * @data array 列表数据，OPENID的列表
 * @next_openid 拉取列表的后一个用户的OPENID
 */
function getUserList(){
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$access_token."&next_openid=";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 3);     //超时时间
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);
    $result=json_decode($data,TRUE);  
    return $result;
}

/*
 * 创建分组
 * @parma access_token
 * @parma $vars name 分组名字
 * @return array
 * @Array ( [group] => Array ( [id] => 100 [name] => test ) )
 * @id 分组id，由微信分配
 * @name 分组名字，UTF8编码
 */
function makeGroup(){
	
	$access_token =get_access_token();
	$vars='{"group":{"name":"test"}}';
	$url="https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}
/*
 * 查询所有分组
 * @parma access_token
 * @return array 二维数组
 * Array ( [groups] => Array ( [0] => Array ( [id] => 0 [name] => 未分组 [count] => 2 ) [1] => Array ( [id] => 1 [name] => 黑名单 [count] => 0 ) [2] => Array ( [id] => 2 [name] => 星标组 [count] => 0 ) [3] => Array ( [id] => 100 [name] => test [count] => 0 )  ) )
 * 
 */
function queryGroup(){
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/groups/get?access_token=".$access_token;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);     //超时时间
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($curl);
	curl_close($curl);
	$result=json_decode($data,TRUE);
	return $result;
}
/*
 * 查询用户所在分组
 * @parma openid 
 * @return array
 * Array ( [groupid] => 0 )
 */
function queryUserGroup(){
	$vars='{"openid":"opIdYuLtqx_FWbZZWX-ybXhVyUlM"}';
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}
/*
 * 修改分组名
 * @parma $access_token
 * @parma id 分组id
 * @name 分组名字
 * @return Array ( [errcode] => 0 [errmsg] => ok )
 */
function modifyGroupName(){
	$vars='{"group":{"id":101,"name":"金叶"}}';
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/groups/update?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}
/*
 * 移动用户分组
 * @parma $access_token
 * @parma openid 用户id
 * @parma to_groupid 分组id
 * @return Array ( [errcode] => 0 [errmsg] => ok )
 */
function moveUserGroup(){
	$vars='{"openid":"opIdYuLtqx_FWbZZWX-ybXhVyUlM","to_groupid":101}';
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}
/**
 * -----------------------------------
 * ----------高级群发接口---------------
 * -----------------------------------
 */
/*
 * 第一步上传图文素材,如果发图文消息
 * 参数	是否必须	说明
 *Articles	 是  图文消息，一个图文消息支持1到10条图文
 *thumb_media_id	 是	 图文消息缩略图的media_id，可以在基础支持-上传多媒体文件接口中获得
 *author	 否	 图文消息的作者
 *title	 是	 图文消息的标题
 *content_source_url	 否	 在图文消息页面点击“阅读原文”后的页面
 *content	 是	 图文消息页面的内容，支持HTML标签
 *digest	 否	 图文消息的描述
 *show_cover_pic	 否	 是否显示封面，1为显示，0为不显示
 *@
 *@return array
 *@Array ( [type] => news [media_id] => CsEf3ldqkAYJAU6EJeIkStVDSvffUJ54vqbThMgplD-VJXXof6ctX5fI6-aYyUiQ
 *@[created_at] => 1391857799 )
 *@parma media_id	 媒体文件/图文消息上传后获取的唯一标识
 *@parma created_at	 媒体文件上传时间
 */
function uploadMatter(){
	$vars='{
   "articles": [
		 {
             "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
             "author":"xxx",
			 "title":"Happy Day",
			 "content_source_url":"www.qq.com",
			 "content":"content",
			 "digest":"digest",
             "show_cover_pic":"1"
		 },
		 {
             "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
             "author":"xxx",
			 "title":"Happy Day",
			 "content_source_url":"www.qq.com",
			 "content":"content",
			 "digest":"digest",
             "show_cover_pic":"0"
		 }
   ]
}';
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}



/*
 * 根据分组进行群发
 * @mathod post
 * @parma group_id	  是	 群发到的分组的group_id
 * @parma mpnews	  是	 用于设定即将发送的图文消息
 * @parma media_id	  是	 用于群发的消息的media_id
 * @parma msgtype	  是	 群发的消息类型，图文消息为mpnews，文本消息为text，语音为voice，音乐为music，图片为image，视频为video
 * @parma content    是    文本消息内容
 * @return array
 * @Array ( [errcode] => 0 [errmsg] => send job submission success [msg_id] => 34182 )
 */
function sendByGroup($messagetype){
	
	switch ($messagetype){
		case "text" :
			//文本消息
			$vars='{
	                    "filter":{
	                            "group_id":"2"
	                             },
	                      "text":{
	                             "content":"CONTENT"
	                             },
	                    "msgtype":"text"
                       	}';
			break;
		case "image" :
			//图片消息
			$vars='{
	                     "filter":{
	                             "group_id":"2"
	                              },
                    	 "image":{
	                  "media_id":"123dsdajkasd231jhksad"
	                             },
	                    "msgtype":"image"
	                    }';
			break;
		case "voice" :
			//语音消息
			$vars='{
	                     "filter":{
	                              "group_id":"2"
	                              },
	                      "voice":{
	                   "media_id":"123dsdajkasd231jhksad"
	                              },
	                    "msgtype":"voice"
	                     }';
			break;
		case "video" :
			//暂时不做
			break;
		case "news" :
			//图文消息
			$vars='{
	                         "filter":{
	                                 "group_id":"2"
	                                  },
	                         "mpnews":{
	                       "media_id":"123dsdajkasd231jhksad"
	                                  },
	                        "msgtype":"mpnews"
	                                 }';
			break;
		default:
			break;
	}
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}




/*
 * 根据OpenID列表群发
 * @method post
 * @parma $messagetype 需要发送的消息类型
 * @parma $vars 消息的json结构
 * @parma touser 数组结构，接收消息者的open_id
 * @parma content  发送的文本消息内容
 * @parma media_id 图文消息的可以由uploadMatter()这个函数获得，其他类型的有高级接口上传多媒体得到
 * @return array
 * @Array ( [errcode] => 0 [errmsg] => send job submission success [msg_id] => 34182 )
 */
function sendByUser($messagetype){
	switch ($messagetype){
		case "text" :
			$vars='{
                  "touser": [
                            "opIdYuIq4ryzpCNFTxP5hmvrO_FQ",
					        "opIdYuLtqx_FWbZZWX-ybXhVyUlM" 
					        ], 
				 "msgtype": "text", 
				    "text": {
					         "content": "hello from boxer."
	                        }
                   }';
			break;
		case "image" :
			$vars='{
                  "touser":[
                          "opIdYuIq4ryzpCNFTxP5hmvrO_FQ",
					      "opIdYuLtqx_FWbZZWX-ybXhVyUlM" 
                          ],
                  "image":{
                         "media_id":"BTgN0opcW3Y5zV_ZebbsD3NFKRWf6cb7OPswPi9Q83fOJHK2P67dzxn11Cp7THat"
                          },
               "msgtype":"image"
                  }';
			break;
		case "voice" :
			$vars='{
                  "touser":[
                          "opIdYuIq4ryzpCNFTxP5hmvrO_FQ",
					      "opIdYuLtqx_FWbZZWX-ybXhVyUlM" 
                           ],
                   "voice":{
                           "media_id":"mLxl6paC7z2Tl-NJT64yzJve8T9c8u9K2x-Ai6Ujd4lIH9IBuF6-2r66mamn_gIT"
                           },
                  "msgtype":"voice"
                  }';
			break;
		case "video" :
			
			break;
		case "news" :
		    $vars='{
                  "touser":[
                          "opIdYuIq4ryzpCNFTxP5hmvrO_FQ",
					      "opIdYuLtqx_FWbZZWX-ybXhVyUlM" 
                           ],
                  "mpnews":{
                "media_id":"123dsdajkasd231jhksad"
                           },
                 "msgtype":"mpnews"
                  }';
			break;
		default:
			
			break;
	}
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$access_token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}

/*
 * 删除群发
 * @method post
 * @暂不实现
 */
function deleteMessageByGroup(){
	
	$access_token =get_access_token();
	$url="https://api.weixin.qq.com//cgi-bin/message/mass/delete?access_token=ACCESS_TOKEN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	$data = curl_exec($ch);
	curl_close($ch);
	if ($data) {
		$result=json_decode($data,TRUE);
		return $result;
	} else {
		return false;
	}
}


























?>