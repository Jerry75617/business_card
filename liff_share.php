<?php
include_once("class/classMain.php");
$obj= new classMain();
$obj->head();
if(!isset($_GET["showKind"])){ $_GET["showKind"]=""; }
$nowPage="liff_share.php";

$obj->body($nowPage,"yes");
?>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
function main() {
	const profile =  liff.getProfile();
	createButton(profile);
}
window.onload=function (){
	 liffInit();
}
</script>
<?php 

echo "<input type='button' value='分享給好友' onclick=\"main()\">";
$obj->body_end();
?>