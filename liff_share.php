<?php
include_once("./class/classDesigner.php");
$obj= new classDesigner();

if(!isset($_GET["mypk"])){ $_GET["mypk"]=0; }

$work_file_id=(int)$_GET["mypk"];
if($work_file_id <=0 ){ return; }

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


$mystr="select work_file_id from work_file where work_file_id='" .$work_file_id. "'";
$myresult=mysqli_query($obj->link,$mystr);
if(mysqli_num_rows($myresult) <= 0){
    return;
}
$myarr=mysqli_fetch_array($myresult,1);

$mystr="select * from work_file_list where work_file_id='" .$work_file_id. "'";
$list_result=mysqli_query($obj->link,$mystr);
$list_num=mysqli_num_rows($list_result);

// echo "<form id='frmmain' name='frmmain'>";
// for($i=0;$i<$list_num;$i++){
//     $list_arr=mysqli_fetch_array($list_result,1);
//     echo "<input type='text' name='url' value='" .$list_arr["file_name"]. "'>";
//     echo "<input type='text' name='card_size' value='" .$list_arr["card_size"]. "'>";
//     for($j=0;$j<$list_arr["btn_amount"];$j++){
//         $btnQty=$j;
//         if($j==0){ $btnQty=""; }
//         echo "<input type='text' name='btn" .$btnQty. "_label' value='" .$list_arr["btn" .$btnQty. "_name"]. "'>";
//         echo "<input type='text' name='uri" .$btnQty. "' value='" .$list_arr["url" .$btnQty]. "'>";
//     }
//     echo "<input type='text' name='btnQty' value='" .$list_arr["btn_amount"]. "'>";
// }
// echo "<input type='text' name='card_qty' value='" .$list_num. "'>";


// echo "</form>";

$fliexArr=array("type"=>"carousel",
                "contents"=>array("type"=>"bubble",
                                  "hero"=>array(
                                            "type"=>"image",
                                            "size"=>"full",
                                            "aspectRatio"=>"20:13",
                                            "url"=>"https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
                                            "aspectMode"=>"cover"),
                                            "footer"=>array(
                                            "type"=>"box",
                                            "layout"=>"vertical",
                                            "spacing"=>"sm",
                                            "contents"=>array(
                                            array("type"=>"button",
                                            "style"=>"primary",
                                            "action"=>array(
                                            "type"=>"uri",
                                            "label"=>"Add to Cart",
                                            "uri"=>"https://linecorp.com"),
                                            "height"=>"sm"),
                                            array(
                                            "type"=>"button",
                                            "action"=>array(
                                            "type"=>"uri",
                                            "label"=>"Add to wishlist",
                                            "uri"=>"https://linecorp.com"
                                                ),
                                                "style"=>"primary",
                                                "height"=>"sm")
                                            ),)));

$showArr=json_encode($fliexArr);
echo $showArr;
echo "<button id='showLineBtn'>分享給好友</button>";

echo "<input type='text' id='jsonStr' value='" .$showArr. "'>";
$obj->body_end();


/*
{
"type":"carousel",
"contents":{
    "type":"bubble",
    "hero":{
        "type":"image",
        "size":"full",
        "aspectRatio":"20:13",
        "url":"https:\/\/scdn.line-apps.com\/n\/channel_devcenter\/img\/fx\/01_5_carousel.png",
        "aspectMode":"cover"
    },
    "footer":{
        "type":"box",
        "layout":"vertical",
        "spacing":"sm",
        "contents":[
            {
                "type":"button",
                "style":"primary",
                "action":{
                    "type":"uri",
                    "label":"Add to Cart",
                    "uri":"https:\/\/linecorp.com"},
                    "height":"sm"
            },
            {
                "type":"button",
                "action":{
                    "type":"uri",
                    "label":"Add to wishlist",
                    "uri":"https:\/\/linecorp.com"
                },
                "style":"primary",
                "height":"sm"
            }
            ]
        }
    }
}
 */
?>
