<?php 
include("connectDB.php");
$mystr="create table work_file (work_file_id int AUTO_INCREMENT PRIMARY KEY,".
    "member_id int default '0',".
    "designer_id int default '0',".
    "display_name varchar(50) binary default '',".//顯示名稱
    "category varchar(10) binary default '',".//分類 名片/喜帖
    "dateline varchar(20) binary default '',".//名片結束日期
    "update_datetime varchar(20) binary default '',".
    "create_datetime varchar(20) binary default'')";
mysqli_query($link,$mystr);
echo mysqli_error($link);
$mystr="alter table work_file add index idx_member_id(member_id)";
mysqli_query($link,$mystr);
$mystr="alter table work_file add index idx_designer_id(designer_id)";
mysqli_query($link,$mystr);
$mystr="alter table work_file add index idx_category(category)";
mysqli_query($link,$mystr);

echo "<br>作品(電子名片、電子喜帖)完成...";


$mystr="create table work_file_list (work_file_list_id int AUTO_INCREMENT PRIMARY KEY,".
    "work_file_id int default '0',".
    "designer_id int default '0',".
    "file_name varchar(50) binary default '',".//檔案名稱
    "btn_name varchar(30) binary default '',".//按鈕名稱(line)
    "url varchar(100) binary default '',".//連結(line)
    "dateline varchar(20) binary default '',".//名片結束日期
    "click_times int default '0',".//點擊次數
    "update_datetime varchar(20) binary default '',".
    "create_datetime varchar(20) binary default'')";
mysqli_query($link,$mystr);
echo mysqli_error($link);

$mystr="alter table work_file_list add column sequence int default '0'";
mysqli_query($link,$mystr);//順序

$mystr="alter table work_file_list add index idx_work_file_id(work_file_id)";
mysqli_query($link,$mystr);
$mystr="alter table work_file_list add index idx_dateline(dateline)";
mysqli_query($link,$mystr);

echo "<br>作品明細(電子名片、電子喜帖)完成...";
?>