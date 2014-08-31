<?php
  /**
   * gotobuy.php
   * 用于购买水果的页面
   * @author yangzie1192@163.com
   * 
   */
  class Gotobuy extends SAE_Controller{
  	  public function __construct(){
  	  	parent::__construct();
  	  }
  	  //载入产品购买页面
  	  public function index(){
  	  	$this->load->view('gotobuy');
  	  }
  }
?>