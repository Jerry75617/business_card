<?php
include_once("class/classMember.php");
$obj= new classMember();
$obj->head();
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="memberList.php";
$showKind="名片";
switch($_GET["showKind"]){
    case "wedding":
        $nowPage="memberList2.php";
        $showKind="喜帖";
        break;
}

$obj->body($nowPage,"yes");
?>

<script type="text/javascript">
var showKind="<?php  echo $showKind; ?>";
function queryButtonClick(){
	queryFromPage("form_query");
	pageButtonClick("0");
}
function pageButtonClick(pageNewValue){
	
	if(eval(pageNewValue)<0 || (eval(document.form_page.page_total.value)>0 && eval(pageNewValue)>=eval(document.form_page.page_total.value))){ return false; }
	
	document.form_page.page_new.value=pageNewValue;  
	var send_str="dataFlag=select&timestamp="+ new Date().getTime() + "&" + X_FORM("form_page") + "&showKind=" + showKind;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
function openButtonClick(mypk){
	var aaobj=document.getElementById("showOneDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=show_one&mypk=" + mypk + "&timestamp="+ new Date().getTime() + "&showKind=" + showKind;
		X_FORM_Str(send_str,"memberListSIM.php","");
	}
}
function updateButtonClick(){
	var send_str="dataFlag=update&timestamp="+ new Date().getTime() + "&" + X_FORM("frmmain");
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");
}
function updateButtonClickReturn(){
	var checkFlag=document.getElementById("checkFlag");
	if(checkFlag && checkFlag.value == "yes"){
		if(document.frmmain.member_id.value == "" || document.frmmain.member_id.value <= 0){
			var send_str="dataFlag=insert_showMore&showKind=" + showKind;
		}else{
			var send_str="dataFlag=show_one_tr&mypk=" + document.frmmain.member_id.value + "&showKind=" + showKind;
		}
		X_FORM_Str(send_str,"memberListSIM.php","closeDivClick");
	}
}
function closeDivClick(){
	var aaobj=document.getElementById("showOneDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
function assignDesignerClick(member_id,mypk){
	var aaobj=document.getElementById("designer_" + member_id);
	if(aaobj){
// 		aaobj.style.display="block";
		var send_str="dataFlag=show_assign&mypk=" + mypk + "&member_id=" + member_id + "&timestamp="+ new Date().getTime();
		X_FORM_Str(send_str,"memberListSIM.php","");
	}
}
function saveDesignerClick(myValue,member_id){
	var send_str="dataFlag=save_assign&myValue=" + myValue + "&member_id=" + member_id + "&timestamp="+ new Date().getTime();
	X_FORM_Str(send_str,"memberListSIM.php","");
}
function cancelClick(member_id){
	var send_str="dataFlag=cancel_assign&member_id=" + member_id + "&timestamp="+ new Date().getTime();
	X_FORM_Str(send_str,"memberListSIM.php","");
}
function openPicButtonClick(mypk){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=show_pic&mypk=" + mypk;
		X_FORM_Str(send_str,"memberListSIM.php","");
	}		
}
function closePicDivlick(){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
window.onload=function(){
	setTimeout("queryButtonClick()",100);
}
</script>

<?php
echo "<div id='showPicDiv' style='position:fixed;width:700px;height:600px;border:1px #ff9807 solid;top:10%;left:30%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;display:none;z-index:998;'></div>";
echo "<div id='showOneDiv' style='position:fixed;width:500px;height:350px;border:1px #ff9807 solid;top:20%;left:40%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;display:none;z-index:998;'></div>";
echo "<form name='form_query' id='form_query' onsubmit='return false;'>";
echo "<table border=0 width=100% class='f13'>";
echo "<tr height=30px><td width='30%' align=left>關鍵字 : ";
echo "<input type='text' name='query_text' placeholder='會員姓名、帳號'>";
echo " &nbsp; <input type='button' class='btn_green' value='送出查詢' onclick=\"queryButtonClick()\">";
switch($obj->sessionGetValue("session_login_kind")){
    case "sysadmin":
    case "admin":
        echo " &nbsp; <input type='button' class='btn_pink' value='新增會員資料' onclick=\"openButtonClick(0)\" >";
        break;
}
switch($showKind){
    case "名片":
        echo " &nbsp; <input type='button' class='btn_pink' value='新增電子名片' onclick=\"openPicButtonClick(0)\" >";
        break;
    case "喜帖":
        echo " &nbsp; <input type='button' class='btn_pink' value='新增電子喜帖' onclick=\"openButtonClick(0)\" >";
        break;
}

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