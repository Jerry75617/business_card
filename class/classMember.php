<?php
include_once('classMain.php');
class classMember extends classMain
{
    function __construct(){
        $this->Connect();
    }
	

    function member_showOne($mypk,$divName=''){
        
        $showMsg="修改";   $titleStr=" align=left";
        if((int)$mypk <= 0){ $showMsg="新增"; }
        
        $member_name="";  $member_account="";  $url="";  $dateline="";  $update_datetime="";
        $mystr="select * from member where member_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        if(mysqli_num_rows($myresult) > 0){
            $myarr=mysqli_fetch_array($myresult,1);
            $member_name=$myarr["member_name"];
            $member_account=$myarr["member_account"];
            $url="";
            $dateline=$myarr["dateline"];
            $update_datetime=$myarr["update_datetime"];
        }
        
        echo $divName;
        echo "<br><form id='frmmain' name='frmmain' onsubmit='return false'>";
        echo "<table width=90% border=0 cellpadding=3 cellspacing=0 class='tableShowOne f13' align=center>";
        echo "<thead><tr><td align=center colspan=2 class='f15'>會員資料" . $showMsg."</thead>";
        echo "<tr><td $titleStr>會員姓名 : ";
        echo "<tr><td><input type='text' name='member_name' value='" .$member_name. "' style='width:100%'>";
        echo "<tr><td $titleStr>登入帳號 : ";
        echo "<tr><td><input type='text' name='member_account' value='" .$member_account. "' style='width:100%'>";
        if((int)$mypk > 0){
            echo "<tr><td $titleStr>登入密碼 : ";
            echo "<tr><td><input type='password' name='member_password' value='' style='width:100%'>";
            echo "<tr><td $titleStr>確認密碼 : ";
         echo "<tr><td><input type='password' name='check_password' value='' style='width:100%'>";
        }
        echo "<tr><td $titleStr>超連結 : ";
        echo "<tr><td><input type='text' name='url' value='" .$url. "' style='width:100%'>";
        echo "<tr><td $titleStr>有效日期 : ";
        echo "<tr><td><input type='date' name='dateline' value='" .$dateline. "' style='width:100%'>";
        echo "<tr><td $titleStr>異動日期 : ";
        echo "<tr><td>".$update_datetime;
        
