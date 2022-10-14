<?php
//----
session_start();
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
//----
include("class/classMember01.php");
$obj = new classMember01();

if(empty($_POST["dataFlag"])){ $_POST["dataFlag"]="";}
switch($_POST["dataFlag"]){
    case "select":
        if(!isset($_POST["h_query_text"])){ $_POST["h_query_text"]=""; }
        if(!isset($_POST["h_showKind"])){ $_POST["h_showKind"]=""; }
        if(!isset($_POST["page_new"])){ $_POST["page_new"]=""; }
        
        $whereStr=" where member_id='" .$obj->sessionGetValue("session_member_id"). "' and member_id > 0 and category='" .$_POST["h_showKind"]. "'";
        if($_POST["h_query_text"]){  $whereStr.=" and (display_name like '%" .$_POST["h_query_text"]. "%')";  }
        
        $newpage=(int)$_POST["page_new"];
        $obj->work_showMore($whereStr,"",$newpage,"[!@#]showMoreDiv",$_POST["h_showKind"]);
        
        //計算頁數
        $mystr="select count(work_file_id) as num from work_file ".$whereStr;
        $total_result=mysqli_query($obj->link,$mystr);
        $total_arr=mysqli_fetch_array($total_result,1);
        $SQLnum=(int)$total_arr["num"];
        $pageTotal=$obj->countMorePage($SQLnum);
        //-----
        $hiddenArray=array("h_query_text","h_showKind");
        $hiddenArrValue=array($_POST["h_query_text"],$_POST["h_showKind"]);
        $obj->new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal,$newpage,$newpage+1);
        break;
    case "show_pic"://編輯名片
        $obj->showNameCardShowOne($_POST["mypk"],$_POST["showKind"],"[!@#]showPicDiv");
        break;
}
?>