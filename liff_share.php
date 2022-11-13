<?php
include_once("./class/classDesigner.php");
$obj= new classDesigner();
$obj->head();
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="liff_share.php";

$obj->body($nowPage,"yes");
?>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
// main();
</script>
<?php 
include_once("./js/liffShare.js");

$work_file_id=(int)$_GET["mypk"];
if($work_file_id <=0 ){ return; }
$mystr="select * from work_file where work_file_id='" .$work_file_id. "'";
echo "<button id='showLineBtn'>分享給好友</button>";
$obj->body_end();
?>
