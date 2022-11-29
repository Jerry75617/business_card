<?php
include_once("class/classMember01.php");
$obj= new classMember01();
$obj->head();
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="memberList01.php";
$showKind="名片";
switch($_GET["showKind"]){
    case "wedding":
        $nowPage="memberList012.php";
        $showKind="喜帖";
        break;
}
$obj->body($nowPage,"yes");
?>
<script type="text/javascript">
var showKind="<?php  echo $showKind; ?>";
//----start搜尋會員----
function queryButtonClick(){
	queryFromPage("form_query");
	pageButtonClick("0");
}
function pageButtonClick(pageNewValue){
	
	if(eval(pageNewValue)<0 || (eval(document.form_page.page_total.value)>0 && eval(pageNewValue)>=eval(document.form_page.page_total.value))){ return false; }
	
	document.form_page.page_new.value=pageNewValue;  
	var send_str="dataFlag=select&timestamp="+ new Date().getTime() + "&" + X_FORM("form_page") + "&showKind=" + showKind;
	X_FORM_Str(send_str,"memberList01SIM.php","");
}
//----end 搜尋會員----
//----start 電子名片編輯畫面----
function openPicButtonClick(mypk){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=show_pic&mypk=" + mypk + "&showKind=" +showKind;
		X_FORM_Str(send_str,"memberList01SIM.php","");
	}		
}
function closePicDivlick(){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
//----end 電子名片編輯畫面----
function openUrl(mypk){
	var url="https://rubydesign.net/business_card/liff_share.php?mypk=" + mypk;
	window.open(url,'_blank');
}
function copyEvent(id)
{
    var str = document.getElementById(id);
    window.getSelection().selectAllChildren(str);
    document.execCommand("Copy")
}
window.onload=function(){
	setTimeout("queryButtonClick()",100);
}
</script>

<?php
echo "<div id='showPicDiv' style='position:fixed;width:700px;height:800px;border:1px #ff9807 solid;top:5%;left:30%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;display:none;z-index:998;overflow:auto;'></div>";
echo "<div id='showOneDiv' style='position:fixed;width:500px;height:350px;border:1px #ff9807 solid;top:20%;left:40%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;display:none;z-index:998;'></div>";
echo "<form name='form_query' id='form_query' onsubmit='return false;'>";
echo "<table border=0 width=100% class='f13'>";
echo "<tr height=30px><td width='30%' align=left>關鍵字 : ";
echo "<input type='text' name='query_text' placeholder='名片標題'>";
echo "<span class='btn_green' onclick=\"queryButtonClick()\">送出查詢</span>";

echo "<input type='hidden' name='showKind' value='" .$showKind. "'>";
echo "</table>";
echo "</form>";
$hiddenArray=array("h_query_text","h_showKind");
$hiddenArrValue=array("","");

echo "<div id='showMoreDiv'>";
$obj->new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal=0,$newpage=0,$newpage=0);
echo "</div>";

echo "<span id='checkFlagSpan'><input type='hidden' id='checkFlag' value='no'></span>";
$obj->body_end();
?>