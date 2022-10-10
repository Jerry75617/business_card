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
//----start搜尋會員----
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
//----end 搜尋會員----
//----start 編輯會員資料----
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
//----end 編輯會員資料----
//----start 指派設計師----
function assignDesignerClick(member_id,mypk){
	var aaobj=document.getElementById("designer_" + member_id);
	if(aaobj){
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
//----end 指派設計師----
//新增電子名片編輯畫面
function openPicButtonClick(mypk){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=show_pic&mypk=" + mypk;
		X_FORM_Str(send_str,"memberListSIM.php","");
	}		
}
//關閉電子名片編輯畫面
function closePicDivlick(){
	var aaobj=document.getElementById("showPicDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
function selectMember(){
	var send_str="dataFlag=select_member&member_account="+document.frmmain.member_account.value;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
//--start 同一頁增加多筆按鈕-- **目前沒用到
function addButtonClick(){
	var aaobj=document.getElementById("buttonContent");
	if(aaobj){

		var newDiv = document.createElement("div");
	    var bbobj=aaobj.appendChild(newDiv);
	    bbobj.className="buttonStr";

	    var ccobj=document.getElementsByClassName("buttonStr");
	    newDiv.innerHTML += "<span style='font-size:1.2em;font-weight:bold;'>按鈕" + ccobj.length + "</span><br><span>文字 : <input type='text' name='btn_name_" +ccobj.length+ "'></span>";
	    newDiv.innerHTML += "<br><span>連結 : <input type='text' name='url_" +ccobj.length+ "'></span><br>";
	    
	}
}
//--end 同一頁增加多筆按鈕--
//改變名片頁數
function changeTitlePageClick(work_file_id,work_file_list_id){
	var aaobj=document.getElementsByClassName("showContentList");
	var bbobj=document.getElementById("showContentList_" + work_file_list_id);
	for(var i=0; i<aaobj.length; i++){
		aaobj[i].style.display="none";
	}
	if(bbobj){  bbobj.style.display="";  }
	var send_str="dataFlag=changeTitlePage&work_file_list_id=" + work_file_list_id + "&work_file_id=" + work_file_id;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
//存檔按鈕/url
function saveBtnClick(){
	var send_str="dataFlag=save_btn&" + X_FORM("frmmain");
	X_FORM_Str(send_str,"memberListSIM.php","");	
}
//新增名片
function addClick(work_file_id){
	var send_str="dataFlag=addNewCard&work_file_id=" + work_file_id;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
//上傳圖片
function uploadPicClick(mypk){
	var aaobj=document.getElementById("uploadDiv_" + mypk);
	if(aaobj){
		aaobj.style.display="block";
		aaobj.innerHTML="<iframe src='workFile_upload.php?mypk=" + mypk + "' style='border:0px;width:100%;height:500px;'></iframe>";
	}
}
//刷新圖片
function refresh_img(work_file_list_id){
	var send_str="dataFlag=refresh_pic&work_file_list_id=" + work_file_list_id;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
//刪除圖片
function delete_img(work_file_list_id){
	if(confirm("是否確定刪除??") == false){ return; }
	var send_str="dataFlag=delete_pic&work_file_list_id=" + work_file_list_id;
	X_FORM_Str(send_str,"memberListSIM.php","");
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