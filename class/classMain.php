<?php
include_once('classLink.php');
class classMain extends classLink
{
    var $menuArr=array("電子名片"=>array("designerList","memberList","memberList01"),"電子喜帖"=>array("designerList2","memberList2","memberList012"));
    var $iconArr=array("電子名片"=>array("badge","background_replace"),"電子喜帖"=>array("badge","background_replace"));
    var $titleImgArr=array("電子名片"=>"co_present","電子喜帖"=>"article");
    var $pagePowerArr=array("sysadmin"=>array("designerList","memberList","designerList2","memberList2"),"admin"=>array("designerList","memberList","designerList2","memberList2"),
                            "designer"=>array("memberList","memberList2"),"member"=>array("memberList01","memberList012"));
    var $pageName=array("designerList"=>"設計師管理清單","memberList"=>"會員管理清單","memberList01"=>"電子名片清單","designerList2"=>"設計師管理清單","memberList2"=>"會員管理清單","memberList012"=>"電子喜帖清單");
    function __construct(){
        
        $this->Connect();
    }
    
    function sessionGetValue($ss){
        
        if (!isset($_SESSION[$ss . $this->sysSessionAddName])){$_SESSION[$ss . $this->sysSessionAddName]="";}
        $ret_str=$_SESSION[$ss . $this->sysSessionAddName];
        return $ret_str;
    }
    function head(){
        session_start();
        $checkFlag="ok";
        if(!isset($_SESSION["session_login_kind" . $this->sysSessionAddName])){ $checkFlag="error"; }
        
        if($checkFlag!="ok"){
            echo "<script language='javascript'>";
            echo "location.href='login.php';";
            echo "</script>";
            exit;
        }else{
            echo "<!DOCTYPE html><html style='height:100%'><head>";
            echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">";
            echo "<meta http-equiv=\"pragma\" content=\"no-cache\">";
            echo "<meta http-equiv=\"cache-control\" content=\"max-age=0\" />";
            echo "<meta http-equiv=\"cache-control\" content=\"no-cache\" />";
            echo "<meta http-equiv=\"expires\" content=\"-1\" />";
            echo "<link rel='shortcut icon' href='./img/logo.jpg'>";
            echo "<link rel='image_src' href='' type='image/png'>";
            echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0' />";
            echo "<link rel='preconnect' href='https://fonts.googleapis.com'>";
            echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>";
            echo "<link href='https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100&display=swap' rel='stylesheet'>";
            echo "<link href='https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500&family=Noto+Serif+TC:wght@200&display=swap' rel='stylesheet'>";
            echo "<link href='./css/main.css?" .date("YmdHis"). "' rel='stylesheet' type='text/css' />";
            echo "<title>(" .$this->sessionGetValue("session_name"). ")電子名片管理</title>";
            echo "</head>";
        }
    }//end head
    function body($nowPage,$leftMenu=''){
        $pageName=$this->pageName[str_replace(".php","",$nowPage)];
        include_once("./js/main.js");
        include_once("./js/script.js");
        
        echo "<body style='height:100%;background-color:#efefef;margin:0;'>";
        echo "<div style='width:13%;height:100%;float:left;background-color:#424242' id='menuDiv'>";
        $this->menuShow($nowPage);
        echo "</div>";
        echo "<div style='width:87%;height:100%;float:left;'>";
        echo "<div id='changePwdDiv' style='position:fixed;width:500px;height:350px;border:1px #ff9807 solid;top:20%;left:40%;z-index:999;background-color:#DDDDDD;border-radius:8px;box-shadow:8px 8px 10px gray;z-index:999;display:none;'></div>";
        echo "<table width='100%' height='100%' border=0px cellpadding=0 cellspacing=0 class='main-table'>";
        echo "<tr height=5%><td style='background-color:#dfdfdf;' valign=middle>&emsp;<span class='material-symbols-outlined' style='font-size:20px;vertical-align:middle'>list_alt</span>&nbsp; ".$pageName;
        echo "<tr><td valign=top style='padding:1%;'>";
    }//end of body function
   
