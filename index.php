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
body{
    background-color:#424242;
    font-family-sans-serif: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
}
html{
	font-family: sans-serif;	
}
.btn_submit{
    width:94%;
    font-size:18px;
    height:40px;
    line-height:40px;
    background-color:rgba(255, 235, 59, 0.24);
    color:#E6E6E6;
    border-color:rgba(255, 235, 59, 0.24);
}
.btn_submit:hover{
    background-color:rgba(255, 235, 59, 0.473);
    color:#E6E6E6;
    border-color:rgba(255, 235, 59, 0.473);
}
input[type=text]{
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 94%;
    height:38px;
    font-size:18px;
    outline:none;
    color:#ffffff;
}
input[type=text]:focus{
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
}
input[type=password]{
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 94%;
    height:38px;
    font-size:18px;
    outline:none;
    color:#ffffff;
}
input[type=password]:focus{
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
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
        <link href='css/main.css' rel='stylesheet' type='text/css' />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>電子名片管理</title>
    </head>
<?php 
include_once("./js/main.js");
?>
    <body>
    <div style="position: absolute;top:11%;left:41%;width:18%;height:50%;">
        <form name="frmmain" id="frmmain" onsubmit="">
        	<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
            <tr><td height=20% align=center style="border-bottom:2px #FFEB3B solid;padding-bottom:3%;">
                <span class="material-icons" style="font-size:6em;color:#EFEFEF;">account_circle</span>
                <br><font style="font-size:28px;color:#ffffff;">會員帳號登入頁</font>
            <tr><td height=80% style="background-color:#3a3a3aa2" valign=top>
                <table border=0 width=100% height=100% cellpadding=5 cellspacing=3>
                <tr><td height=8%>
                <tr><td height=18% align=center><input type="text" name="account" placeholder="帳號" autofocus >
                <tr><td height=18% align=center><input type="password" name="password" placeholder="密碼" >
                <tr><td height=5%>
                <tr><td height=18% align=center><input type="button" class="btn_submit" value="確定" onclick="sendClick()">
                <tr><td height=5% align=center style="color:#ffffff;" id="errorMsg">
                <tr><td align="center" style="color:#ffffff;" valign=middle>版權所有：電子名片管理 Copyright 2022
                </table>
            </table>
        </form>
        
    </div>
    
    </body>
</html>