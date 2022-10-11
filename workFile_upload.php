<?php 
session_start();
include("class/classMain.php");
$obj= new classMain();
$obj->openBody("","#ffffff");
if(!isset($_GET["mypk"])){ $_GET["mypk"]=0; }

?>
<script>
var mypk="<?php echo $_GET["mypk"]?>";
function closeDiv(){
	if(parent.document.getElementById('uploadDiv_' + mypk)){
		parent.document.getElementById('uploadDiv_' + mypk).style.display="none";
	}else{
		history.back();
	}
}
</script>
<style>
/****檔案上傳按鈕****/
input[type=file]::-webkit-file-upload-button {
  /*visibility: hidden;*/
  display:none;
}
input[type=file]::before {
	font-family:"Microsoft JhengHei","Lato", Arial, Helvetica, sans-serif;
  content: '選擇檔案';
  display: inline-block;
  background: #ffffff;
  border: 1px solid #e1e6ee;
  color: #99a5b9;
  padding: 5px 7px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  font-weight: 700;
  font-size: 14px;
}
input[type=file]:hover::before {
  border: 1px solid #ffffff;
  background: #99a5b9;
  color: #ffffff;
}
input[type=file]:active::before {
  color: #333333;
  border: 1px solid #adadad;
  background: #e6e6e6;
  box-shadow:1px 1px 3px 2px #99a5b9 inset;
}
/****end檔案上傳按鈕****/
</style>
<?php
$btn="<span class='btn_blue' onClick=\"closeDiv()\">返回</span>";//關閉視窗
if(!isset($_POST["uploadFlag"]) && !isset($_GET["mypk"])){//此判斷是保證首次進入頁面不會進此判斷
    if(!isset($_POST["uploadFlag"]) || !isset($_POST["myfile"])){ //檔案太大會造成傳送失敗
        echo "<font style='color:#990000'>!!錯誤!! &nbsp &nbsp 檔案大小超出限制(檔案大小最多為  2M)</font><br><br>".$btn;
        exit ;
    }
}
if(!isset($_REQUEST["uploadFlag"])){ $_REQUEST["uploadFlag"]=""; }

if($_REQUEST["uploadFlag"] == "Y"){
    #上傳檔案
    if($_FILES['photo']['error']>0){
        if($_FILES['photo']['name'] == ""){
            echo "請選擇檔案...".$btn;
            exit;
        }
    }else{
        $datetime=date("YmdHis");
        $type=substr(strrchr($_FILES['photo']['name'],"."),1);
        $filename=$datetime.".".$type;
        if(file_exists("../businessCard_img/".$filename)){
            echo "檔案已經存在，請勿重覆上傳相同檔案";
            exit;
        }
        move_uploaded_file($_FILES['photo']['tmp_name'],"../businessCard_img/".$filename);
        $photo="../businessCard_img/" . $filename;
        
        $mystr="update work_file_list set file_name='".$filename."' where work_file_list_id='" .$_REQUEST["mypk"]. "'";
        mysqli_query($obj->link,$mystr);
        ?>
        <script>
            var mypk="<?php echo $_REQUEST["mypk"];?>";
            parent.refresh_img(mypk);
        </script>
        <?php
    }
}
// echo "<div style='text-align:right;padding:2px;'><span onclick=\"closeDiv()\" style='cursor:pointer;'>X close</span></div>";
echo "<div style='color:#FFFFFF'>";
echo "<form name='frm_upload' method='post' enctype='multipart/form-data' action='workFile_upload.php'>";
        echo "<table width=96% height=50px border=0 cellpadding=3 cellspacing=0 align=center style='background-color:#FFFFFF;font-size:13px;color:#666666;'>";
        echo "<tr><td width=25% align=right style='background-color:#EFEFEF;'>照片上傳 : <td>";
        echo "<label class='file'>選擇檔案<input type='file' name='photo' id='nowFile'  accept='image/*'></label>";
        echo "<tr><td colspan=2 align=center>";
        echo "<span class='btn_pink' onclick=\"frm_upload.submit()\">送出檔案</span>";
        echo "<span class='btn_blue' onclick=\"closeDiv()\">返回</span>";
            echo "<input type='hidden' name='mypk' value='" .$_REQUEST["mypk"]. "'>";
            echo "<input type='hidden' name='uploadFlag' value='Y'>";
        echo "</table>";
 echo "</form>";
echo "</div>";

$obj->openEnd();
?>