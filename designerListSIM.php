<?php
//----
session_start();
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
//----
include("class/classDesigner.php");
$obj = new classDesigner();

if(empty($_POST["dataFlag"])){ $_POST["dataFlag"]="";}
switch($_POST["dataFlag"]){
    case "select":
        if(!isset($_POST["h_query_text"])){ $_POST["h_query_text"]=""; }
        if(!isset($_POST["page_new"])){ $_POST["page_new"]=""; }
        
        $whereStr="";
        if($_POST["h_query_text"]){  $whereStr.=" where designer_name like '%" .$_POST["h_query_text"]. "%'";  }
        
        $newpage=(int)$_POST["page_new"];
        $obj->designer_showMore($whereStr,"",$newpage,"[!@#]showMoreDiv",$_POST["showKind"]);
        
        //計算頁數
        $mystr="select count(designer_id) as num from designer ".$whereStr;
        $total_result=mysqli_query($obj->link,$mystr);
        $total_arr=mysqli_fetch_array($total_result,1);
        $SQLnum=(int)$total_arr["num"];
        $pageTotal=$obj->countMorePage($SQLnum);
        //-----
        $hiddenArray=array("h_query_text");
        $hiddenArrValue=array($_POST["h_query_text"]);
        $obj->new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal,$newpage,$newpage+1);
        break;
    case "show_one":
        $obj->designer_showOne($_POST["mypk"],"[!@#]showOneDiv");
        break;
    case "update":
        $checkArr=array("designer_name"=>"姓名","designer_cell_phone"=>"手機號碼","designer_account"=>"登入帳號");
        
        echo "[!@#]checkFlagSpan<input type='hidden' id='checkFlag' value='no'>";
        foreach($checkArr as $key => $value){
            if(!isset($_POST[$key])){  $_POST[$key]=""; }
            if($_POST[$key] == ""){
                $obj->reponse_errorMsgSIM($value."不可空白...");
                exit;
            }
        }
        $mystr="select * from designer where designer_account='" .$_POST["designer_account"]. "' and designer_id <> '" .$_POST["designer_id"]. "'";
        $check_result=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($check_result) > 0){
            $obj->reponse_errorMsgSIM("帳號已重複，請重新輸入...");
            exit;
        }
        $mystr="select *from designer where designer_name='" .$_POST["designer_name"]. "' and designer_cell_phone='" .$_POST["designer_cell_phone"]. "' and designer_id <> '" .$_POST["designer_id"]. "'";
        $check_result=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($check_result) > 0){
            $obj->reponse_errorMsgSIM("相同設計師姓名及手機號碼已存在，請重新輸入...");
            exit;
        }
        
        $dataArr=array();
        $dataArr=$_POST;
        $dateTime=date("Y-m-d H:i:s");
        $dataArr["update_datetime"]=$dateTime;
        
        if((int)$_POST["designer_id"] <=0){
            $dataArr["designer_password"]=$_POST["designer_account"];//建檔時登入的帳號密碼相同
            $dataArr["create_datetime"]=$dateTime;
            $obj->insertDB($dataArr,"designer","*");
            
        }else{
            $obj->updateDB($dataArr,"designer_id",$_POST["designer_id"],"designer","*");
        }
        echo "[!@#]checkFlagSpan<input type='hidden' id='checkFlag' value='yes'>";
        break;
    case "show_one_tr":
        $obj->designer_showOneTR($_POST["mypk"]);
        break;
    case "insert_showMore":
        $whereStr="where create_datetime like '" .date("Y-m-d"). "%'";
        
        $newpage=0;
        $obj->designer_showMore($whereStr,"",$newpage,"[!@#]showMoreDiv",$_POST["showKind"]);
        
        //計算頁數
        $mystr="select count(designer_id) as num from designer ".$whereStr;
        $total_result=mysqli_query($obj->link,$mystr);
        $total_arr=mysqli_fetch_array($total_result,1);
        $SQLnum=(int)$total_arr["num"];
        $pageTotal=$obj->countMorePage($SQLnum);
        //-----
        $hiddenArray=array("h_query_text");
        $hiddenArrValue=array("");
        $obj->new_showPageTable($hiddenArray,$hiddenArrValue,1,1,1);
        break;
}
?>