<?php
/**
 * ceshi.php
 * 这是整个平台的入口文件
 * 用于接收和处理关注用户各种各样的消息
 * @author  yangzie1192@163.com
 *
 */
   class Ceshi extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();
   	   	  //加载模型
   	   	  $this->load->model('main_model');
   	   	  //接入验证  	   	  
   	   	  valid_link(); 
   	   	  //调用run方法根据不同的消息类型做出不同的回应
          $this->run();  	  
   	   }
   	   

/*
 * ---------------------------------------------------------------
 * 根据接收到的消息的类型的不同，自定义回复响应消息的类型的类型   	
 * ---------------------------------------------------------------
 */    	   
   	/*
   	 * 响应用户的文字消息
   	 */
    public function responseTextMessage($content){
    	//在此可以自定义响应文字消息，或是图文消息
    	//调用父类的方法并传入适当的参数
    	//$this->sendTextMessage($content); 
    	//在此可以自定义响应文字消息，或是图文消息
    	//调用父类的方法并传入适当的参数
    	//$this->sendTextMessage($content);
    	
    	//字符串替换，经测试手机上的中英文标点不一致
    	if(  strstr($content,'＠')){
    		//$content=trim(strtr($content,'＠','@'));
    		$content=str_replace('＠', '@', $content);
    	}
    	//对于没有@字符分割的字符串    ＠@
    	if( ! strstr($content,'@')){
    		$this->sendTextMessage($content);
    	}
    	//从用户发送的信息中分割出关键字
    	$keywords=explode("@",$content);
    	switch (trim($keywords[0])) {
    		case "位置":
    			$this->sendImageTextMessage($this->config->item("arr"));
    			break;
    		case "你好":
    			$this->sendTextMessage("都好");
    			break;
    		case "上墙":
    			//连接数据库,插入数据
    			//构造数据
    			$time=time();
    			$fromusername=$this->session->userdata('fromusername');
    			$data=array(
    					"fromusername"=>$fromusername,
    					"time"=>date("Y-m-d H:i:s"),
    					"content"=>$keywords[1]
    			);
    			$uid=$this->main_model->setData($data);
    			if($uid){
    				$this->sendTextMessage("success");
    			}else{
    				$this->sendTextMessage("failure");
    			}
    			break;
    			 
    		case "获得":
    			//从数据库中取得部分数据
    			$result=$this->main_model->getData();
    			 
    			$content=$result[0]['fromusername'];
    			 
    			$this->sendTextMessage($content);
    			 
    			break;
    		default:
    			$this->sendTextMessage($keywords[1].'wall');
    			 
    			break;
    	}
    	 
    	}
    	 
     
     /*
      * 响应用户的图片消息
      */
    public function responseImageMessage($picurl,$mediaid){
        $this->sendTextMessage($picurl);
		exit();
     	
     }
     
     /*
      * 响应用户的语音消息
      */
     public function responseVoiceMessage($mediaid,$format){
     	
         $this->sendVoiceMessage($mediaid);
     	
     }
       
     public function responseAdvancedVoiceMessage($mediaid,$format,$recognition){
       $this->sendTextMessage($recognition);
       
       
       }
     /*
      * 响应用户视频消息
      */
     public function responseVideoMessage(){
     	
     }
     /*
      * 响应用户位置消息
      */
     public function responseLocationMessage($location_x,$location_y,$scale,$label){
     	
     	$content=$location_x.'A'.$location_y.'A'.$scale.'A'.$label;
     	
     	$this->sendTextMessage($content);
     }
     /*
      * 响应用户链接消息
      */
     public function responseLinkMessage(){
     	
     }
     
     
     
/*
* 响应用户关注事件
*/
public function responseSubscribeEvent($fromusername){
     	
          $content='hi'.$fromusername.',我是小七，感谢你关注我，我们这里有最好的水果，最优质的服务，我们只为在校的大学生提供服务，接受我们的服务之前，你需要完成一下个人信息，回复“grxx”,小七引导你一步一步完成，那么现在就开始吧！么么嗒';
    
          $this->sendTextMessage($content);
     }
     
     
     
          
     /*
      * 响应用户取消关注事件，无法响应
      */
     public function responseUnsubscribeEvent(){
     
     	//sendEmail();
     }
     
     
     
     //不同菜单点击事件
     public function responseClickMenuEvent($eventKey){
     	
     	switch ($eventKey){
     		
     		case "CLICK_EMAIL":
     			
     			$flag=sendEmail("yangzie1192@163.com","测试邮件","金叶mm");
     			 
     			if($flag){
     				$content="邮件发送成功".$eventKey;
     			}else{
     				$content="邮件发送失败".$eventKey;
     			}
     			$this->sendTextMessage($content);
     			break;
     		case "CLICK_ONE":
     			$content="CLICK_ONE";
     			
     			$this->sendTextMessage($content);
     			break;
     		default:
                 
     			break;
     		
     	}
     	
     }
       
       
        //响应已经关注的用户扫描带参数二维码事件
       
         public function responseScanEvent($eventKey,$ticket){
         
            $content=$eventKey."@".$ticket;
             
            $this->sendTextMessage($content);
         }
     	
     
     //响应未知消息
     
     public function responseUnknownMessage(){
     	
     	$this->sendTextMessage("这是神马？");
     	
     }
     
     //响应用户上报地理位置事件
       public function responseLocationEvent($latitude,$longitude,$precision){
           
           $content=$latitude."#".$longitude."#".$precision;
       
           $this->sendTextMessage($content);
       }
     
     
     
     
     
//////////////////////////////////////////////////////

   	   

   	
   	   
   	   
   	   
   	   
   	   
   	   
   	   
   }
?>