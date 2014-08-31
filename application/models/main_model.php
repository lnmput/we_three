<?php
/**
 * main_model.php
 * 主要的模型类
 * 用来测试
 * @author 
 *
 */
  class Main_model extends CI_Model{
  
    function __construct()
    {
        parent::__construct();
    }
  	 
  	 /*
  	  * 数据插入:用户发送来的数据
  	  * 表结构：
  	  * @id
  	  * @username  fromusername
  	  * @content  内容
  	  * @time     时间
  	  * 
  	  */ 			
  	 public function setData($data){
  	 	$this->db->set($data);
  	 	$this->db->insert('test');
  	 	return $this->db->insert_id();

  	 }
  	 /*
  	  * 数据取出：用户发送来的数据
  	  */
  	 public function getData(){
  	 	$this->db->select('id,content');
  	 	$query=$this->db->get('test');
  	 	
  	 	$result=$query->result_array();
  	 	
  	 	return $result;
  	 }
  	 
  	 
  	 
  	 
  	 
  	 
  	 
  	 
  	 
  }
?>