<?php 
include('connectDB.php');
$mystr="create database " . $db_in_name . " character set utf8 collate utf8_bin";
mysqli_query($link,$mystr);
echo "<br>" .mysqli_error($link);

echo "<br>create database ". $db_in_name . " ok ......";
?>