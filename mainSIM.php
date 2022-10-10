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
if(empty($_POST["dataFlag"])){ $_POST["dataFlag"]="";}
switch($_POST["dataFlag"]){
    case "change_pwd":
        $titleStr="width=25% align=right";
        echo "[!@#]changePwdDiv";
        echo "<div style='width:98%;height:8%;text-align:right;padding:5px;'><span class='material-symbols-outlined' onclick=\"closePwdDiv()\" style='cursor:pointer;'>close</span></div>";
        echo "<table border=0 width=100% height=90% cellpadding=0 cellspacing=0>";
        echo "<tr><td height=10%>";
        echo "<tr><td valign=top>";
            echo "<form id='frm_pwd' name='frm_pwd' onsubmit='return false'>";
            echo "<table width=96% cellpadding=3 cellspacing=0 align=center class='tableShowOne black f13'>";
            echo "<tr><td $titleStr>&emsp; 原 密 碼 :<td><input type='password' name='old_password'>";
            echo "<tr><td $titleStr>&emsp; 新 密 碼 :<td><input type='password' name='new_password'>";
            echo "<tr><td $titleStr>確 認 密 碼 :<td><input type='password' name='check_password'>";
            echo "<tr><td colspan=2 align=center>";
            echo "<input type='button' class='btn_pink' value='資料存檔' onclick=\"savePwdClick()\" >";
            echo "</table>";
            echo "<input type='hidden' name='mypk' value='" .$obj->sessionGetValue("session_designer_id"). "'>";
            echo "</form>";
            echo "<span id='checkFlagDiv'><input type='hidden' id='checkFlag' value='Y'></span>";
        echo "</table>";
        break;
    case "update_pwd":
        echo "[!@#]checkFlagDiv<input type='hidden' id='checkFlag' value='N'>";
        //檢查是否空白和2次密碼輸入正確
        $checkArr=array("old_password"=>"原密碼","new_password"=>"新密碼","check_password"=>"確認密碼");
        foreach($checkArr as $key => $value){
            if($_POST[$key] == ""){
                $obj->reponse_errorMsgSIM($value."不可空白");
                exit;
            }
        }
        if(strcmp($_POST["new_password"],$_POST["check_password"]) <> 0){
            $obj->reponse_errorMsgSIM("2次密碼輸入不一樣");
            exit;
        }
        
        switch($obj->sessionGetValue("session_login_kind")){
            case "designer":
                $tableName="designer";
                $pkName="designer_id";
                $columnStr="designer_password";
                break;
            case "member":
                $tableName="member";
                $pkName="member_id";
                $columnStr="member_password";
                break;
        }
        $mystr="select * from " .$tableName. " where " .$pkName. "='" .$_POST["mypk"]. "' and " .$columnStr. "='" .$_POST["old_password"]. "'";
        $myresult=mysqli_query($obj->link,$mystr);
        if(mysqli_num_rows($myresult) <= 0){
            $obj->reponse_errorMsgSIM("原密碼輸入錯誤");
            exit;
        }
        
        $myarr=mysqli_fetch_array($myresult,1);
        
        $upArr=array();
        $upArr[$columnStr]=$_POST["new_password"];
        
        $obj->updateDB($upArr,$pkName,$myarr[$pkName],$tableName,"*");
        echo "[!@#]checkFlagDiv<input type='hidden' id='checkFlag' value='Y'>";
        break;
}
?>