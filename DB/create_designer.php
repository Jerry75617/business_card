<?php 
include("connectDB.php");
$mystr="create table designer (designer_id int AUTO_INCREMENT PRIMARY KEY,".
    "designer_name varchar(30) binary default '',".//設計師姓名
    "designer_account varchar(15) binary default '',".//登入帳號
    "designer_password varchar(30) binary default '',".//登入密碼
    "designer_cell_phone varchar(15) binary default '',".//手機號碼
    "update_datetime varchar(20) binary default '',".//異動時間
    "create_datetime varchar(20) binary default '')";//建檔時間
mysqli_query($link,$mystr);
echo mysqli_error($link);

$mystr="alter table designer add column stop_datetime varchar(20) binary default ''";
mysqli_query($link,$mystr);//停用時間

//增加index
$mystr="alter table designer add index idx_designer_name(designer_name)";
mysqli_query($link,$mystr);
$mystr="alter table designer add index idx_designer_account(designer_account)";
mysqli_query($link,$mystr);
$mystr="alter table designer add index idx_stop_datetime(stop_datetime)";
mysqli_query($link,$mystr);//停用時間

echo "<br>設計師資料完成...";
?>