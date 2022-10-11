<?php
include_once("class/classDesigner.php");
$obj= new classDesigner();
$obj->head();
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="designerList.php";
$showKind="名片";
switch($_GET["showKind"]){
    case "wedding":
        $nowPage="designerList2.php";
        $showKind="喜帖";
        break;
}
$obj->body($nowPage,"yes");
?>

<script type="text/javascript">
var showKind="<?php echo $showKind; ?>";
function queryButtonClick(){
	queryFromPage("form_query");
	pageButtonClick("0");
}
function pageButtonClick(pageNewValue){
	
	if(eval(pageNewValue)<0 || (eval(document.form_page.page_total.value)>0 && eval(pageNewValue)>=eval(document.form_page.page_total.value))){ return false; }
	
	document.form_page.page_new.value=pageNewValue;  
	var send_str="dataFlag=select&timestamp="+ new Date().getTime() + "&" + X_FORM("form_page") + "&showKind=" + showKind;
	X_FORM_Str(send_str,"designerListSIM.php","");
}
function openButtonClick(mypk){
	var aaobj=document.getElementById("showOneDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=show_one&mypk=" + mypk + "&timestamp="+ new Date().getTime();
		X_FORM_Str(send_str,"designerListSIM.php","");
	}
}
function updateButtonClick(){
	var send_str="dataFlag=update&timestamp="+ new Date().getTime() + "&" + X_FORM("frmmain");
	X_FORM_Str(send_str,"designerListSIM.php","updateButtonClickReturn");
}
function updateButtonClickReturn(){
	var checkFlag=document.getElementById("checkFlag");
	if(checkFlag && checkFlag.value == "yes"){
		if(document.frmmain.designer_id.value == "" || document.frmmain.designer_id.value <= 0){
			var send_str="dataFlag=insert_showMore&showKind=" + showKind;
		}else{
			var send_str="dataFlag=show_one_tr&mypk=" + document.frmmain.designer_id.value+ "&showKind=" + showKind;
		}
		X_FORM_Str(send_str,"designerListSIM.php","closeDivClick");
	}
}
function closeDivClick(){
	var aaobj=document.getElementById("showOneDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
function stopButtonClick(mypk,flag){
	var send_str="dataFlag=designer_stop&mypk=" + mypk + "&flag=" + flag;
	X_FORM_Str(send_str,"designerListSIM.php","closeDivClick");
}
window.onload=function(){
	setTimeout("queryButtonClick()",100);
}
</script>

<?php 
echo "<div id='showOneDiv' style='position:fixed;width:500px;height:320px;border:1px #ff9807 solid;top:20%;left:40%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;display:none;'></div>";
echo "<form name='form_query' id='form_query' onsubmit='return false;'>";
echo "<table border=0 width=100% class='f13'>";
echo "<tr height=30px><td width='30%' align=left>設計師姓名 : ";
echo "<input type='text' name='query_text' >";
echo "<span class='btn_green' onclick=\"queryButtonClick()\">送出查詢</span>";
echo "<span class='btn_pink' onclick=\"openButtonClick(0)\">新增資料</span>";
echo "</table>";
echo "</form>";
$hiddenArray=array("h_query_text");
$hiddenArrValue=array("");

echo "<br><div id='showMoreDiv'>";
$obj->new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal=0,$newpage=0,$newpage=0);
echo "</div>";

echo "<span id='checkFlagSpan'><input type='hidden' id='checkFlag' value='no'></span>";
$obj->body_end();
?>