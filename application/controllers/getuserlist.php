<?php
   class Getuserlist extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();  
   	   }
       //加载多媒体上传页面
       public function index(){
       	 print_r(getUserList());
        }
   }
   	   