        echo "<tr><td align=center colspan=2>";
        echo "<span class='btn_pink' onclick=\"updateButtonClick()\">存檔並關閉</span>";
        if((int)$mypk > 0){
            echo "<span class='btn_red' onclick=\"deleteMemberClick('" .$mypk. "')\">刪除資料</span>";
        }
        echo "<span class='btn_blue' onclick=\"closeDivClick()\">關閉</span>";
        echo "</table>";
        echo "<input type='hidden' name='member_id' value='" .$mypk. "'>";
        echo "</form>";
    }//end member_showOne
    function member_showMore($whereStr,$orderByStr,$newpage,$divName='',$showKind){
        
        //分頁
        $myitem=$newpage*$this->data_showmore_number;
        $button_text=$myitem+1;
        $limitStr=$this->selectLimitNumberStr($newpage);
        
        $mystr="select * from member ".$whereStr." ".$orderByStr ." " . $limitStr;
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        
        echo $divName;
        echo "<table width=100% border=0 cellpadding=3 cellspacing=0 class='tableShowMore f13'>";
        echo "<thead><tr><td width=3% align=center><td width=4% align=center>筆數";
        echo "<td width=12%>會員姓名";
        echo "<td width=12%>設計師";
        echo "<td width=3%>功能   ";
        echo "<td width=12%>圖片";
        echo "<td width=15%>" .$showKind. "標題";
        echo "<td>" .$showKind. "分享超連結";
//         echo "<td width=12%>設計師";
        echo "</thead>";
        if($mynum <= 0){
            echo "<tr height=35px><td colspan=8 align=center class='red_d'>...查無資料...";
        }
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            $mypk=$myarr["member_id"];
            
            
            $dataArr=$this->getWorksData($myarr["member_id"],$myarr["designer_id"],$showKind);
            
            $rowSpanQty=1;
            if(count($dataArr) > 0){  $rowSpanQty=count($dataArr);  }

            $mystr="select * from designer where designer_id='" .$myarr["designer_id"]. "'";
            $designer_result=mysqli_query($this->link,$mystr);
            $designer_arr=mysqli_fetch_array($designer_result,1);
            
            
            echo "<tr><td align=center valign=middle id='edit_" .$mypk. "' rowspan='" .$rowSpanQty. "'><span class='material-symbols-outlined' onclick=\"openButtonClick('" .$mypk. "')\" style='cursor:pointer;font-size:20px'>edit</span>";//<input type='button' class='btn_qty_pink' value='".$button_text."' onclick=\"openButtonClick('" .$mypk. "')\">";
            echo "<td align=center id='item_" .$mypk. "' rowspan='" .$rowSpanQty. "' valign=middle>".$button_text;
            echo "<td id='member_name_" .$mypk. "' rowspan='" .$rowSpanQty. "' valign=middle>".$myarr["member_name"]."(" .$myarr["member_account"]. ")";
            echo "<td id='designer_" .$mypk. "' rowspan='" .$rowSpanQty. "' valign=middle>";
            switch($this->sessionGetValue("session_login_kind")){
                case "sysadmin":
                case "admin":
                    $designerName="尚未指派";   $designerAccount="";
                    if($designer_arr["designer_name"] <> ""){
                        $designerName=$designer_arr["designer_name"];
                    }
                    if($designer_arr["designer_account"] <> ""){
                        $designerAccount=$designer_arr["designer_account"];
                    }
                    
                    echo "<a href=\"javascript:assignDesignerClick('" .$myarr["member_id"]. "','" .$myarr["designer_id"]. "')\">".$designerName."&nbsp;(" .$designerAccount. ")</a>";
                    break;
                default:
                    echo $designer_arr["designer_name"]."&nbsp;(" .$designer_arr["designer_account"]. ")";
                    break;
            }
            
            
            if(count($dataArr) <= 0){
                echo "<td id=''>";
                echo "<td id='file_name_".$mypk. "'>";
                echo "<td id=''>";
                echo "<td id=''>";
//                 echo "<td id='designer_" .$mypk. "' valign=middle>";
            }else{
                
                for($j=0;$j<count($dataArr);$j++){
                    $work_arr=$dataArr[$j];
                    
                    if($j>0){ echo "<tr>"; }
                    echo "<td align=center id='fnBtn_".$mypk."_".$work_arr["work_file_id"]. "'>";
                    echo "<span class='material-symbols-outlined' title='編輯' onclick=\"openPicButtonClick('" .$work_arr["work_file_id"]. "')\" style='cursor:pointer;font-size:28px;'>edit_square</span>";
                    echo "<br><span class='material-symbols-outlined' title='展期' onclick=\"extendClick('" .$work_arr["work_file_id"]. "')\" style='cursor:pointer;font-size:28px;'>edit_calendar</span>";
                    if((int)$work_arr["work_file_id"] > 0){
                        echo "<br><span class='material-symbols-outlined' title='刪除名片' onclick=\"deleteCardClick('" .$work_arr["work_file_id"]. "','" .$myarr["member_id"]. "')\" style='cursor:pointer;font-size:28px;'>delete</span>";
                    }
                    echo "<span class='material-symbols-outlined' title='分享' onclick=\"openUrl('".$work_arr["work_file_id"]."')\" style='cursor:pointer;font-size:28px;'>ios_share</span></a>";

                    echo "<td align=center id='file_name_".$mypk."_".$work_arr["work_file_id"]. "'>";
                    if($work_arr["file_name"] <>""){
                        echo "<img src='../businessCard_img/" .$work_arr["file_name"]. "' style='width:100px;'>";
                    }
                    echo "<td id='display_name_".$mypk. "_".$work_arr["work_file_id"]. "'>".$work_arr["display_name"];
                    if($work_arr["create_datetime"] <> ""){
                        echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#999999;color:#ffffff;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                        echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                        echo " 建檔日期 " .date("Y-m-d",strtotime($work_arr["create_datetime"]));
                        echo "</div>";
                    }
                    if($work_arr["dateline"] <> ""){
                        echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#EBD6D6;color:#613030;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                        echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                        echo " 截止日期 " .date("Y-m-d",strtotime($work_arr["dateline"]));
                        echo "</div>";
                    }
                    
                    echo "<td id='url_".$mypk. "_".$work_arr["work_file_id"]. "'>";
                    echo "<span class='material-symbols-outlined' title='複製' onclick=\"copyEvent('copy_url_" .$mypk."')\">content_copy</span>";
                    echo " &nbsp; <span id='copy_url_" .$mypk. "'>https://liff.line.me/1657623497-DZyKpqOL?mypk=".$work_arr["work_file_id"]."</span>";
                    //.$work_arr["url"];
                    
                }
                
            }
            $button_text++;
        }
        
        echo "</table>";
    }//end member_showMore
    
    function getWorksData($member_id,$designer_id,$category='名片'){
        
        $dataArr=array(); //只要看得到那位會員就看得到所有的名片內容
        $mystr="select * from work_file where category='" .$category. "' and member_id='" .$member_id. "'";// and designer_id='" .$designer_id. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            
            $mystr="select * from work_file_list where work_file_id='" .$myarr["work_file_id"]. "' order by sequence";
            $list_result=mysqli_query($this->link,$mystr);
            $list_num=mysqli_num_rows($list_result);
            if($list_num <= 0){
                $list_arr=$this->getTableEmptyData("work_file_list");
            }else{
                $list_arr=mysqli_fetch_array($list_result,1);
            }
            
            $designer_name="尚未指派";  $designer_bid=""; $update_datetime="";
            $mystr="select * from designer where designer_id='" . $myarr["designer_id"] . "'";
            $designer_result=mysqli_query($this->link,$mystr);
            if(mysqli_num_rows($designer_result) > 0){
                $designer_arr=mysqli_fetch_array($designer_result,1);
                $designer_name=$designer_arr["designer_name"];
                $designer_bid=$designer_arr["designer_account"];
                $update_datetime=$designer_arr["update_datetime"];
            }
            
            $myarr["designer_name"]=$designer_name;
            $myarr["designer_account"]=$designer_bid;
            $myarr["file_name"]=$list_arr["file_name"];
            $myarr["url"]=$list_arr["url"];
            $myarr["list_update_datetime"]=$update_datetime;
            array_push($dataArr,$myarr);
            
        }
        return $dataArr;
    }
    function member_showOneTR($mypk,$showKind){
        
        $mystr="select * from member where member_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        
        $designer_name="尚未指派";  $designer_account="";
        $mystr="select * from designer where designer_id='" . $myarr["designer_id"] . "'";
        $designer_result=mysqli_query($this->link,$mystr);
        if(mysqli_num_rows($designer_result) > 0){
            $designer_arr=mysqli_fetch_array($designer_result,1);
            $designer_name=$designer_arr["designer_name"];
            $designer_account=$designer_arr["designer_account"];
        }
        
        $dataArr=$this->getWorksData($myarr["member_id"],$myarr["designer_id"],$showKind);
        
        if((int)$myarr["member_id"] <= 0){
            echo "[!@#]edit_" .$mypk. "<span></span>";
            echo "[!@#]item_" .$mypk. "<span>刪除</span>";
        }
        echo "[!@#]member_name_" .$mypk. "<span>";
        echo $myarr["member_name"];
        if($myarr["member_account"] <> ""){
            echo "(" .$myarr["member_account"]. ")";
        }
        echo "</span>";
        echo "[!@#]designer_".$mypk. "<span>";
        switch($this->sessionGetValue("session_login_kind")){
            case "sysadmin":
            case "admin":
                if($myarr["designer_id"] > 0){
                    echo "<a href=\"javascript:assignDesignerClick('" .$myarr["member_id"]. "','" .$myarr["designer_id"]. "')\">".$designer_name."&nbsp;(" .$designer_account. ")</a>";
                }
                break;
            default:
                echo $designer_name."&nbsp;(" .$designer_account. ")";
                break;
        }
        echo "</span>";
        for($j=0;$j<count($dataArr);$j++){
            $work_arr=$dataArr[$j];
            
            echo "[!@#]file_name_".$mypk."_".$work_arr["work_file_id"]. "<span>";
            if($work_arr["file_name"] <>""){
                echo "<img src='../businessCard_img/" .$work_arr["file_name"]. "' style='width:100px;'>";
            }
            echo "</span>";
            echo "[!@#]display_name_".$mypk."_".$work_arr["work_file_id"]. "<span>".$work_arr["display_name"];
            if($work_arr["create_datetime"] <> ""){
                echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#999999;color:#ffffff;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                echo " 建檔日期 " .date("Y-m-d",strtotime($work_arr["create_datetime"]));
                echo "</div>";
            }
            if($work_arr["dateline"] <> ""){
                echo "<div style='width:160px;font-size:13px;border-radius:5px;background-color:#EBD6D6;color:#613030;text-align:center;line-height:15px;padding:1% 0.5%;margin-top:5%;vertical-align:bottom;'>";
                echo "<span class='material-symbols-outlined' style='font-size:15px;vertical-align:bottom;'>calendar_month</span>";
                echo " 截止日期 " .date("Y-m-d",strtotime($work_arr["dateline"]));
                echo "</div>";
            }
            echo "</span>";
//             echo "[!@#]url_".$mypk."_".$work_arr["work_file_id"]. "<span>".$work_arr["url"]."</span>";
        }
        
        
//         echo "[!@#]works_" .$mypk. "<span></span>";
//         echo "[!@#]designer_".$mypk."<span></span>";
        
//         switch($this->sessionGetValue("session_login_kind")){
//             case "sysadmin":
//             case "admin":
//                 echo "[!@#]designer_".$mypk."<a href=\"javascript:assignDesignerClick('" .$myarr["member_id"]. "','" .$myarr["designer_id"]. "')\">".$designer_name."&nbsp;(" .$designer_account. ")</a>";
//                 break;
//             default:
//                 echo "[!@#]designer_".$mypk."<span>".$designer_name."&nbsp;(" .$designer_account. ")</span>";
//                 break;
//         }
        
    }//ed member_showOneTR
    function assignDesigner_showOne($mypk,$member_id,$divName=''){
        
        $mystr="select * from designer";
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        echo $divName;
        echo "<select name='designer_id' onchange=\"saveDesignerClick(this.value,'" .$member_id. "')\">";
        echo "<option value=''>請選擇</option>";
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            $sele="";
            if($myarr["designer_id"] == $mypk ){ $sele="selected"; }
            echo "<option value='" .$myarr["designer_id"]. "' $sele>" .$myarr["designer_name"]. "</option>";
        }
        echo "</select>";
        echo "&nbsp;<a href=\"javascript:cancelClick('" .$member_id. "')\">取消</a>";
    }//end assignDesigner_showOne
    
    function showNameCardShowOne($mypk,$showKind,$divName=''){//編輯名片
        
        $member_id=0;
        
        $mystr="select * from work_file where work_file_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        if(mysqli_num_rows($myresult) <= 0){
            $myarr=$this->getTableEmptyData("work_file");
        }else{
            $myarr=mysqli_fetch_array($myresult,1);
        }
        
        
        $mystr="select * from work_file_list where work_file_id='" .$mypk. "' order by sequence";
        $list_result=mysqli_query($this->link,$mystr);
        $list_num=mysqli_num_rows($list_result);
        if($list_num <= 0){
            $list_arr=$this->getTableEmptyData("work_file_list");
        }else{
            $list_arr=mysqli_fetch_array($list_result,1);
            mysqli_data_seek($list_result,0);
        }
        
        
        $member_id=$myarr["member_id"];
        $mystr="select * from member where member_id='" .$member_id. "' and member_id > 0";
        $member_result=mysqli_query($this->link,$mystr);
        if(mysqli_num_rows($member_result) <= 0){
            $member_arr=$this->getTableEmptyData("member");
        }else{
            $member_arr=mysqli_fetch_array($member_result);
        }
        
        
        
        
        echo $divName;
        echo "<form id='frmmain' name='frmmain' style='height:100%'>";
        echo "<table width=100% height=100% border=0 cellpadding=5 cellspacing=0 class='black f13'>";
        echo "<tr height=8%><td>";
        if((int)$member_id <= 0){
            echo "會員帳號 : <input type='text' name='member_account' onchange=\"selectMember()\"><a href=\"javascript:selectMember()\">查詢</a>";
        }
        echo " &nbsp; <spna class='red_d' id='showMsg'></span>";
        echo "<td width=12% align=center>";
        echo "<span class='btn_blue' onclick=\"closePicDivlick()\">關閉</span>";
