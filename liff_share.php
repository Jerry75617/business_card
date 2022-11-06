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

main();
</script>
<?php 

echo "<button>分享給好友</button>";
$obj->body_end();
?>