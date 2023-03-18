<?php
session_start();

?>
<script>
function sendClick(){
	var send_str="dataFlag=login&timestamp="+ new Date().getTime() + "&" + X_FORM("frmmain");
	X_FORM_Str(send_str,"loginSIM.php","");
}
</script>
<style>
@font-face{
    font-family: "微軟正黑體";
    src:url("./fonts/msjh.ttc");
}
body{
    background-color:#E9CCCD;
}

.btn_submit{
    border: 1px #A5545C solid;
    margin: 5px;
    width: 25%;
    height: 28px;
    line-height: 28px;
    font-size: 13.5px;
    vertical-align: middle;
    background-color: #A5545C;
    color: #F3E4E7;
    border-radius: 15px;
    cursor: pointer;
    padding: 1px 10px;
}
.btn_submit:hover{
    background-color:#CD969D;
    color:#A5545C;
    border-color:#CD969D;
}
input[type=text]{
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #ffffff;
    border-radius: 5px;
    color: inherit;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 60%;
    height:38px;
    font-size:13px;
    outline:none;
    color:#5f5f5f;
}
input[type=text]:focus{
    border-color: #ffffff;
    background-color: #ffffff;
    color: #5f5f5f;
}
input[type=password]{
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #ffffff;
    border-radius: 5px;
    color: inherit;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 60%;
    height:38px;
    font-size:13px;
    outline:none;
    color:#5f5f5f;
}

input[type=password]:focus{
    border-color: #ffffff;
    background-color: #ffffff;
    color: #5f5f5f;
}
</style>

<!DOCTYPE html>
<html style="height:100%">
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="-1" />
        <link rel='shortcut icon' href='./img/logo.jpg'>
        <link rel='image_src' href='' type='image/png'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500&family=Noto+Serif+TC:wght@200&display=swap" rel="stylesheet">
        <title>電子名片管理</title>
    </head>
<?php 
include_once("./js/main.js");
?>
    <body>
    <div style="position: absolute;top:23%;left:38%;width:20%;height:50%;">
        <form name="frmmain" id="frmmain" onsubmit="">
        	<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
            <tr><td height=15% align=center>
				<font style="font-size:28px;color:#A55C5C;">系統登入頁</font>
            <tr><td height=85% valign=top style="padding:0">
                <table border=0 width=100% height=100% cellpadding=5 cellspacing=3>
                <tr><td height=18% align=center>
                	<div style="width:94%;background-color:#ffffff;border-radius:10px;font-size:13px;text-align:left;color:#A55C5C">
                	 &emsp; 帳號
                	 <input type="text" name="account" autofocus ></div>
                <tr><td height=18% align=center>
                	<div style="width:94%;background-color:#ffffff;border-radius:10px;font-size:13px;text-align:left;color:#A55C5C">
                	 &emsp; 密碼
                	 <input type="password" name="password" ></div>
                <tr><td height=15% align=center>
                	<div style="color:#A55C5C;height:20px;"  id="errorMsg"></div>
                	<input type="button" class="btn_submit" value="確認" onclick="sendClick()">
                <tr><td align="center" style="color:#222222;" valign=top>露比設計有限公司所有
                <div style="color:#555555;font-size:12px;transform:scale(0.8);" >© Copyright 2023 All Rights Reserved </div>
                </table>
            </table>
        </form>
        
    </div>
    
    </body>
</html>