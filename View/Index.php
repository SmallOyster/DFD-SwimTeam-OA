<?php
$isAthlete=getSess(Prefix."isAthlete");
$nowDate=date("Ymd");
PDOQuery($dbcon,"UPDATE games_list SET isEnd=1 WHERE EndDate<$nowDate",[],[]);
?>

<h2 style="text-align:center">
  欢迎登录<br>东风东游泳队管理系统！
</h2>
<hr>
<div class="alert alert-success alert-dismissible" role="alert">
  <font style="font-size:16px">
  请在每次使用完毕以后，点击导航栏的头像->安全退出系统，以便下次登录。谢谢配合！
  </font>
</div>
<hr>
<center>

  <?php if($isAthlete==1){ ?>
  
  <a class="btn btn-success" href="index.php?file=Enroll&action=toGamesList.php" style="width:98%;font-size:18;font-weight:bolder;">马 上 报 名</a>
  <br><br>
  <a class="btn btn-primary" href="index.php?file=Athlete&action=EditAthProfile.php" style="width:98%;font-size:18;">资 料 修 改</a>
  
  <?php }elseif($isAthlete==0){ ?>
  
  <a class="btn btn-success" onclick='$("#myModal").modal("show");' style="width:98%;font-size:18;font-weight:bolder;">比 赛 管 理 / 统 计</a>
  <br><br>
  <a class="btn btn-primary" href="index.php?file=Athlete&action=toList.php" style="width:98%;font-size:18;">运 动 员 管 理</a>
  <?php } ?>

  <br><br>
  
  <a class="btn btn-warning" href="index.php?file=View&action=ContactAdmin.php" style="width:98%;font-size:18;">联 系 管 理 员</a>

</center>

<?php if($isAthlete==0){ ?>
<!-- ▼ 比赛管理统计-模态框Modal ▼ -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="ModalTitle">比赛管理 / 报名数据统计</h3>
      </div>
      <div class="modal-body">
        <a class="btn btn-primary" href="index.php?file=Games&action=toList.php" style="width:48%">比 赛 管 理</a> <a class="btn btn-success" href="index.php?file=Statistics&action=toGamesList.php" style="width:48%">报 名 统 计</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">返回 &gt;</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ▲ 比赛管理统计-模态框Modal ▲ -->
<?php } ?>

<script>
var GlobalNotice="";

window.onload=function(){
  getGlobalNotice();
};

function getGlobalNotice(){
  $.ajax({
    url:"Functions/Api/getGlobalNotice.php",
    type:"get",
    dataType:"json",
    success:function(got){
    	if(got.Content!="" && got.PubTime!=""){
    		Content=got.Content;
    		PubTime=got.PubTime;
    		msg="发布时间：<b>"+PubTime+"</b><hr>"+Content;
    		dm_notification(msg,'green',7000);
    	}
    }
	});
}
</script>