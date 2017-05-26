<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../res/js/utils.js"></script>
	<title>登录 / 东风东游泳队报名系统</title>
</head>

<body>
<br>
<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <img src="../res/img/back.png" style="position:absolute;width:24px;top:17px;left:5%;cursor:pointer" onclick="history.back()" aria-label="返回">
  <h3>登 录</h3><br>
  <div class="col-md-offset-2" style="line-height:12px;">
      <div class="input-group">
        <span class="input-group-addon">用户名</span>
        <input class="form-control" id="UserName" autocomplete="off" onkeyup="if(event.keyCode==13)$('#Password')[0].focus();">
        <span class="input-group-addon" id="forgot">&lt;</span>
      </div>
      <div class="input-group">
        <span class="input-group-addon">密码</span>
        <input type="password" class="form-control" id="Password" onkeyup="if(event.keyCode==13)toLogin();">
        <span class="input-group-addon" id="forgot">&lt;</span>
      </div>
      <hr>
      <button class="btn btn-success" style="width:100%" onclick="toLogin()"> 登 录 Login </button>
      <hr>
      <button class="btn btn-primary" style="width:100%" onclick="window.location.href='Reg.php'"> 注 册 Register </button>
  </div>
</div>

<script>
function toLogin(){
	lockScreen();
	$("input")[0].disabled=1;
	name=$("#UserName").val();
	pw=$("#Password").val();
	
	re_file=getURLParam("re_file");
	re_action=getURLParam("re_action");

	if(name==""){
		$("#tips").html("请输入用户名！");
		unlockScreen();
		$("input")[0].disabled=0;
		$("#myModal").modal('show');
		return false;
	}
	if(pw==""){
		$("#tips").html("请输入密码！");
		unlockScreen();
		$("input")[0].disabled=0;
		$("#myModal").modal('show');
		return false;
	}

	$.ajax({
    url:"toLogin.php",
    type:"post",
    data:{"Name":name,"Password":pw,"re_file":re_file,"re_action":re_action},
    error:function(e){
      alert(JSON.stringify(e));
      console.log(JSON.stringify(e));
      $("#tips").html("系统错误！");
		    unlockScreen();
		    $("input")[0].disabled=0;
		    $("#myModal").modal('show');
		    return false;
    },
    success:function(got){
      if(got.substr(0,1)=="1"){
      	  URL=got.substr(1);
        window.location.href=URL;
      }else{
        $("#tips").html("用户名或密码错误！"+got);
		    unlockScreen();
		    $("input")[0].disabled=0;
		    $("#myModal").modal('show');
		    return false;
      }
    }  
  });
}


function lockScreen(){
$('body').append(
  '<div id="lockContent" style="left:50%; margin-left:-20px; top:50%; margin-top:-20px; position:fixed; _position:absolute; height:"+h+"px; width: "+w+"px; z-index: 201; overflow: hidden;">'+
  '<div class="nodata"><img src="../res/img/loading.gif"></img></div>'+
  '</div>'+
  '<div id="lockScreen" style="background: #000; opacity: 0.2; filter:alpha(opacity=20); width: 100%; height: 100%; z-index: 200; position:fixed; _position:absolute; top:0; left:0;">'+
  '</div>'
  );
}

function unlockScreen(){
  $('#lockScreen').remove();
  $('#lockContent').remove();
}
</script>


<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="ModalTitle">温馨提示</h3>
      </div>
      <div class="modal-body">
        <form method="post">
          <font color="red" style="font-weight:bolder;font-size:26;text-align:center;">
            <p id="tips"></p>
          </font>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">返回 &gt;</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->