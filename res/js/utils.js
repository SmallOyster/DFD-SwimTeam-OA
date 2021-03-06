/**
* -------------------------------
* getURLParam 获取指定URL参数
* -------------------------------
* @param String 参数名称
* -------------------------------
**/
function getURLParam(name){
  var reg = new RegExp("(^|&)"+name+"=([^&]*)(&|$)");
  var r = window.location.search.substr(1).match(reg);
  if(r!=null){return decodeURI(r[2]);}
  else{return null;}
}


/**
* -------------------------------
* lockScreen 屏幕锁定，显示加载图标
* -------------------------------
* @Tips 只能手动调用！
* -------------------------------
**/
function lockScreen(){
$('body').append(
  '<div id="lockContent" style="opacity: 0.2; filter:alpha(opacity=20); width: 100%; height: 100%; z-index: 9999; position:fixed; _position:absolute; top:0; left:0;left:50%; margin-left:-20px; top:50%; margin-top:-20px;">'+
  '<div><i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw"></i></div>'+
  '</div>'+
  '<div id="lockScreen" style="background: #000; opacity: 0.2; filter:alpha(opacity=20); width: 100%; height: 100%; z-index: 9999; position:fixed; _position:absolute; top:0; left:0;">'+
  '</div>'
  );
}


/**
* -------------------------------
* unlockScreen 屏幕解锁
* -------------------------------
* @Tips 只能手动调用！
* -------------------------------
**/
function unlockScreen(){
  $('#lockScreen').remove();
  $('#lockContent').remove();
}


/**
* ------------------------------
* showCNNum 显示汉字的数字
* ------------------------------
* @param INT 一位数字
* ------------------------------
**/
function showCNNum(number){
  rtn="";
  
  if(number=="1") rtn="一";
  else if(number=="2") rtn="二";
  else if(number=="3") rtn="三";
  else if(number=="4") rtn="四";
  else if(number=="5") rtn="五";
  else if(number=="6") rtn="六";
  else if(number=="7") rtn="七";
  else if(number=="8") rtn="八";
  else if(number=="9") rtn="九";
  else if(number=="0") rtn="零";
  
  return rtn;
}


/**
* -----------------------------------
* isInArray 检测指定字符串是否存在于数组
* -----------------------------------
* @param Array  待检测的数组
* @param String 指定字符串
* -----------------------------------
**/
function isInArray(arr,val){
  length=arr.length;  
  if(length>0){
    for(var i=0;i<length;i++){
      if(arr[i] == val){
        return i;
      }
    }
    return false;
  }else{
    return false;
  }
}


/**
* -----------------------------------
* isChn 字符串是否全为汉字
* -----------------------------------
* @param String 待检测的字符串
* -----------------------------------
**/
function isChn(str){ 
  var reg = /^[\u4E00-\u9FA5]+$/; 
  if(!reg.test(str)){ 
    return 0; 
  }else{
    return 1;
  }
}


/**
* -----------------------------------
* setCookie 设置Cookie
* -----------------------------------
* @param String Cookie名称
* @param String Cookie内容
* -----------------------------------
**/
function setCookie(name,value)
{
  var Days = 30;// Cookies有效天数
  var exp = new Date();
  exp.setTime(exp.getTime() + Days*24*60*60*1000);
  document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}


/**
* -----------------------------------
* getCookie 获取Cookie
* -----------------------------------
* @param String Cookie名称
* -----------------------------------
**/
function getCookie(name)
{
  var arr;
  var reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
  if(arr=document.cookie.match(reg)){
    return unescape(arr[2]);
  }else{
    return null;
  }
}


/**
* -----------------------------------
* delCookie 删除Cookie
* -----------------------------------
* @param String Cookie名称
* -----------------------------------
**/
function delCookie(name){
  var exp = new Date();
  exp.setTime(exp.getTime()-1);
  var cval=getCookie(name);
  if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
