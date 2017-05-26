<?php
$Gamesid=isset($_GET['GamesID'])?$_GET['GamesID']:"";
$GamesName=isset($_GET['GamesName'])?$_GET['GamesName']:"";

if($Gamesid==null || $GamesName==null) ErrCodedie("500");

?>

<div class="well col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center col-xs-10 col-xs-offset-1">
  <img src="res/img/back.png" style="position:absolute;width:24px;top:17px;left:5%;cursor:pointer" onclick="history.back()" aria-label="返回" >
  <h3>编辑比赛信息</h3><br>
  <div class="col-md-offset-2" style="line-height:12px;">
    <div class="input-group">
      <span class="input-group-addon">比赛名称</span>
      <input type="text" class="form-control" id="GamesName" value="<?php echo $GamesName; ?>">
      <span class="input-group-addon" id="forgot">&lt;</span>
    </div>
    <div class="input-group">
      <span class="input-group-addon">结束报名<br><br>日期</span>
      <select id="EndYear" class="form-control">
        <option value="" selected="selected" disabled>请选择（年）</option>
        <?php
          $y=date("Y");
          for($y;$y<=2050;$y++){
        ?>
        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
        <?php } ?>
      </select>
      <select id="EndMonth" class="form-control">
        <option value="" selected="selected" disabled>请选择（月）</option>
        <?php
          for($m=1;$m<=12;$m++){
            if($m<10) $m1="0".$m;
            else $m1=$m;
        ?>
        <option value="<?php echo $m1; ?>"><?php echo $m1; ?></option>
        <?php } ?>
      </select>
      <select id="EndDay" class="form-control">
        <option value="" selected="selected" disabled>请选择（日）</option>
        <?php
          for($d=1;$d<=31;$d++){
            if($d<10) $d1="0".$d;
            else $d1=$d;
        ?>
        <option value="<?php echo $d1; ?>"><?php echo $d1; ?></option>
        <?php } ?>
      </select>
      <span class="input-group-addon" id="forgot">&lt;</span>
    </div>
    <hr>
    <div class="input-group">
      <span class="input-group-addon">限制报名</span>
      <select id="isPrivate" class="form-control">
        <option value="" selected="selected" disabled>--------</option>
        <option value="0">面向全体运动员</option>
        <option value="" disabled>--------</option>
        <option value="1">限制部分运动员</option>
      </select>
      <span class="input-group-addon" id="forgot">&lt;</span>
    </div>
    <hr>
    <button class="btn btn-success" style="width:100%" onclick="toEditGames()">确 认 修 改</button>
  </div>
</div>

<script>
function InputErrResponse(InputName,Content){
  alert(Content);
  unlockScreen();
  $("#"+InputName).focus();
}

function toEditGames(){
  TipsCT_i="请输入";
  TipsCT_c="请选择";
  
  lockScreen();
  GamesID=getURLParam("GamesID");
  GamesName=$("#GamesName").val();
  EndYear=$("#EndYear").val();
  EndMonth=$("#EndMonth").val();
  EndDay=$("#EndDay").val();
  isPrivate=$("#isPrivate").val();
  
  if(GamesName==""){
    Tips=TipsCT_i+"比赛名称！";
    InputErrResponse("GamesName",Tips);
    return false;
  }
  if(EndYear==null){
    Tips=TipsCT_c+"比赛结束时间（年份）！";
    InputErrResponse("EndYear",Tips);
    return false;
  }
  if(EndMonth==null){
    Tips=TipsCT_c+"比赛结束时间（月份）！";
    InputErrResponse("EndMonth",Tips);
    return false;
  }
  if(EndDay==null){
    Tips=TipsCT_c+"比赛结束时间（日期）！";
    InputErrResponse("EndDay",Tips);
    return false;
  }
  if(isPrivate==null){
    Tips=TipsCT_c+"比赛报名限制情况！";
    InputErrResponse("isPrivate",Tips);
    return false;
  }
  
  EndDate=EndYear+EndMonth+EndDay;
  
  $.ajax({
    url:"Games/toSaveGamesInfo.php",
    type:"post",
    data:{"OprType":"Edit","GamesID":GamesID,"GamesName":GamesName,"EndDate":EndDate,"isPrivate":isPrivate},
    error:function(e){
      alert(JSON.stringify(e));
      console.log(JSON.stringify(e));
    },
    success:function(got){
      if(got=="1"){
        alert("修改成功！");
        history.go(-1);
        return;
      }else if(got=="0"){
        alert("修改失败！！！\n\n请联系管理员并提交错误码！\n\n错误码：GS-E-0");
        unlockScreen();
        return;
      }else{
        alert("修改失败！！！\n\n请联系管理员并提交错误码！\n\n错误码：GS-E-"+got);
        unlockScreen();
        return;
      }
    }
  });
}
</script>