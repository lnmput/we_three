<?php
/**
 * 后台主页面
 * 由三个frame组成
 */
 //自定义线下地址
 //$preurl="http://www.cidemo.com/index.php/";
 //线上地址
 $preurl="http://1.wetestapp.sinaapp.com/admin/index.php/";


 
?>
<DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8" /> 
<title>XX后台管理系统</title> 
</head> 
<frameset rows="120,*"> 
<frame id="frame_top"  src="<?php echo $preurl?>loadview/get_top"  frameborder="0" /> 
<frameset cols="20%,80%"> 
<frame id="frame_left" src="<?php echo $preurl?>loadview/get_left"  frameborder="0" /> 
<frame id="frame_right" src="<?php echo $preurl?>loadview/get_right/right"  frameborder="0" /> 
</frameset> 
</frameset> 
</html> 