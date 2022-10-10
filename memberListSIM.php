<?php
//----
session_start();
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
//----
include("class/classMember.php");
$obj = new classMember();

if(empty($_POST["dataFlag"])){ $_POST["dataFlag"]="";}
switch($_POST["dataFlag"]){
    case "select":
        if(!isset($_POST["h_query_text"])){ $_POST["h_query_text"]=""; }
        if(!isset($_POST["h_showKind"])){ $_POST["h_showKind"]=""; }
        if(!isset($_POST["page_new"])){ $_POST["page_new"]=""; }
        
        switch($obj->sessionGetValue("session_login_kind")){
            case "sysadmin":
            case "admin":
                $whereStr="";
                if($_POST["h_query_text"]){  $whereStr.=" where (member_name like '%" .$_POST["h_query_text"]. "%' or member_account like '%" .$_POST["h_query_text"]. "%')";  }
                break;
            case "designer":
                $whereStr=" where designer_id='" .$obj->sessionGetValue("session_designer_id"). "' and designer_id > 0";
                if($_POST["h_query_text"]){  $whereStr.=" and (member_name like '%" .$_POST["h_query_text"]. "%' or member_account like '%" .$_POST["h_query_text"]. "%')";  }
                break;
            case "member":
                $whereStr=" where member_id='" .$obj->sessionGetValue("session_member_id"). "' and member_id > 0";
                if($_POST["h_query_text"]){  $whereStr.=" and (member_name like '%" .$_POST["h_query_text"]. "%' or member_account like '%" .$_POST["h_query_text"]. "%')";  }
                break;
        }
        
        $newpage=(int)$_POST["page_new"];
        $obj->member_showMore($whereStr,"",$newpage,"[!@#]showMoreDiv",$_POST["showKind"]);
        
        //計算頁數
        $mystr="select count(member_id) as num from member ".$whereStr;
        $total_result=mysqli_query($obj->link,$mystr);
        $total_arr=mysqli_fetch_array($total_result,1);
        $SQLnum=(int)$total_arr["num"];
        $pageTotal=$obj->countMorePage($SQLnum);
        //-----
        $hiddenArray=array("h_query_text","h_showKind");
        $hiddenArrValue=array($_POST["h_query_text"],$_POST["h_showKind"]);
        $obj->new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal,$newpage,$newpage+1);
        break;
    case "show_one":
        $obj->member_showOne($_POST["mypk"],"[!@#]showOneDiv");
        break;
    case "update":
        $checkArr=array("member_name"=>"姓名","member_account"=>"登入帳號");
        
        echo "[!@#]checkFlagSpan<input type='hidden' id='checkFlag' value='no'>";
        foreach($checkArr as $key => $value){
            if(!isset($_POST[$key])){  $_POST[$key]=""; }
            if($_POST[$key] == ""){
                $obj->reponse_errorMsgSIM($value."不可空白...");
                exit;
            }
        }
        $mystr="select * from member where member_account='" .$_POST["member_account"]. "' and member_id <> '" .$_POST["member_id"]. "'";
        $check_result=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($check_result) > 0){
            $obj->reponse_errorMsgSIM("帳號已重複，請重新輸入...");
            exit;
        }
        //確定同名同姓的問題如何解決??
