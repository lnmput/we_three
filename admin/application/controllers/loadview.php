<?php
/**
 * load.php
 * 页面加载控制器
 * 用于在加载top,left,right,三个页面
 */
 class Loadview extends SAE_Controller{
 	public function __construct(){
 		parent::__construct();
 	}
 	/*
 	 * 加载top.php
 	 *
 	 */
 	public function get_top(){
 		$this->load->view('top');
 	}
 	/*
 	 * 加载left.php
 	 *
 	 */
 	public function get_left(){
 		$this->load->view('left');
 	}
 	/*
 	 * 加载right.php
 	 * 根据点击不同的菜单载入不同的视图文件
 	 * @parma $viewname 对应菜单对应的视图文件名 
     */
 	public function get_right(){
 		
 		$viewname=$this->uri->segment(3);
 		$this->load->view($viewname);
 	}
 	
 	
 	
 }
?>