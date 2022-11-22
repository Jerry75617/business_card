<?php
include_once("./class/classDesigner.php");
$obj= new classDesigner();

if(isset($_GET["liff_state"])){
    $work_file_id=str_replace("?mypk=","",$_GET["liff_state"]);
}else{
    if(!isset($_GET["mypk"])){ $_GET["mypk"]=0; }
    $work_file_id=(int)$_GET["mypk"];
}


if($work_file_id <=0 ){ return; }

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
echo "</head>";
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="liff_share.php";

$obj->body($nowPage,"yes");
?>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>

<script>
</script>
<?php 

$mystr="select work_file_id from work_file where work_file_id='" .$work_file_id. "'";
$myresult=mysqli_query($obj->link,$mystr);
if(mysqli_num_rows($myresult) <= 0){
    return;
}
$myarr=mysqli_fetch_array($myresult,1);

$mystr="select * from work_file_list where work_file_id='" .$work_file_id. "'";
$list_result=mysqli_query($obj->link,$mystr);
$list_num=mysqli_num_rows($list_result);



//顯示樣式
$style="width:100%;height:60px;line-height:60px;font-size:1.6em;background-color:#07B53B;color:#ffffff;border-width:0px;letter-spacing:5px;";
$style.="border-radius:5px;";

echo "<div style='width:96%;margin:0% 2%;'>";
    echo "<div style='width:100%;height:300px;'>";
    $myDataStr="";
    for($i=0;$i<$list_num;$i++){
        $list_arr=mysqli_fetch_array($list_result,1);
        $myDataStr.=$list_arr["card_size"].",".$list_arr["file_name"].",";
        $btnQty=1;
        echo "<div style='float:left;margin:10px;width:20%'>";
        echo "<table border=0 width=100% cellpadding=3 cellspacing=2 class='black f13'>";
        echo "<tr><td align=center>";
        echo "<img src='../businessCard_img/" .$list_arr["file_name"]. "' style='width:100%'>";
        
        for($j=0;$j<$list_arr["btn_amount"];$j++){
            if($j==0){ $btnQty=""; }
            echo "<tr><td><div style='width:100%;background-color:#07B53B;color:#ffffff;text-align:center;padding:5px 0px ;border-radius:5px;font-size:1.2em;'>" .$list_arr["btn" .$btnQty. "_name"]. "</div>";
            $myDataStr.=$list_arr["btn" .$btnQty. "_name"].",".$list_arr["url" .$btnQty].",";
            $btnQty++;
        }
        echo "</table>";
        echo "</div>";
        if($myDataStr <> ""){ $myDataStr=substr($myDataStr,0,-1).";"; }
    }
    
    echo "</div>";

//     echo "<div style='width:100%;text-align:center;'>";
     echo "<button id='showLineBtn' style='" .$style. "'>分享給好友</button>";
     
//     echo "</div>";
// echo "</div>";
echo "<form id='frmmain' name='frmmain'>";
echo "<input type='hidden' name='myDataStr' value='" .$myDataStr. "' style='width:100%'>";
echo "<input type='hidden' name='mypk' value='" .$_GET["mypk"]. "'>";
echo "</form>";
include_once("./js/liffShare.js");
$obj->body_end();
?>