<?php
/**
 * buybypack.php
 * 选择我们推荐的套餐购控制器
 * 
 */
class Buybypack extends SAE_Controller{
	public function __construct(){
		parent::__construct();
	}
	//载入产品购买页面
	public function index(){
		$this->load->view('buyshow/buybypack');
	}
}
?>