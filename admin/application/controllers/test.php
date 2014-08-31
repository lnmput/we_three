<?php
/**
 * test.php
 * @author yangzie1192@163.com
 * 后台测试文件
 * @ 2014-8-23 19：40
 */
   class Test extends SAE_Controller{
   	   public function __construct(){
   	   	   parent::__construct();
   	   }
   	   public function index(){
   	   	 $this->load->view('test');
   	   }
   }
?>