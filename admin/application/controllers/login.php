<?php
  /**
   * login.php
   * 管理员登录控制器
   */
 class Login extends SAE_Controller{
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('test_model');
 	}
 	
 	/*
 	 * 载入登录界面
 	 */
 	public function index(){
 		$this->load->view('login');
 	}
 	/*
 	 * 接收管理员登录名和密码、
 	 * 验证成功后跳转到页面
 	 */
 	public function get_admin_info(){
 		
 		
 		//验证成功，页面跳转
 		$this->load->view('main');
 	}
 	/*
 	 * 此方法用于测试数据库是否链接成功
 	 */
 	public function test(){
 		
 		$data=array(
 				"fromusername"=>"yangzie",
 				"time"=>date("Y-m-d H:i:s"),
 				"content"=>'加油加油耶'
 		);
 		$uid=$this->test_model->setData($data);
 	}
 }
?>