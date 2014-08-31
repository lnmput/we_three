<?php
   class Up extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();  
   	   }
       //加载多媒体上传页面
       public function index(){
          $data['accesstoken']=$this->session->userdata('accesstoken');
          $this->load->view('up',$data);
        }
   }
   	   