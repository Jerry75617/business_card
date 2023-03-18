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
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
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
		X_FORM_Str(send_str,"memberListSIM.php","");
		setTimeout("closeDivClick()",100);
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
	var aaobj=document.getElementById("designer_" + member_id);// + "_" + work_file_id);
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
		var send_str="dataFlag=show_pic&mypk=" + mypk + "&showKind=" +showKind;
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
	var send_str="dataFlag=select_member&member_account="+document.frmmain.member_account.value + "&showKind=" + showKind;
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
	var btnName=document.getElementsByClassName("btn_name");
	var url=document.getElementsByClassName("url");
	var color=document.getElementsByClassName("color");
	for(var i=0;i<btnName.length;i++){
		if(btnName[i].value == ""){
			alert("請輸入按鈕名稱");
			exit;
		}
	}
	for(var i=0;i<url.length;i++){
		if(url[i].value == ""){
			alert("請輸入超連結");
			exit;
		}
	}
	for(var i=0;i<color.length;i++){
		if(color[i].value == ""){
			alert("請選擇按鈕顏色");
			exit;
		}
	}
	var send_str="dataFlag=save_btn&" + X_FORM("frmmain");
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");	
}
//新增名片
function addClick(work_file_id){
	var send_str="dataFlag=addNewCard&work_file_id=" + work_file_id + "&showKind=" + showKind;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
//新增按鈕
function addBtn(work_file_list_id){
	var aaobj=document.getElementById("cards_fun");
	var strUser = aaobj.options[aaobj.selectedIndex].value;
	var send_str="dataFlag=extend_button&work_file_list_id=" + work_file_list_id + "&option=" + strUser + "&showKind=" + showKind;
	
	X_FORM_Str(send_str,"memberListSIM.php","");
	//alert (strUser);

	
	//var send_str="dataFlag=extend_button&work_file_id=" + work_file_id + "&showKind=" + showKind + “work_file_list_id=“ +work_file_list_id;
	//X_FORM_Str(send_str,"memberListSIM.php","");

}
// 刪除按鈕
function delBtn(work_file_list_id, delete_btn_index){
	var send_str="dataFlag=delete_button&work_file_list_id=" + work_file_list_id + "&showKind=" + showKind + "&delete_btn_index=" + delete_btn_index;
	X_FORM_Str(send_str,"memberListSIM.php","");
	//var send_str="dataFlag=delete_button&work_file_id=" + work_file_id + "&showKind=" + showKind + “work_file_list_id=“ +work_file_list_id;
	//X_FORM_Str(send_str,"memberListSIM.php","");

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
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");
}
//刪除圖片
function delete_img(work_file_list_id){
	if(confirm("是否確定刪除??") == false){ return; }
	var send_str="dataFlag=delete_pic&work_file_list_id=" + work_file_list_id;
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");
}
//移動順序
function moveButtonClick(change_pk,now_pk,actionStr){
	var send_str="dataFlag=move_pic&change_pk=" + change_pk +"&now_pk=" + now_pk +"&actionStr=" + actionStr;
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");
}
//-----start 展期功能 start-----
function extendClick(work_file_id){
	var aaobj=document.getElementById("showOneDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=extend_card&work_file_id=" + work_file_id;
		X_FORM_Str(send_str,"memberListSIM.php","");
	}
}
function updateExtendClick(){
	var send_str="dataFlag=update_extend&timestamp="+ new Date().getTime() + "&" + X_FORM("frm_extend")+ "&showKind=" + showKind;
	X_FORM_Str(send_str,"memberListSIM.php","updateButtonClickReturn");
}
//-----end 展期功能 end-----
//刪除會員
function deleteMemberClick(mypk){
	if(confirm("是否確定刪除此會員??") == false){ return; }
	var send_str="dataFlag=delete_member&member_id=" + mypk;
	X_FORM_Str(send_str,"memberListSIM.php","deleteMemberClickReturn");
}
function deleteMemberClickReturn(){
	var checkFlag=document.getElementById("checkFlag");
	if(checkFlag && checkFlag.value == "yes"){
		var send_str="dataFlag=show_one_tr&mypk=" + document.frmmain.member_id.value + "&showKind=" + showKind;
		X_FORM_Str(send_str,"memberListSIM.php","closeDivClick");
	}
}
//刪除名片
function deleteCardClick(mypk,member_id){
	if(confirm("是否確定刪除此名片??") == false){ return; }
	var send_str="dataFlag=delete_card&work_file_id=" + mypk + "&member_id=" + member_id + "&showKind=" + showKind;
	X_FORM_Str(send_str,"memberListSIM.php","");
}
function openUrl(mypk,cardName){
	var url="https://rubydesign.net/business_card/liff_share.php?mypk=" + mypk + "&cardName=" + cardName;
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
// include_once("./js/liffShare.js");
echo "<div id='showPicDiv' style='position:fixed;width:900px;height:600px;border:1px #AAAAAA solid;top:5%;left:20%;z-index:999;background-color:#E9CCCD;;border-radius:0px;box-shadow:8px 8px 10px gray;display:none;z-index:998;overflow:auto;'></div>";
echo "<div id='showOneDiv' style='position:fixed;width:300px;height:520px;border:1px #AAAAAA solid;top:15%;left:40%;z-index:999;background-color:#E9CCCD;border-radius:0px;box-shadow:8px 8px 10px gray;display:none;z-index:998;'></div>";
echo "<form name='form_query' id='form_query' onsubmit='return false;'>";
echo "<table border=0 width=100% class='f13'>";
echo "<tr height=30px><td width='30%' align=left>關鍵字 : ";
echo "<input type='text' name='query_text' placeholder='會員姓名、帳號'>";
echo "<span class='btn_green' onclick=\"queryButtonClick()\">送出查詢</span>";
switch($obj->sessionGetValue("session_login_kind")){
    case "sysadmin":
    case "admin":
        echo "<span class='btn_pink' onclick=\"openButtonClick(0)\">新增會員資料</span>";
        break;
}
switch($showKind){
    case "名片":
        echo "<span class='btn_pink' onclick=\"openPicButtonClick(0)\">新增電子名片</span>";
        break;
    case "喜帖":
        echo "<span class='btn_pink' onclick=\"openPicButtonClick(0)\">新增電子喜帖</span>";
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
