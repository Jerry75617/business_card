<?php
include_once("./class/classDesigner.php");
$obj= new classDesigner();

$titleStr=$_GET["cardName"]." 電子名片";

echo "<!DOCTYPE html><html style='height:100%'><head>";
echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">";
echo "<meta http-equiv=\"pragma\" content=\"no-cache\">";
echo "<meta http-equiv=\"cache-control\" content=\"max-age=0\" />";
echo "<meta http-equiv=\"cache-control\" content=\"no-cache\" />";
echo "<meta http-equiv=\"expires\" content=\"-1\" />";
echo "<title>" .$titleStr. "</title>";
echo "<link rel='shortcut icon' href='./img/logo.jpg'>";
echo "<link rel='image_src' href='' type='image/png'>";
echo "<link href='./css/main.css?" .date("YmdHis"). "' rel='stylesheet' type='text/css' />";
echo "</head>";

if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="liff_share.php";

$obj->body($nowPage,"yes");

if(isset($_GET["liff_state"])){
    $work_file_id=str_replace("?mypk=","",$_GET["liff_state"]);
}else{
    if(!isset($_GET["mypk"])){ $_GET["mypk"]=0; }
    $work_file_id=(int)$_GET["mypk"];
}


if($work_file_id <=0 ){
    echo "<div style='font-size:1.2em;text-align:center;'>...查無資料...</div>";
    exit;
}

$mystr="select * from work_file where work_file_id='" .$work_file_id. "'";
$check_result=mysqli_query($obj->link,$mystr);
if(mysqli_num_rows($check_result) <= 0){
    echo "<div style='font-size:1.2em;text-align:center;'>...查無資料...</div>";
    exit;
}
$check_arr=mysqli_fetch_array($check_result,1);

if($check_arr["dateline"] <> "" && strcmp($check_arr["dateline"],date("Y-m-d")) < 0){
    echo "<div style='font-size:1.2em;text-align:center;'>...此名片已逾期...</div>";
    exit;
}
//有空值就不可傳送
$mystr="select work_file_id from work_file where work_file_id='" .$work_file_id. "'";
$myresult=mysqli_query($obj->link,$mystr);
if(mysqli_num_rows($myresult) <= 0){
    exit;
}
$myarr=mysqli_fetch_array($myresult,1);

$mystr="select * from work_file_list where work_file_id='" .$work_file_id. "'";
$list_result=mysqli_query($obj->link,$mystr);
$list_num=mysqli_num_rows($list_result);

$checkArr=array("flag"=>"yes","errorMsg"=>"");
for($i=0;$i<$list_num;$i++){
    $list_arr=mysqli_fetch_array($list_result,1);
    $btnQty=1;
    if($list_arr["card_size"] == ""){
        $checkArr["flag"]="no";
        $checkArr["errorMsg"]="名片尺寸";
    }
    if($list_arr["file_name"] == ""){
        $checkArr["flag"]="no";
        $checkArr["errorMsg"]="圖片";
    }
    if($list_arr["card_bg_color"] == ""){
        $checkArr["flag"]="no";
        $checkArr["errorMsg"]="卡片背景色";
    }
    
    for($j=0;$j<$list_arr["btn_amount"];$j++){
        if($j==0){ $btnQty=""; }
        if($list_arr["btn" .$btnQty. "_name"] == ""){
            $checkArr["flag"]="no";
            $checkArr["errorMsg"]="按鈕名稱";
        }
        if($list_arr["url" .$btnQty] == ""){
            $checkArr["flag"]="no";
            $checkArr["errorMsg"]="超連結";
        }
        if($list_arr["btn".$btnQty."_bg_color"] == ""){
            $checkArr["flag"]="no";
            $checkArr["errorMsg"]="按鈕背景顏色";
        }
        if($list_arr["btn" .$btnQty. "_font_color"] == ""){
            $checkArr["flag"]="no";
            $checkArr["errorMsg"]="按鈕文字顏色";
        }
        $btnQty++;
    }
}

if($checkArr["flag"] == "no"){
    echo "<div style='font-size:1.2em;text-align:center;'>";
    if($checkArr["errorMsg"] == "圖片"){
        echo $checkArr["errorMsg"]. "不可空白，請上傳" .$checkArr["errorMsg"];
    }else{
        echo $checkArr["errorMsg"]. "不可空白，請輸入" .$checkArr["errorMsg"];
    }
    
    echo "</div>";
    exit;
}
if($list_num > 0){
    mysqli_data_seek($list_result,0);
}
?>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>window.location.href
function copyEvent()
{
	var str=window.location.href;
	textArea = document.createElement('textArea');
	textArea.value = str;
	document.body.appendChild(textArea);
    window.getSelection().selectAllChildren(textArea);
    textArea.select();
    document.execCommand("Copy");
    document.body.removeChild(textArea);
}
</script>
<?php 
echo "<form id='frmmain' name='frmmain'>";
//顯示樣式
$style="width:35%;height:60px;background-color:#CD939D;color:#ffffff;border-width:0px;";
$style.="border-radius:60px;";

