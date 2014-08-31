<?php
   class Groupmanage extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();  
   	   }
       //加载分组管理页面
       public function index(){
       	
       	
          $this->load->view("group");
        }
        
        
        //创建分组
        public function makeGroup(){
        	$result=makeGroup();
        	
        	print_r($result);
        }
        //查询所有分组
        public function queryGroup(){
        	$result=queryGroup();
        	
        	print_r($result);
        }
        //查询用户所在分组
        public function queryUserGroup(){
        	$result=queryUserGroup();
        	print_r($result);
        }
        //修改分组名字
        public function modifyGroupName(){
        	
        	$result=modifyGroupName();
        	print_r($result);
        }
        //移动用户分组
        public function moveUserGroup(){
        	$result=moveUserGroup();
        	print_r($result);
        }
        
        
        
        
        
   }
   	   