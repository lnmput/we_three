<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>多媒体文件上传</title>
</head>
<body>
    <h1>up</h1>
    <form method="post" enctype="multipart/form-data" action="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=<?php echo $accesstoken  ?>&type=image">
    <input type="file" name="media" />
    <input type="submit"  value="提交"/>
    </form>
</body>
</html>