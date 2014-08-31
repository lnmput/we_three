<?php 
 class SAE_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//$this->load->config('wechatconf'); //自定义配置文件

		$this->load->database(); //初始化数据库链接
		$this->load->library('session'); //初始化session类

		$this->load->helper('url'); //加载URL辅助类
		$this->load->helper('form'); //加载form辅助类
		//$this->load->helper('common'); //公共辅助函数库

		//关闭浏览器，PHP进程依然执行
		ignore_user_abort(true);
		//SAE不支持
		//set_time_limit(0);
		//设置时区
		date_default_timezone_set('PRC');//'Asia/Shanghai' 亚洲/上海 ;
		header("Content-type: text/html; charset=utf-8");
	}
}
?>