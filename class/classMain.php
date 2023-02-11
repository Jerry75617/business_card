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
            echo "location.href='index.php';";
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
        
        include_once("./js/main.js");
        include_once("./js/script.js");
        echo "<body style='height:100%;background-color:#efefef;margin:0;'>";
        
        switch($nowPage){
            case "liff_share.php":
                
                
                echo "<div style='width:100%;height:100%;float:left;'>";
                echo "<table width='100%' height='100%' border=0px cellpadding=0 cellspacing=0 class='main-table'>";
                echo "<tr height=5%><td style='background-color:#dfdfdf;' valign=middle>";
                echo "<tr><td valign=top style='padding:1%;'>";
                break;
            default:
                $pageName=$this->pageName[str_replace(".php","",$nowPage)];
                echo "<div style='height:100%;width:100%;'>";
                echo "<div id='changePwdDiv' style='position:fixed;width:300px;height:400px;border:1px #E9CCCD solid;top:20%;left:40%;z-index:999;background-color:#E9CCCD;border-radius:0px;box-shadow:8px 8px 10px gray;z-index:999;display:none;'></div>";
                echo "<table width=100% height=100% border=0 cellpadding=3 cellspacing=0 class='black f13'>";
                echo "<tr ><td height=40px colspan=2 style='font-size:20px;color:#FFFFFF;padding-left:20px;background-color:#CD939D;'>";
                    echo "<span class='material-symbols-outlined' style='vertical-align:bottom;'>menu</span> 電子名片管理";
                echo "<tr><td width=15% valign=top style='padding:0px;'>";
                    echo "<div style='width:100%;height:100%;float:left;background-color:#FFFFFF;display:block;' id='menuDiv'>";
                    $this->menuShow($nowPage);
                    echo "</div>";
                echo "<td style='padding:5px 15px;' valign=top>";
                /*
                
                echo "<div style='width:2%;height:100%;float:left;background-color:#424242;text-align:center;color:#ffc107;display:none;' id='menuSmallDiv'>";
                echo "<span class='material-symbols-outlined' style='font-size:30px;vertical-align:middle;curspor:pointer;' onclick=\"closeMenu('open')\">arrow_right</span><br>選<br>單 </div>";
                echo "<div style='width:87%;height:100%;float:left;' id='shoeBodyContentDiv'>";
                    
                    //上標題
                    echo "<div style='height:5%;background-color:#E9CCCD;color:#CD939D;line-height:30px;'>";
                        echo "&emsp;<span class='material-symbols-outlined' style='font-size:20px;vertical-align:middle;'>list_alt</span>&nbsp; ".$pageName;
                    echo "</div>";
                    //內容
                    echo "<div style='height:90%;width:100%;overflow:auto;'>";
                        echo "<table width='100%' height='100%' border=0px cellpadding=0 cellspacing=0 class='main-table'>";
        //                 echo "<tr height=5%><td style='background-color:#E9CCCD;color:#CD939D;' valign=middle>&emsp;<span class='material-symbols-outlined' style='font-size:20px;vertical-align:middle'>list_alt</span>&nbsp; ".$pageName;
                        echo "<tr><td valign=top style='padding:1%;background-color:#F3E4E7;'>";
                */
                break;
        }
        
        
    }//end of body function
   
    function body_end(){
        echo "</table>";
        echo "</div>";
        /*
                echo "</table>";
            echo "</div>";
            //結尾
            echo "<div style='height:5%;padding-right:5px;background-color:#F3E4E7;text-align:right;bottom:0px;'>";
                echo "<font style='color:#666666;font-size:10px;'>版權所有：電子名片管理 Copyright 2022</font>";
            echo "</div>";
        echo "</div>";
        */
        echo "</body>";
        echo "</html>";
    }
    function menuShow($nowPage,$divName=''){
        
        $nowPageArr=$this->pagePowerArr[$this->sessionGetValue("session_login_kind")];
        $nowPageKind=str_replace(".php","",$nowPage);
        $checkArr=array();
        
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
        
        echo $divName;
        echo "<table width=100% border=0 height=100% cellpadding=5 cellspacing=0 style='color:#666666;'>";//#E9CCCD;
//         echo "<tr height=5%><td valign=middle align=center style='font-size:20px;color:#666666;'>";
//         echo "<span class='material-symbols-outlined' style='font-size:30px;vertical-align:bottom;curspor:pointer;' onclick=\"closeMenu('close')\">arrow_left</span>";
//         echo "<span class='material-symbols-outlined' style='vertical-align:bottom;'>dataset</span> 電子名片管理";
// 		echo "<tr height=5%><td valign=middle align=center style='font-size:13px;color:#999999;'>".$this->sessionGetValue("session_name");
        echo "<tr height=5%><td valign=bottom align=right style='font-size:13px;border-top:1px #E9CCCD solid;border-bottom:1px #E9CCCD solid;'>";
        echo "<span>" .$this->sessionGetValue("session_name"). "</span>";
        echo "&emsp;<span style='cursor:pointer;' onclick=\"changePassword()\">修改密碼</span>";
        echo "&emsp;<span style='cursor:pointer;' onclick=\"logoutClick()\">登出</span>";
        echo "<tr><td valign=top style='padding:0px 5px;'>";
        
        foreach($checkArr as $titleName => $pageValue){
            $url=$pageValue[0].".php";  $showKind="nameCard";  $leftIcon="<span style='font-size:20px;' class='material-symbols-outlined'>chevron_right</span>";
            switch($pageValue[0]){
                case "designerList2":
                case "memberList2":
                    $url=substr($pageValue[0],0,-1).".php";
                    $showKind="wedding";
                    break;
                case "memberList012":
                    $url=substr($pageValue[0],0,-1).".php";
                    $showKind="wedding";
                    break;
            }
            
            $displayStr="display:none;";
            if (in_array( $nowPageKind, $checkArr[$titleName], true)) {
                $displayStr="";
                $leftIcon="<span style='font-size:20px;' class='material-symbols-outlined'>expand_more</span>";
            }
            
            echo "<div style='width:100%;'>";
            echo "<table width=100% border=0 cellpadding=3 cellspacing=0>";
            echo "<tr onclick=\"changePageClick('" .$url. "','" .$showKind. "')\" style='cursor:pointer;'><td width=20% align=right>";
                echo "<span class='material-symbols-outlined' style='vertical-align:middle'>" .$this->titleImgArr[$titleName]. "</span>";
            echo "<td height=30px>".$titleName;
            echo "<td width=20% align=center>".$leftIcon;
            
            
            echo "<tr style='" .$displayStr. "'><td style='background-color:#EFEFEF;padding:0px;' colspan=3>";
            
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
                $nowKindStr="";
                $iconStr="";  $onclickStr="onclick=\"changePageClick('" .$url. "','" .$showKind. "')\"";  $styleStr="style='cursor:pointer;' class='menuList' ";
                if($nowPageKind == $pageValue[$i]){ 
                    $iconStr="<span class='material-symbols-outlined' style='font-size:20px;vertical-align:middle'>arrow_right</span>";
                    $onclickStr="";
                    $styleStr="";
                    $nowKindStr="background-color:#E9CCCD;border-radius:5px;color:#222222;";
                }
                echo "<div style='" .$nowKindStr. ";padding:10px 0px 10px 35px;'><span $onclickStr $styleStr>".$pageName."</span>";
//                 echo "<table width=100% border=1 cellpadding=3 cellspacing=0>";
//                 echo "<tr><td width=20% align=right>".$iconStr;
//                 echo "<tr><td><span class='material-symbols-outlined' style='vertical-align:middle'>" . "</span> &nbsp; <span $onclickStr $styleStr>".$pageName."</span>";
//                 echo "</table>";
                echo "</div>";
            }
            echo "</table>";
            
            
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