<?php
require_once("../Functions/PDOConn.php");
require_once("../Functions/PublicFunc.php");

if(isset($_POST) && $_POST){
  $UserName=$_POST['UserName'];
  $RealName=$_POST['RealName'];
  $Phone=$_POST['Phone'];
  $IDCardType=$_POST['IDCardType'];
  $IDCard=$_POST['IDCard'];
  
  $sql1="SELECT Userid FROM sys_user WHERE UserName=?";
  $rs=PDOQuery($dbcon,$sql1,[$UserName],[PDO::PARAM_STR]);
  if($rs[1]!=1){
    die('<script>alert("无此用户或用户名错误！");history.go(-1);</script>');
  }else{
    $UserID=$rs[0][0]['Userid'];
  }

  $Info_rs=PDOQuery($dbcon,"SELECT * FROM athlete_list WHERE UserID=?",[$UserID],[PDO::PARAM_STR]);
  if($Info_rs[1]!=1){
    die('<script>alert("无此运动员！");history.go(-1);</script>');
  }

  if($RealName!=$Info_rs[0][0]['RealName'] || $Phone!=$Info_rs[0][0]['Phone'] || $IDCardType!=$Info_rs[0][0]['IDCardType'] || $IDCard!=$Info_rs[0][0]['IDCard']){
    die('<script>alert("身份认证失败！");history.go(-1);</script>');
  }

  setSess("SOA_FGPW_isVerify","1");
  setSess("SOA_FGPW_UserID",$UserID);
  setSess("SOA_FGPW_RealName",$RealName);

  die('<script>window.location.href="ForgetPwd_2.php";</script>');
}
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../res/js/utils.js"></script>
  <title>忘记密码 / 东风东游泳队报名系统</title>
</head>

<body>
<br>
<form method="post">
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <img src="../res/img/back.png" style="position:absolute;width:24px;top:17px;left:5%;cursor:pointer" onclick="history.back()" aria-label="返回">
  <h3>运 动 员 忘 记 密 码</h3><br>
    <div class="alert alert-warning alert-dismissible" role="alert">
    请按提示输入资料以认证身份！<br>
    感谢您的配合！<br>
    <font color="red">* 领队忘记密码请联系管理员</font>
  </div>
  <div class="col-md-offset-2" style="line-height:12px;">
      <div class="input-group">
        <span class="input-group-addon">用户名</span>
        <input class="form-control" name="UserName">
        <span class="input-group-addon" id="forgot">&lt;</span>
      </div>
      <div class="input-group">
        <span class="input-group-addon">运动员真名</span>
        <input class="form-control" name="RealName">
        <span class="input-group-addon" id="forgot">&lt;</span>
      </div>
      <div class="input-group">
        <span class="input-group-addon">手机号</span>
        <input class="form-control" name="Phone">
        <span class="input-group-addon" id="forgot">&lt;</span>
      </div>
      <div class="input-group">
      <span class="input-group-addon">证件类型</span>
      <select name="IDCardType" id="IDCardType" class="form-control" onchange="$('#IDCard')[0].focus();">
        <option value="1" selected="true">▲ 中国二代身份证</option>
        <option disabled>——————————</option>
        <option value="2">▲ 香港居民身份证</option>
        <option disabled>——————————</option>
        <option value="3">▲ 护照</option>
      </select>
      <span class="input-group-addon" id="forgot">&lt;</span>
    </div>
    <div class="input-group">
      <span class="input-group-addon">证件号</span>
      <input type="text" class="form-control" name="IDCard" id="IDCard">
      <span class="input-group-addon" id="forgot">&lt;</span>
    </div>
      <hr>
      <input type="button" class="btn btn-primary" value="取 消 操 作" onclick='window.close();' style="width:48%"> <input type="submit" class="btn btn-success" style="width:48%" value="下 一 步"> 
  </div>
</div>
</form>

<script>
window.onload=function(){
  $("input").attr("autocomplete","off");
}
</script>
</body>
</html>