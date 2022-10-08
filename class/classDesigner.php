<?php
include_once('classMain.php');
class classDesigner extends classMain
{
    function __construct(){
        $this->Connect();
    }
    function designer_showOne($mypk,$divName=''){
        
        $showMsg="修改";   $titleStr=" align=right width=30%";
        if((int)$mypk <= 0){ $showMsg="新增"; }
        
        $readOnlyStr="";
        $designer_name="";  $designer_cell_phone="";  $designer_account=""; $designer_password=""; $update_datetime="";
        $mystr="select * from designer where designer_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        if(mysqli_num_rows($myresult) > 0){
            $myarr=mysqli_fetch_array($myresult,1);
            $designer_name=$myarr["designer_name"];
            $designer_cell_phone=$myarr["designer_cell_phone"];
            $designer_account=$myarr["designer_account"];
            $designer_password=$myarr["designer_password"];
            $update_datetime=$myarr["update_datetime"];
            $readOnlyStr="readonly";
        }
        
        echo $divName;
        echo "<br><form id='frmmain' name='frmmain' onsubmit='return false'>";
        echo "<table width=96% border=0 cellpadding=3 cellspacing=0 class='tableShowOne f13' align=center>";
        echo "<thead><tr><td align=center colspan=2 class='f15'>設計師資料" . $showMsg."</thead>";
        echo "<tr><td $titleStr>姓名 : <td>&nbsp;<input type='text' name='designer_name' value='" .$designer_name. "'>";
        echo "<tr><td $titleStr>手機號碼 : <td>&nbsp;<input type='text' name='designer_cell_phone' value='" .$designer_cell_phone. "'>";
        echo "<tr><td $titleStr>登入帳號 : <td>&nbsp;<input type='text' name='designer_account' value='" .$designer_account. "' $readOnlyStr>";
        if((int)$mypk > 0){
            echo "<tr><td $titleStr>登入密碼 : <td>&nbsp;<input type='password' name='designer_password' value='" .$designer_password. "'>";
            echo "<tr><td $titleStr>確認密碼 : <td>&nbsp;<input type='password' name='designer_password' value='" .$designer_password. "'>";
        }
        echo "<tr height=30px><td $titleStr>異動時間 : <td>".$update_datetime;
        echo "<tr><td align=center colspan=2>";
        echo "<input type='button' class='btn_pink' value='存檔並關閉'  onclick=\"updateButtonClick()\">";
        echo " &nbsp; <input type='button' class='btn_blue' value='關閉' onclick=\"closeDivClick()\">";
        echo "</table>";
        echo "<input type='hidden' name='designer_id' value='" .$mypk. "'>";
        echo "</form>";
    }//end designer_showOne
    function designer_showMore($whereStr,$orderByStr,$newpage,$divName='',$showKind){
        
        //分頁
        $myitem=$newpage*$this->data_showmore_number;
        $button_text=$myitem+1;
        $limitStr=$this->selectLimitNumberStr($newpage);
        
        $mystr="select * from designer ".$whereStr." ".$orderByStr ." " . $limitStr;
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        echo $divName;
        echo "<table width=100% border=0 cellpadding=3 cellspacing=0 class='tableShowMore f13'>";
        echo "<thead><tr><td width=3% align=center><td width=3% align=center>筆數";
        echo "<td width=5%>帳號";
        echo "<td width=15%>設計師姓名";
        echo "<td width=12%>手機號碼";
        echo "<td width=12%>異動時間";
        echo "<td>";//電子名片";
        
        echo "</thead>";
        if($mynum <= 0){
            echo "<tr height=35px><td colspan=8 align=center class='red_d'>...查無資料...";
        }
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            $mypk=$myarr["designer_id"];
            
            echo "<tr><td align=center valign=middle id='edit_" .$mypk. "' ><span class='material-symbols-outlined' onclick=\"openButtonClick('" .$mypk. "')\" style='cursor:pointer;font-size:20px'>edit</span>";//<input type='button' class='btn_qty_pink' value='".$button_text."' onclick=\"openButtonClick('" .$mypk. "')\">";
            echo "<td align=center id='item_" .$mypk. "' >".$button_text;
            echo "<td id='designer_account_" .$mypk. "'>".$myarr["designer_account"];
            echo "<td id='designer_name_" .$mypk. "' >".$myarr["designer_name"];
            echo "<td id='designer_cellPhone_" .$mypk. "' >".$myarr["designer_cell_phone"];
            echo "<td width=12%>".$myarr["update_datetime"];
            echo "<td>";
            $button_text++;
        }
        
        echo "</table>";
    }//end designer_showMore
    function designer_showOneTR($mypk){
        
        $mystr="select * from designer where designer_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        if((int)$myarr["designer_id"] <= 0){
            echo "[!@#]edit_" .$mypk. "<span></span>";
            echo "[!@#]item_" .$mypk. "<span>刪除</span>";
        }
        echo "[!@#]designer_account_" .$mypk. "<span>".$myarr["designer_account"]."</span>";
        echo "[!@#]designer_name_" .$mypk. "<span>".$myarr["designer_name"]."</span>";
        echo "[!@#]designer_cellPhone_" .$mypk. "<span>".$myarr["designer_cell_phone"]."</span>";
        
    }
    function getWorksData($designer_id,$category='名片'){
        
        $dataArr=array();
        $mystr="select * from work_file where category='" .$category. "' and designer_id='" .$designer_id. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            array_push($dataArr,$myarr);
        }
        return $dataArr;
    }
}
?>