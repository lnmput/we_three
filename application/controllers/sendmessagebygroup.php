<?php
   class Sendmessagebygroup extends SAE_Controller{
   	    //初始化
   	    public function __construct(){
   	   	  parent::__construct();  
   	   }
   	   
   	   public function index(){
   	   	
   	   	   echo "send messaage by group";
   	   }
   	   //根据分组群发
   	   public function sendByGroup(){
   	   	 $result=sendByGroup("text");
   	   	 
   	   	 print_r($result);
   	   	
   	   }
   	   //根据用户列表群发
   	   public function sendByUser(){
   	   	
   	   	 $result=sendByUser("text");
   	   	 
   	   	 print_r($result);
   	   	
   	   }
   	   
   	   
   	   
   }