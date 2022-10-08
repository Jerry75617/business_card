<?php 
$dir="";
$dbArr=array();
$FileName=$_SERVER["SCRIPT_FILENAME"];
$dirName=explode("/",$FileName);
for($i=0;$i<(count($dirName)-1);$i++){
    $dir = $dir.$dirName[$i]."/";
}
$iniFile=$dir."setup.ini";

if(parse_ini_file($iniFile)){
    $dbArr=parse_ini_file($iniFile);
    $db_in_ip=$dbArr["db_in_ip"];
    $db_in_name=$dbArr["db_in_name"];
    $web_name=$dbArr["web_name"];
    $login_file=$dbArr["login_file"];
    
}
//連接資料庫
$link=mysqli_connect('localhost','root','root0815')or die ("無法連接".mysql_error());
mysqli_select_db($link,$db_in_name);
mysqli_set_charset($link,"utf8");

echo "<html><head>";
echo "<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">";
echo "<meta http-equiv=\"pragma\" content=\"no-cache\">";
echo "<title>minphone adjust</title>";
echo "</head>";
echo "<body>";

?>