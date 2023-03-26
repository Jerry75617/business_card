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
	"btn_amount int default '0',".
    "file_name varchar(50) binary default '',".				//檔案名稱
	"card_size varchar (16) binary default '20:30',".		//尺寸
	"card_bg_color varchar (16) binary default '#FFFFFF',".	//卡片背景顏色
	"btn_flag int default '0',".							//按鈕功能啟動旗標
    "btn_name varchar(30) binary default '',".				//按鈕名稱(line)
    "url varchar(100) binary default '',".					//連結(line)
	"btn_bg_color varchar (16) binary default '#FFFFFF',".	//按鈕背景顏色
	"btn1_flag int default '0',".							//按鈕1功能啟動旗標
	"btn1_name varchar(30) binary default '',".				//按鈕名稱(line)
    "url1 varchar(100) binary default '',".					//連結(line)
	"btn1_bg_color varchar (16) binary default '#FFFFFF',". //按鈕背景顏色
    "dateline varchar(20) binary default '',".				//名片結束日期
    "click_times int default '0',".							//點擊次數
    "update_datetime varchar(20) binary default '',".
    "create_datetime varchar(20) binary default'')";
mysqli_query($link,$mystr);
echo mysqli_error($link);

$mystr="alter table work_file_list add column sequence int default '0'";
mysqli_query($link,$mystr);//順序
//加大url欄位大小
$mystr="alter table work_file_list modify url text binary";
mysqli_query($link,$mystr);
$mystr="alter table work_file_list modify url1 text binary";
mysqli_query($link,$mystr);

$mystr="alter table work_file_list add column btn_font_color varchar(20) binary default ''";
mysqli_query($link,$mystr);//文字顏色 primary secondary
$mystr="alter table work_file_list add column btn1_font_color varchar(20) binary default ''";
mysqli_query($link,$mystr);//文字顏色1  primary secondary

$mystr="alter table work_file_list add index idx_work_file_id(work_file_id)";
mysqli_query($link,$mystr);
$mystr="alter table work_file_list add index idx_dateline(dateline)";
mysqli_query($link,$mystr);

echo "<br>作品明細(電子名片、電子喜帖)完成...";
?>