    function body_end(){
        echo "<tr height='5%'><td style='padding:0px;padding:5px' colspan=4 align=right>";
        echo "<font style='color:#666666;font-size:10px;'>版權所有：電子名片管理 Copyright 2022</font>";
        echo "</table>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
    function menuShow($nowPage,$divName=''){
        
        $nowPageArr=$this->pagePowerArr[$this->sessionGetValue("session_login_kind")];
        $nowPageKind=str_replace(".php","",$nowPage);
        $checkArr=array();
        echo $divName;
        echo "<table width=100% border=0 height=100% cellpadding=5 cellspacing=0 style='color:#ffffff;'>";
        echo "<tr height=5%><td valign=middle align=center style='font-size:20px;color:#ffc107;'><span class='material-symbols-outlined' style='vertical-align:bottom;'>dataset</span> &nbsp;電子名片管理";
        echo "<tr height=5%><td valign=bottom align=right style='font-size:13px;border-top:1px #EFEFEF solid;border-bottom:1px #EFEFEF solid;'>".$this->sessionGetValue("session_name");
        echo "&emsp;<span style='cursor:pointer;' onclick=\"changePassword()\">修改密碼</span>";
        echo "&emsp;<span style='cursor:pointer;' onclick=\"logoutClick()\">登出</span>";
        echo "<tr><td valign=top>";
        if(count($nowPageArr) > 0){
            foreach($this->menuArr as $key => $valeArr){
                $chkQty=0;
                for($j=0;$j<count($valeArr);$j++){
                    for($i=0;$i<count($nowPageArr);$i++){
                        if($valeArr[$j] == $nowPageArr[$i]){
                            if(!isset($checkArr[$key])){ $checkArr[$key]=array(); }
                            array_push($checkArr[$key],$nowPageArr[$i]);
                        }
                    }
                }
                
            }
        }
        foreach($checkArr as $titleName => $pageValue){
            echo "<div style='width:100%;'>";
            echo "<table width=100%  border=0 cellpadding=3 cellspacing=0>";
            echo "<tr><td width=10%>";
            echo "<td><span class='material-symbols-outlined' style='vertical-align:middle'>" .$this->titleImgArr[$titleName]. "</span> &nbsp;".$titleName;
            
            echo "</table>";
            for($i=0;$i<count($pageValue);$i++){
                if(!isset($this->pageName[$pageValue[$i]])){ continue; }
                $pageName=$this->pageName[$pageValue[$i]];
                
                $url=$pageValue[$i].".php";  $showKind="nameCard";  
                switch($pageValue[$i]){
                    case "designerList2":
                    case "memberList2":
                        $url=substr($pageValue[$i],0,-1).".php";
                        $showKind="wedding";
                        break;
                    case "memberList012":
                        $url=substr($pageValue[$i],0,-1).".php";
                        $showKind="wedding";
                        break;
                }
                
                $iconStr="";  $onclickStr="onclick=\"changePageClick('" .$url. "','" .$showKind. "')\"";  $styleStr="style='cursor:pointer;' class='menuList'";
                if($nowPageKind == $pageValue[$i]){ $iconStr="<span class='material-symbols-outlined' style='font-size:20px;vertical-align:middle'>arrow_right</span>"; $onclickStr=""; $styleStr="";}
                echo "<table width=100% border=0 cellpadding=3 cellspacing=0>";
                echo "<tr><td width=20% align=right>".$iconStr;
                echo "<td><span class='material-symbols-outlined' style='vertical-align:middle'>" .$this->iconArr[$titleName][$i]. "</span> &nbsp; <span $onclickStr $styleStr>".$pageName."</span>";
                echo "</table>";
            }
            
            echo "</div>";
        }
            
        echo "</table>";
    }
    
    function selectLimitNumberStr($pageNew=0)
    {
        $limit_str="";
        if($pageNew==0){
            $limit_str=" limit " . $this->data_showmore_number;
        }else{
            $aa=$pageNew*$this->data_showmore_number;
            $limit_str=" limit " . $aa . "," . $this->data_showmore_number;
        }
        return $limit_str;
    }
    function countMorePage($totalNumber='0')
    {
        $returnTotalPage=0;
        $returnTotalPage=floor($totalNumber / $this->data_showmore_number);
        if($totalNumber % $this->data_showmore_number>0){ $returnTotalPage=$returnTotalPage+1; }
        return $returnTotalPage;
    }
    function new_showPageTable($hiddenArray,$hiddenArrValue,$pageTotal=0,$pageText=0,$pageNew=0)
    {
        $one_page="第一頁"; $up_page="上頁"; $down_page="下頁"; $last_page="最終頁";
        //查詢完預設 show 第一頁
        if($pageTotal>0 && $pageNew==0){ $pageNew=1; }
        if($pageText>0){$pageText=$pageNew-1;}
        //--------
        echo "<br><form name='form_page' id='form_page' method=post onsubmit='return false'>";
        echo "<table id='page_table' width=100% border=0><tr><td align=right>";
        echo "<input type=hidden name='page_total' value='$pageTotal'>";
        echo "<input type=hidden name='page_text' value='$pageText'>";
        echo "<input type=hidden name='page_new' value='$pageNew'>";
        for ($k=0;$k<count($hiddenArray);$k++){
            echo "<input type=hidden name='" . $hiddenArray[$k] . "' id='" . $hiddenArray[$k] . "' value='" . $hiddenArrValue[$k] . "'>";
        }
        if($pageTotal>1){
            echo "<img src='img/first_1.png' onclick=\"pageButtonClick('0');\">";
            echo "&nbsp;<img src='img/left_1.png' onclick=\"pageButtonClick('".($pageText-1)."');\">";
            echo "<td width=10% align=center><input type=hidden name='show_page' id='show_page' value='P : " . $pageNew . " / " . $pageTotal . "'>";
            echo " &nbsp;<font class='green f13'>P : " . $pageNew . " / " . $pageTotal . "</font>";
            echo "<td align=left> &nbsp;<img src='img/right_1.png' onclick=\"pageButtonClick('".$pageNew."');\">";
            echo "&nbsp;<img src='img/last_1.png' onclick=\"pageButtonClick('".($pageTotal-1)."');\">";
        }
        else{
            if((int)$pageTotal==0){ $pageNew=0; }
            echo "&nbsp;<img src='img/first_1.png' onclick=\"pageButtonClick('0');\" width=20px>";
            echo "&nbsp;<img src='img/left_1.png' onclick=\"pageButtonClick('".$pageText."');\" width=20px>";
            echo "<td width=10% align=center><input type=hidden name='show_page' id='show_page' value='P : " . $pageNew . " / " . $pageTotal . "'>";
            echo " &nbsp;<font class='green f13'>P : " . $pageNew . " / " . $pageTotal . "</font>";
            echo "<td align=left> &nbsp;<img src='img/right_1.png'  onclick=\"pageButtonClick('".$pageNew."');\" width=20px>";
            echo "&nbsp;<img src='img/last_1.png'  onclick=\"pageButtonClick('".($pageTotal-1)."');\" width=20px>";
        }
        echo "</tr></table></form>";
        
    }
    function openBody($myTitle='',$bgColor='#ECF0F5'){
        //session_start();
        if ($myTitle==""){$myTitle=$this->web_name;}
        echo "<!DOCTYPE html><html><head>";
        echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">";
        echo "<meta http-equiv='pragma' content='no-cache' />";
        echo "<meta http-equiv=\"cache-control\" content=\"max-age=0\" />";
        echo "<meta http-equiv=\"cache-control\" content=\"no-cache\" />";
        echo "<meta http-equiv=\"expires\" content=\"-1\" />";
        echo "<link rel='shortcut icon' href='./images/minp.ico'>";
        echo "<link rel='image_src' href='' type='image/png'>";
        echo "<link rel=stylesheet type='text/css' href='./css/main.css?" .date("is"). "'>";
        echo "<title>(".$this->sessionGetValue("c_name").")".$myTitle."</title>";
        echo "</head>";
        include_once("./js/main.js");
        include_once("./js/script.js");
        echo "<body style='background-color:" .$bgColor. ";'><center>";
        
        echo "<div id='showDiv' style='position:fixed;width:98%;margin:0% ;background-color:#ffffff;color:#666666;z-index:999;height:98%;display:none;overflow:auto;'></div>";
        echo "<div class='winBodyDiv'>";
        echo "<br>";
        echo "<span id='checkSpan'><input type='hidden' id='logoutCheck' value='no'></span>";
    }
    function openEnd(){
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
    //計算有幾月
    function sum_month($from,$to)
    {
        $returnFlag=0;
        $mystr="SELECT TIMESTAMPDIFF(MONTH, '".$from."', '".substr($to,0,7)."-01')";
        $month_result=mysqli_query($this->link,$mystr);
        $month_row=mysqli_fetch_row($month_result);
        if((int)$month_row[0]<0){
            $returnFlag=((int)$month_row[0]*-1)+1;
        }
        else{
            $returnFlag=(int)$month_row[0]+1;
        }
        return $returnFlag;
    }
    //check 是否為有效日期
    function mpCheckDate($myDate)
    {
        $returnFlag=true;
        $yearStr=substr($myDate,0,4);
        $monthStr=substr($myDate,4,2);
        $dateStr=substr($myDate,6,2);
        if(strlen($myDate)==10){
            $monthStr=substr($myDate,5,2);
            $dateStr=substr($myDate,8,2);
        }
        $returnFlag=checkdate($monthStr,$dateStr,$yearStr);
        
        return $returnFlag;
    }//mpCheckDate
    //日期格式如果輸入 8 碼,後端補 -
    function checkInputDateStr($inputDate)
    {
        $returnDate=$inputDate;
        if(strlen($inputDate)==8){
            $returnDate=substr($inputDate,0,4)."-".substr($inputDate,4,2)."-".substr($inputDate,6,2);
        }
        return $returnDate;
    }//checkInputDateStr
    function getTableEmptyData($table_name){
        $data_arr=array();
        $mystr="desc ".$table_name;
        $my_result=mysqli_query($this->link,$mystr);
        $my_num=mysqli_num_rows($my_result);
        for($ii=0;$ii<$my_num;$ii++){
            $my_arr=mysqli_fetch_array($my_result);
            switch(substr($my_arr["Type"],0,3)){
                case "int":
                    $data_arr[$my_arr["Field"]]=0;
                    break;
                case "dou"://double
                    $data_arr[$my_arr["Field"]]=0;
                    break;
                case "flo"://float
                    $data_arr[$my_arr["Field"]]=0;
                    break;
                default :
                    $data_arr[$my_arr["Field"]]="";
                    break;
            }
        }
        return $data_arr;
    }//getTableEmpptyData
}
?>