<?php
  /**
   * buybycus.php
   * 自定义套餐购买控制器
   */
class Buybycus extends SAE_Controller{
	public function __construct(){
		parent::__construct();
	}
	//载入产品购买页面
	public function index(){
		$this->load->view('buyshow/buybycus');
	}
}
?>