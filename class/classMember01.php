<?php
include_once('classMember.php');
class classMember01 extends classMember
{
    function __construct(){
        $this->Connect();
    }
    function work_showMore($whereStr,$orderByStr,$newpage,$divName='',$showKind){
        //分頁
        $myitem=$newpage*$this->data_showmore_number;
        $button_text=$myitem+1;
        $limitStr=$this->selectLimitNumberStr($newpage);
        
        $mystr="select * from work_file ".$whereStr." ".$orderByStr ." " . $limitStr;
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        
        echo $divName;
        echo "<table width=100% border=0 cellpadding=3 cellspacing=0 class='tableShowMore f13'>";
        echo "<thead><tr>";
        echo "<td width=3%>";
        echo "<td width=12%>圖片";
        echo "<td width=15%>" .$showKind. "標題";
        echo "<td>" .$showKind. "超連結";
        echo "<td width=12%>設計師";
        echo "</thead>";
        if($mynum <= 0){
            echo "<tr height=35px><td colspan=5 align=center class='red_d'>...查無資料...";
        }
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            $mypk=$myarr["work_file_id"];
            
            $mystr="select * from work_file_list where work_file_id='" .$mypk. "' order by sequence";
            $list_result=mysqli_query($this->link,$mystr);
            $list_arr=mysqli_fetch_array($list_result,1);
            
            $mystr="select * from designer where designer_id='" . $myarr["designer_id"] . "'";
            $designer_result=mysqli_query($this->link,$mystr);
            $designer_arr=mysqli_fetch_array($designer_result,1);
            
            echo "<tr>";
            echo "<td align=center><a href=\"javascript:openPicButtonClick('" .$myarr["work_file_id"]. "')\">預覽</a>";
            echo "<td align=center id='file_name_".$mypk. "'>";
            if($list_arr["file_name"] <>""){
                echo "<img src='../businessCard_img/" .$list_arr["file_name"]. "' style='width:100px;'>";
            }
            echo "<td id='display_name_".$mypk."'>".$myarr["display_name"];
            if($myarr["create_datetime"] <> ""){
                echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#999999;color:#ffffff;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                echo " 建檔日期 " .date("Y-m-d",strtotime($list_arr["create_datetime"]));
                echo "</div>";
            }
            if($myarr["dateline"] <> ""){
                echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#EBD6D6;color:#613030;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                echo " 截止日期 " .date("Y-m-d",strtotime($myarr["dateline"]));
                echo "</div>";
            }
            echo "<td id='url_".$mypk."'>".$list_arr["url"];
            echo "<td id='designer_" .$mypk."' valign=middle>";
            echo $designer_arr["designer_name"]."&nbsp;(" .$designer_arr["designer_account"]. ")";
            
            $button_text++;
        }
        
        echo "</table>";
    }//end member_showMore
    function showNameCardShowOne($mypk,$showKind,$divName=''){//編輯名片
        
        $mystr="select * from work_file where work_file_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        
        $mystr="select * from work_file_list where work_file_id='" .$mypk. "' order by sequence";
        $list_result=mysqli_query($this->link,$mystr);
        $list_num=mysqli_num_rows($list_result);
        $list_arr=mysqli_fetch_array($list_result,1);
        mysqli_data_seek($list_result,0);
        
        $member_id=$myarr["member_id"];
        $mystr="select * from member where member_id='" .$member_id. "' and member_id > 0";
        $member_result=mysqli_query($this->link,$mystr);
        $member_arr=mysqli_fetch_array($member_result);
        
        
        echo $divName;
        echo "<table width=100% height=100% border=0 cellpadding=5 cellspacing=0 class='black f13'>";
        echo "<tr height=8%><td align=center style='font-size:1.5em;'>".$myarr["display_name"];
        echo "<td width=12% align=center>";
        echo "<span class='btn_blue' onclick=\"closePicDivlick()\">關閉</span>";
        //         echo "<input type='button' class='btn_blue' value='關閉' onclick=\"closePicDivlick()\">";
        echo "<tr><td colspan=2 style='pading:0' valign=top>";
        for($i=0;$i<$list_num;$i++){
            $list_arr=mysqli_fetch_array($list_result,1);
            
            echo "<div style='float:left;width:32%;height:340px;background-color:#ffffff;margin-right:1%;margin-bottom:1%'>";
            echo "<table width=100% border=0 height=100% cellpadding=0 cellspacing=0>";
            echo "<tr><td height=270px align=center valign=middle>";
            if($list_arr["file_name"] <> ""){
                echo "<img src='../businessCard_img/" .$list_arr["file_name"]. "' style='width:100%;'>";
            }
            echo "<tr><td height=28px align=center valign=middle><div style='width:96%;border-radius:5px;background-color:#008000;color:#ffffff;height:28px;line-height:25px;'>".$list_arr["btn_name"]."</div>";
            echo "<tr><td >";
            echo "</table>";
            
            
            echo "</div>";
        }
        echo "</table>";
    }
}
?>