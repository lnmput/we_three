<?php
/**
 * buybykilo.php
 * 按斤购买控制器
 * 
 */
class Buybykilo extends SAE_Controller{
	public function __construct(){
		parent::__construct();
	}
	//载入产品购买页面
	public function index(){
		$this->load->view('buyshow/buybykilo');
	}
}
?>