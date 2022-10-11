<?php
//----
session_start();
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
include("class/classMain.php");
$obj = new classMain();
//----
$_SESSION["session_login_kind".$obj->sysSessionAddName]="";
$_SESSION["session_account".$obj->sysSessionAddName]="";
$_SESSION["session_name".$obj->sysSessionAddName]="";
$_SESSION["session_designer_id".$obj->sysSessionAddName]="0";
$_SESSION["session_member_id".$obj->sysSessionAddName]="0";


if(empty($_POST["dataFlag"])){ $_POST["dataFlag"]="";}
switch($_POST["dataFlag"]){
    case "login":
        $designer_id=0; $member_id=0;
        switch($_POST["account"]){
            case "sysAdmin"://系統管理者
                if($_POST["password"] != "0919171962"){
                    echo "[!@#]errorMsg<span>密碼錯誤，請重新輸入</span>";
                    exit;
                }
                $name="系統管理者";
                $login_kind="sysadmin";
                break;
            case "admin"://管理者
                if($_POST["password"] != "admin"){
                    echo "[!@#]errorMsg<span>密碼錯誤，請重新輸入</span>";
                    exit;
                }
                $name="管理者";
                $login_kind="admin";
                break;
            default://設計師或會員
                $mystr="select * from designer where designer_account='" .$_POST["account"]. "'";
                $designer_result=mysqli_query($obj->link,$mystr);
                if(mysqli_num_rows($designer_result) > 0){//登入者身分為設計師
                    $designer_arr=mysqli_fetch_array($designer_result,1);
                    if($designer_arr["stop_datetime"] <> ""){
                        echo "[!@#]errorMsg<span>帳號已停用</span>";
                        exit;
                    }
                    if($designer_arr["designer_password"] != $_POST["password"]){
                        echo "[!@#]errorMsg<span>密碼錯誤，請重新輸入</span>";
                        exit;
                    }
                    
                    $name=$designer_arr["designer_name"];
                    $login_kind="designer";
                    $designer_id=$designer_arr["designer_id"];
                }else{//找會員資料
                    $mystr="select * from member where member_account='" . $_POST["account"] . "'";
                    $member_result=mysqli_query($obj->link,$mystr);
                    if(mysqli_num_rows($member_result) > 0){
                        $member_arr=mysqli_fetch_array($member_result,1);
                        if($member_arr["member_password"] != $_POST["password"]){
                            echo "[!@#]errorMsg<span>密碼錯誤，請重新輸入</span>";
                            exit;
                        }
                        $name=$member_arr["member_name"];
                        $login_kind="member";
                        $member_id=$member_arr["member_id"];
                    }else{
                        echo "[!@#]errorMsg<span>帳號密碼錯誤，請重新輸入</span>";
                        exit;
                    }
                }
                break;
        }
        $_SESSION["session_login_kind".$obj->sysSessionAddName]=$login_kind;
        $_SESSION["session_account".$obj->sysSessionAddName]=$_POST["account"];
        $_SESSION["session_name".$obj->sysSessionAddName]=$name;
        $_SESSION["session_designer_id".$obj->sysSessionAddName]=$designer_id;
        $_SESSION["session_member_id".$obj->sysSessionAddName]=$member_id;
        
        $pageName=$obj->pagePowerArr[$login_kind][0];
        echo "[!@#]header<" .$pageName. ".php";
        break;
    case "logout":
        $_SESSION["session_login_kind".$obj->sysSessionAddName]="";
        $_SESSION["session_account".$obj->sysSessionAddName]="";
        $_SESSION["session_name".$obj->sysSessionAddName]="";
        $_SESSION["session_designer_id".$obj->sysSessionAddName]="0";
        $_SESSION["session_member_id".$obj->sysSessionAddName]="0";
        echo "[!@#]header<index.php";
        break;
}
?>