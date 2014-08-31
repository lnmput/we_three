<?php
   class Makeqrcode extends SAE_Controller{
   	   //初始化
   	   public function __construct(){
   	   	  parent::__construct();
   	   }
   	   //调用方法，输出二维码图片
       public function index(){
          header( "Content-Type: image/jpeg" );
          $da=getQrcode();  
          echo $da;
       }
   }
   	   