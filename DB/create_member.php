<?php 
include("connectDB.php");
$mystr="create table member (member_id int AUTO_INCREMENT PRIMARY KEY,".
    "member_name varchar(30) binary default '',".//設計師姓名
    "member_account varchar(15) binary default '',".//登入帳號
    "member_password varchar(30) binary default '',".//登入密碼
    "designer_id int default '0',".//設計師id
    "line_id varchar(50) binary default '',".//line id
    "dateline varchar(10) binary default '',".//結束日期
    "update_datetime varchar(20) binary default'',".
    "create_datetime varchar(20) binary default'')";

mysqli_query($link,$mystr);
echo mysqli_error($link);

$mystr="alter table member add index idx_member_account(member_account)";
mysqli_query($link,$mystr);
$mystr="alter table member add index idx_dateline(dateline)";
mysqli_query($link,$mystr);

echo "<br>會員資料完成...";
?>