$style1="width:100%;height:60px;background-color:#CD939D;color:#ffffff;border-width:0px;";
$style1.="border-radius:60px;";

echo "<div style='width:40%;margin:0% 30%;height:600px;'>";
echo "<table border=0 width=100% height=100%>";
echo "<tr><td height=10%>";
    echo "<div style='width:100%;text-align:center;'>";
    echo "<button id='showLineBtn' style='" .$style. "'>";
    echo "<font style='font-size:1.5em;'>分享名片給好友</font>";
    echo "<br><font style='font-size:1em;'>Share to friend</font>";
    echo "</button>";
    echo "</div>";
echo "<tr><td height=10% valign=top align=center>";
echo "<hr style='border: 0;border-top: 8px double #CD939D ;'>";
echo "<font style='font-size:1.5em;'>".$check_arr["display_name"]."</font>";
echo "<hr style='border: 0;border-top: 8px double #CD939D ;'>";
echo "<tr><td align=center>";
$myDataStr="";
for($i=0;$i<$list_num;$i++){
    $list_arr=mysqli_fetch_array($list_result,1);
    $myDataStr.=$list_arr["card_size"].",".$list_arr["file_name"].",".$list_arr["card_bg_color"].",";
    $btnQty=1;
    
    echo "<div style='display: inline-block;width:30%;'>";
    echo "<table border=0 width=100% cellpadding=3 cellspacing=2 class='black f13'>";
    echo "<tr><td align=center valign=top>";
    echo "<img src='../businessCard_img/" .$list_arr["file_name"]. "' style='width:100%'>";
    
    for($j=0;$j<$list_arr["btn_amount"];$j++){
        if($j==0){ $btnQty=""; }
        $fontColor="#ffffff;";
        if($list_arr["btn" .$btnQty. "_font_color"] == "secondary"){  $fontColor="#000000";  }
        
        echo "<tr><td><div style='width:100%;background-color:" .$list_arr["btn".$btnQty."_bg_color"]. ";color:" .$fontColor. ";text-align:center;padding:5px 0px ;border-radius:5px;font-size:1.2em;'>" .$list_arr["btn" .$btnQty. "_name"]. "</div>";
        $myDataStr.=$list_arr["btn" .$btnQty. "_name"].",".$list_arr["url" .$btnQty].",".$list_arr["btn".$btnQty."_bg_color"].",".$list_arr["btn" .$btnQty. "_font_color"].",";
        $btnQty++;
    }
    echo "</table>";
    echo "</div>";
    if($myDataStr <> ""){ $myDataStr=substr($myDataStr,0,-1).";"; }
}
echo "<tr><td height=25% align=centr style='text-align: center;'>";
// echo "<div style='float:middle;width:35%;display: inline-block'>";
// echo "<div id='showLineBtn' style='" .$style1. ";display: flex;align-items:center;justify-content: center; flex-direction: column;'>";
// echo "<font style='font-size:1.5em;'>傳送本聊天室</font>";
// echo "<div style='clear:both'><font style='font-size:1em;'>Share this chat</font></div>";
// echo "</div>";
// echo "</div> &nbsp; ";
echo "<div style='float:middle;width:35%;display: inline-block' onclick=\"copyEvent('copy_url')\">";
echo "<div style='" .$style1. ";display: flex;align-items:center;justify-content: center; flex-direction: column;' >";
echo "<font style='font-size:1.5em;' >複製連結</font>";
echo "<div style='clear:both'><font style='font-size:1em;'>Copy link</font></div>";
echo "</div>";
echo "</div>";
echo "<tr><td align=center height=5% style='font-size:12px;color:#787878;'>Copyright©露比設計有限公司所有 All Rights Reserved.";
echo "</table>";
echo "</div>";

echo "<input type='hidden' name='myDataStr' value='" .$myDataStr. "' style='width:100%'>";
echo "<input type='hidden' name='mypk' value='" .$_GET["mypk"]. "'>";
echo "<input type='hidden' name='alterMsg' value='" .$titleStr. "'>";
echo "</form>";
include_once("./js/liffShare.js");
$obj->body_end();
?>