//         $mystr="select *from member where member_name='" .$_POST["member_name"]. "' and member_id <> '" .$_POST["member_id"]. "'";
//         $check_result=mysqli_query($obj->link,$mystr);
//         if(mysqli_num_rows($check_result) > 0){
//             $obj->reponse_errorMsgSIM("姓名已存在，請重新輸入...");
//             exit;
//         }
        //有填寫密碼欄位就要確認
        if(!isset($_POST["member_password"])){ $_POST["member_password"]=""; }
        if($_POST["member_password"] <> ""){
            if($_POST["member_password"] != $_POST["check_password"]){
                $obj->reponse_errorMsgSIM("兩次密碼輸入不相同...");
                exit;
            }
        }
        
        $dataArr=array();
        $dataArr=$_POST;
        $dateTime=date("Y-m-d H:i:s");
        $dataArr["update_datetime"]=$dateTime;
        
        if((int)$_POST["member_id"] <=0){
            $dataArr["member_password"]=$_POST["member_account"];//建檔時登入的帳號密碼相同
            $dataArr["create_datetime"]=$dateTime;
            $obj->insertDB($dataArr,"member","*");
            
        }else{
            $obj->updateDB($dataArr,"member_id",$_POST["member_id"],"member","*");
        }
        echo "[!@#]checkFlagSpan<input type='hidden' id='checkFlag' value='yes'>";
        break;
    case "show_one_tr":
        $obj->member_showOneTR($_POST["mypk"]);
        break;
    case "insert_showMore":
        $whereStr="where create_datetime like '" .date("Y-m-d"). "%'";
        
        $newpage=0;
        $obj->member_showMore($whereStr,"",$newpage,"[!@#]showMoreDiv",$_POST["showKind"]);
        
        //計算頁數
        $mystr="select count(member_id) as num from member ".$whereStr;
        $total_result=mysqli_query($obj->link,$mystr);
        $total_arr=mysqli_fetch_array($total_result,1);
        $SQLnum=(int)$total_arr["num"];
        $pageTotal=$obj->countMorePage($SQLnum);
        //-----
        $hiddenArray=array("h_query_text");
        $hiddenArrValue=array("");
        $obj->new_showPageTable($hiddenArray,$hiddenArrValue,1,1,1);
        break;
    case "show_assign":
        $obj->assignDesigner_showOne($_POST["mypk"],$_POST["member_id"],"[!@#]designer_".$_POST["member_id"]);
        break;
    case"save_assign":
        if(!isset($_POST["myValue"])){ $_POST["myValue"]=""; }
        $designer_name="尚未指派"; $designer_id=0;  $designer_account="";
        if($_POST["myValue"] > 0){
            $mystr="update member set designer_id='" .$_POST["myValue"]. "' where member_id='" .$_POST["member_id"]. "'";
            mysqli_query($obj->link,$mystr);
            
            $designer_id=$_POST["myValue"];
            
            $mystr="select * from designer where designer_id='" . $_POST["myValue"] . "'";
            $designer_result=mysqli_query($obj->link,$mystr);
            if(mysqli_num_rows($designer_result) > 0){
                $designer_arr=mysqli_fetch_array($designer_result,1);
                $designer_name=$designer_arr["designer_name"];
                $designer_account=$designer_arr["designer_account"];
            }
        }
        
        echo "[!@#]designer_".$_POST["member_id"]."<a href=\"javascript:assignDesignerClick('" .$_POST["member_id"]. "','" .$designer_id. "')\"\">" .$designer_name. "&nbsp;(" .$designer_account. ")</a>";
        
        break;
    case "cancel_assign":
        $mystr="select * from member where member_id='" .$_POST["member_id"]. "'";
        $myresult=mysqli_query($obj->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        
        $designer_name="尚未指派";
        $mystr="select * from designer where designer_id='" . $myarr["designer_id"] . "'";
        $designer_result=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($designer_result) > 0){
            $designer_arr=mysqli_fetch_array($designer_result,1);
            $designer_name=$designer_arr["designer_name"];
        }
        
        echo "[!@#]designer_".$_POST["member_id"]."<a href=\"javascript:assignDesignerClick('" .$_POST["member_id"]. "','" .$myarr["designer_id"]. "')\"\">" .$designer_name. "</a>";
        break;
    case "show_pic"://編輯名片
        $obj->showNameCardShowOne($_POST["mypk"],"[!@#]showPicDiv");
        break;
    case "changeTitlePage":
        $obj->showPage($_POST["work_file_id"],$_POST["work_file_list_id"],"[!@#]showPage");
        break;
    case "save_btn":
        $updateArr=array();
        $updateArr["work_file_id"]=$_POST["work_file_id"];
        $updateArr["display_name"]=$_POST["display_name"];
        $updateArr["update_datetime"]=date("Y-m-d H:i:s");
        
        $obj->updateDB($updateArr,"work_file_id",$_POST["work_file_id"],"work_file","*");
        
        
        for($i=0;$i<count($_POST["work_file_list_id"]);$i++){
            $listArr=array();
            $listArr["btn_name"]=$_POST["btn_name"][$i];
            $listArr["url"]=$_POST["url"][$i];
            $listArr["work_file_list_id"]=$_POST["work_file_list_id"][$i];
            if($listArr["btn_name"] == "" && $listArr["url"] == ""){
                $mystr="select * from work_file_list where work_file_list_id='" .$listArr["work_file_list_id"]. "' and file_name=''";
                $check_result=mysqli_query($obj->link,$mystr);
                if(mysqli_num_rows($check_result) > 0){
                    $obj->deleteData_table("work_file_list","work_file_list_id",$listArr["work_file_list_id"],'');
                }
            }else{
                $obj->updateDB($listArr,"work_file_list_id",$listArr["work_file_list_id"],"work_file_list","*");
            }
        }
        $obj->showNameCardShowOne($_POST["work_file_id"],"[!@#]showPicDiv");
        break;
    case "addNewCard"://新增卡片
        $insertArr=array();
        $insertArr["work_file_id"]=$_POST["work_file_id"];
        $newPk=$obj->insertDB($insertArr,"work_file_list","*");
        
        $obj->showNameCardShowOne($_POST["work_file_id"],"[!@#]showPicDiv");
        break;
    case "refresh_pic"://刷新圖片
        $obj->showContentList($_POST["work_file_list_id"],"[!@#]showContentList_".$_POST["work_file_list_id"]);
        break;
    case "delete_pic":
        $mystr="select * from work_file_list where work_file_list_id='" .$_POST["work_file_list_id"]. "'";
        $myresult=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($myresult) > 0){
            $myarr=mysqli_fetch_array($myresult,1);
            $mystr="update work_file_list set file_name='' where work_file_list_id='" .$_POST["work_file_list_id"]. "'";
            mysqli_query($obj->link,$mystr);
            if(file_exists("../businessCard_img/".$myarr["file_name"])){
                unlink("../businessCard_img/".$myarr["file_name"]);//將檔案刪除
            }
        }
        $obj->showContentList($_POST["work_file_list_id"],"[!@#]showContentList_".$_POST["work_file_list_id"]);
        break;
    case "select_member":
        $mystr="select * from member where member_account = '" .$_POST["member_account"]. "'";
        $myresult=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($myresult) > 0){
            $myarr=mysqli_fetch_array($myresult,1);
            $insertArr=array(); $listArr=array();
            $insertArr["create_datetime"]=date("Y-m-d H:i:s");
            $insertArr["member_id"]=$myarr["member_id"];
            $insertArr["designer_id"]=$myarr["designer_id"];
            $insertArr["category"]="名片";
            $newPk=$obj->insertDB($insertArr,"work_file","*");
            
            $listArr["work_file_id"]=$newPk;
            $listArr["create_datetime"]=date("Y-m-d H:i:s");
            $listArr["designer_id"]=$myarr["designer_id"];
            $obj->insertDB($listArr,"work_file_list","*");
           
            $obj->showNameCardShowOne($newPk,"[!@#]showPicDiv");
        }else{
            echo "[!@#]showMsg<span>查無此會員資料</span>";
        }
        break;
}
?>