//         echo "<input type='button' class='btn_blue' value='關閉' onclick=\"closePicDivlick()\">";
        echo "<tr><td colspan=2 style='pading:0' valign=top>";
        if((int)$member_id > 0){
            echo "<table width=100% height=100% border=0 cellpadding=3 cellspacing=0 class='tableShowOne f13'>";
            echo "<thead><tr height=8%><td colspan=2 align=center class='f15'>" .$member_arr["member_name"]. " &nbsp;會員電子" .$showKind. "</thead>";
            echo "<tr height=7%><td width=20% align=left>" .$showKind. "標題 : ";
            echo "<tr><td><input type='text' name='display_name' value='" .$myarr["display_name"]. "' style='width:100%;' maxlength=10>";
            echo "<tr height=7%><td width=20% align=left>修改日期 : ";
            echo "<tr><td><input type='text' name='update_datetime' value='" .$myarr["update_datetime"]. "' disabled style='width:100%;'>";
            echo "<tr height=7%><td colspan=2>";
            echo "<span class='btn_blue' onclick=\"addClick('" .$mypk. "')\">建立" .$showKind. "</span>";
//             echo "<input type='button' value='建立名片'  class='btn_blue' onclick=\"addClick('" .$mypk. "')\">";
            //             echo " &emsp; <input type='file' name='file_name'>";
            echo "<tr height=5%><td colspan=2 id='showPage' valign=top style='background-color:#00b30c;color:#ffffff;padding:0'>";
            $this->showPage($mypk,$list_arr["work_file_list_id"]);
            echo "<tr><td colspan=2 valign=top>";

			
            for($i=0;$i<$list_num;$i++){
                $list_arr=mysqli_fetch_array($list_result,1);
                $displayStr="display:none;";
                if($i==0){ $displayStr=""; }
                echo "<div class='showContentList' id='showContentList_" . $list_arr["work_file_list_id"] . "' style='height:100%;" .$displayStr. "'>";
                $this->showContentList($list_arr["work_file_list_id"]);
                echo "</div>";
            }
            
            
            echo "</table>";
        }
        echo "</table>";
        echo "<input type='hidden' name='work_file_id' value='" .$mypk. "'>";
        echo "<input type='hidden' name='member_id' value='" .$member_id. "'>";
        echo "<input type='hidden' name='showKind' value='".$showKind."'>";
        echo "</form>";

    }
    function showPage($work_file_id,$work_file_list_id,$divName=''){
        
        $mystr="select *from work_file_list where work_file_id='" .$work_file_id. "' order by sequence";
        $myresult=mysqli_query($this->link,$mystr);
        $mynum=mysqli_num_rows($myresult);
        
        echo $divName;
        for($i=0;$i<$mynum;$i++){
            $myarr=mysqli_fetch_array($myresult,1);
            $styleStr="";
            if($work_file_list_id == $myarr["work_file_list_id"]){
                $styleStr="background-color:#ffffff;color:#000000;";
            }
            echo "<span style='float:left;height:30px;line-height:30px;padding:0% 1%;cursor:pointer;" .$styleStr. "' onclick=\"changeTitlePageClick('" .$work_file_id. "','" .$myarr["work_file_list_id"]. "')\">第&nbsp;" . ($i+1) . "&nbsp;頁</span>";
        }
    }
	
    function showContentList($mypk,$divName=''){
     
        $mystr="select *from work_file_list where work_file_list_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        
		
        echo $divName;
        echo "<table width=100% height=100% border=0 cellpadding=3 cellspacing=0>";
        echo "<tr><td width=60% align=center valign=top style='padding:0;' id='showContentImg_" .$mypk. "'>";

        $this->showContentImg($myarr["work_file_id"],$mypk);
	
        echo "<td valign=top>";
		echo "<div >";
		echo "<div style=\"height:24px;background-color:#121212;color:#ffffff;\">[名片設定]</div>";
		echo "<div>名片尺寸 : </div>";
		echo "<div><input type='text' name='card_size[]' value='" .$myarr["card_size"]. "'></div>";
		echo "<div style='margin-top:10px;'>背景顏色 : </div>";
		echo "<div><input type='color' name='card_bg_color[]' value='" .$myarr["card_bg_color"]. "'></div>";
// 		echo "<br></br><br></br>";
		//value='" .$myarr["card_size"]. "'
		echo "</div>";
		//echo "<form action=\"/showContentList()\">";
		echo "<div><label for=\"cards_fun\">新增按鈕:</label></div>";
		echo "<div><select name=\"cards_fun\" id=\"cards_fun\">";
		echo "<option value=\"0\">新增連結按鈕</option>";
		echo "<option value=\"1\">新增導航地址按鈕</option>";
		echo "<option value=\"2\">新增撥打電話功能</option>";
		echo "<option value=\"3\">新增加入Line按鈕</option>";
		echo "<option value=\"4\">活動日曆按鈕</option>";
		echo "</select>";
		echo "<span class='btn_pink'  onclick=\"addBtn('" .$mypk. "')\">增加</span></div>";
		//echo "<input type=\"submit\" value=\"增加\"><br>";
		//echo "</form>";
		echo "<br>";

		if ($myarr["btn1_flag"] == 1 && $myarr["btn_flag"] == 0)
		{
			$i = 1;
		}
		else
		{
			$i = 0;
		}
			
		for($i=0;$i<$myarr["btn_amount"];$i++){ 
			
			if ($i == 0)
			{
			    $chk="checked";  $chk2="";
			    if($myarr["btn_font_color"] == "primary"){
			        $chk="checked";
			        $chk2="";
			    }else if ($myarr["btn_font_color"] == "secondary"){
			        $chk="";
			        $chk2="checked";
			    }
				echo "<div id='buttonContent'>";
				echo "<span class='material-symbols-outlined' onclick=\"delBtn('" .$mypk. "','" .$i. "')\">close</span>";
				echo "<hr size='1px' align='center'>";
				//echo "<span class='material-symbols-outlined'>close</span>";
				echo "<div>文字 : </div>";
				echo "<div><input type='text' name='btn_name[]' class='btn_name' value='" .$myarr["btn_name"]. "'></div>";
				echo "<div>連結 : </div>";
				echo "<div><input type='text' name='url[]' class='url' value='" .$myarr["url"]. "'></div>";
				echo "<div style='margin-top:10px;'>按鈕顏色 : </div>";
				echo "<div><input type='color' name='btn_bg_color[]' class='color' value='" .$myarr["btn_bg_color"]. "'></div>";
				echo "<div style='margin-top:10px'>文字顏色 :</div>";
				echo "<div><input type='radio' name='btn_font_color[]' value='primary' style='vertical-align:middle;font-size:18px;' $chk>白";
				echo "<input type='radio' name='btn_font_color[]' value='secondary'  style='vertical-align:middle;font-size:18px;' $chk2>黑";
				echo "</div>";
				echo "</div>";
				echo "<br>";
			}
			else if ($i == 1)
			{
			    
			    $chk="checked";  $chk2="";
			    if($myarr["btn1_font_color"] == "primary"){
			        $chk="checked";
			        $chk2="";
			    }else if ($myarr["btn1_font_color"] == "secondary"){
			        $chk="";
			        $chk2="checked";
			    }
				echo "<div id='buttonContent'>";
				echo "<span class='material-symbols-outlined' onclick=\"delBtn('" .$mypk. "','" .$i. "')\">close</span>";
				echo "<hr size='1px' align='center'>";
				echo "<div>文字 : </div>";
				echo "<div><input type='text' name='btn1_name[]' class='btn_name' value='" .$myarr["btn1_name"]. "'></div>";
				echo "<div>連結 : </div>";
				echo "<div><input type='text' name='url1[]' class='url' value='" .$myarr["url1"]. "'></div>";
				echo "<div style='margin-top:10px'>按鈕顏色 : </div>";
				echo "<div><input type='color' name='btn1_bg_color[]' class='color' value='" .$myarr["btn1_bg_color"]. "'></div>";
				echo "<div style='margin-top:10px'>文字顏色 :</div>";
				echo "<div><input type='radio' name='btn1_font_color[]' value='primary' style='vertical-align:middle;font-size:18px;' $chk>白";
				echo "<input type='radio' name='btn1_font_color[]' value='secondary' style='vertical-align:middle;font-size:18px;' $chk2>黑";
				echo "</div>";
				echo "<br>";
			}
			
		}
		
        echo "<input type='hidden' name='work_file_list_id[]' value='" .$mypk. "'>";
        echo "<div style='margin-top:10px;text-align:center;'>";
        echo "<span class='btn_pink'  onclick=\"saveBtnClick()\">資料存檔</span>";
//         echo "<input type='button' class='btn_pink' value='資料存檔' onclick=\"saveBtnClick()\">";
        echo "</div>";
        echo "</table>";
    }
	// work_file_id : work_file_id
	// mypk : list id
    function showContentImg($work_file_id,$mypk,$divName=''){
        
        $btnStr="";  $imgStr="";
        $lastBtnStr="";  $nextBtnStr=""; $flag="no";
        
        
        $mystr="select *from work_file_list where work_file_list_id='" .$mypk. "'";
        $myresult=mysqli_query($this->link,$mystr);
        $myarr=mysqli_fetch_array($myresult,1);
        
        $mystr="select * from work_file_list where work_file_id='" .$work_file_id. "' order by sequence";
        $list_result=mysqli_query($this->link,$mystr);
        $list_num=mysqli_num_rows($list_result);
        //上一筆、下一筆
        for($i=0;$i<$list_num;$i++){
            $list_arr=mysqli_fetch_array($list_result,1);
            //下一筆
            if($flag == "yes"){
                if($nextBtnStr == ""){  $nextBtnStr="<span class='btn_purple_l' onclick=\"moveButtonClick('" .$list_arr["work_file_list_id"]. "','" .$mypk. "','back')\">&nbsp;往後移<span class='material-symbols-outlined' style='vertical-align:middle;font-size:18px;padding-bottom:4px;'>chevron_right</span></span>";  }
                continue;
            }
            
            if($list_arr["work_file_list_id"] == $mypk){  $flag="yes";  }
            
            //上一筆
            if($flag=="yes"){ continue; }
            $lastBtnStr="<span class='btn_purple_l' onclick=\"moveButtonClick('" .$list_arr["work_file_list_id"]. "','" .$mypk. "','front')\"><span class='material-symbols-outlined' style='vertical-align:middle;font-size:18px;padding-bottom:4px;'>chevron_left</span>往前移&nbsp;</span>";
        }
        
        if($myarr["file_name"] <> ""){
            $btnStr="<span class='btn_red' onclick=\"delete_img('".$mypk. "')\">";
            $btnStr.="<span class='material-symbols-outlined' style='vertical-align:middle;font-size:18px;padding-bottom:4px;'>delete</span>&nbsp;刪除";
            $btnStr.="</span>";
            $imgStr="<img src='../businessCard_img/" .$myarr["file_name"]. "' style='width:85%'>";
        }else{
            $btnStr="<span class='btn_blue' onclick=\"uploadPicClick('".$mypk. "')\">";
            $btnStr.="<span class='material-symbols-outlined' style='vertical-align:middle;font-size:18px;padding-bottom:4px;'>add_photo_alternate</span>&nbsp;上傳圖片";
            $btnStr.="</span>";
            $imgStr="<div id='uploadDiv_" .$mypk. "'></div>";
        }

        
        echo $divName;
        echo "<table width=100% borer=0 cellpaddin=0 cellspacing=0>";
        echo "<tr><td width=33% style='border-width:0px;' align=center>";
        echo $lastBtnStr;
        echo "<td align=center style='border-width:0px;' align=center>";//
        echo $btnStr;
        echo "<td width=33% style='border-width:0px;' align=center>";
        echo $nextBtnStr;
        echo "<tr><td align=center colspan=4 style='border-width:0px;'>".$imgStr;
        
        echo "</table>";
    }//end showContentImg
}
?>
