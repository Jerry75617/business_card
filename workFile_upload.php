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
	parent.document.getElementById('uploadDiv_' + mypk).style.display="none";
}
</script>
<style>
.btn_delete{
	float: center;
	font-family: "Microsoft JhengHei","Lato", Arial, Helvetica, sans-serif;
	color: #BE4869;
	line-height: 18px;
	text-align:center;
	min-width:40px;
	font-size:13px;
	letter-spacing:1px;
	padding: 2px 8px 2px 8px;/*上 右 下 左*/
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	background-color: #FEFEFE;
	border-top: 1px solid #D2617D;
	border-bottom: 1px solid #D2617D;
	border-left: 1px solid #D2617D;
	border-right: 1px solid #D2617D;	
	transition: all 0.2s ease;
}
.btn_delete:hover{
	background-color: #F39CAC;	
	color:#fff;
}
.btn_delete:disabled {
    background-color: #CCCCCC;
    color: #FFFFFF;
}
.btn_close{
	float: center;
	font-family: "Microsoft JhengHei","Lato", Arial, Helvetica, sans-serif;
	/*color: #24519A;*/
	color: #0033CC;
	font-size:13px;
	letter-spacing:1px;
	line-height: 18px;
	padding: 2px 8px 2px 8px;/*上 右 下 左*/
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	background-color: #FEFEFE;
	transition: all 0.2s ease;
	border-top: 1px solid #47A1F1;/*#1F4CA4;*/
	border-bottom: 1px solid #47A1F1;
	border-left: 1px solid #47A1F1;
	border-right: 1px solid #47A1F1;
}
.btn_close:hover{
	background-color: #47A1F1;	
	color:#FFFFFF;
}
.btn_close:disabled {
    background-color: #CCCCCC;
    color: #FFFFFF;
}

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
.graytb_nohover{
	border-collapse: collapse;
  	border-top: 1px Solid #999999;
  	border-left: 1px Solid #999999;
  	border-right: 1px Solid #999999;
  	border-bottom: 1px Solid #999999;
  	background-color: #FEFEFE;
  	color:#222222;
}
.graytb_nohover thead{	
	background-color: #EFEFEF;
	color:#777777;
}
.graytb_nohover tr{
	border-top: 1px solid #999999;
}
.graytb_nohover td{	
	border-left: 1px solid #999999;	
}
/*綠色*/
.greentb_nohover{
	border-collapse: collapse;
  	border-top: 1px Solid #007E2C;
  	border-left: 1px Solid #007E2C;
  	border-right: 1px Solid #007E2C;
  	border-bottom: 1px Solid #007E2C;
  	background-color: #E5F3CF;
  	color:#222222;
}
.greentb_nohover thead{	
	background-color: #b7c2a5;
	color:#007E2C;
	text-align:center;
	font-size:16px;
}
.orange{
	color:#DC4D00;
}
</style>
<?php
$btn=" &nbsp <input type='button' value='返回' class='btn_close' onClick=\"closeDiv()\">";//關閉視窗
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

            ?>
            <script>alert("請選擇檔案...")</script>
            <?php 
            
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
//         closeDiv();
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
            echo "<input type='button' class='btn_pink' value='送出檔案' onclick=\"frm_upload.submit()\">";
            echo " &nbsp; <input type='button' class='btn_blue' value='返回' onclick=\"closeDiv()\">";
            echo "<input type='hidden' name='mypk' value='" .$_REQUEST["mypk"]. "'>";
            echo "<input type='hidden' name='uploadFlag' value='Y'>";
        echo "</table>";
 echo "</form>";
echo "</div>";

$obj->openEnd();
?>