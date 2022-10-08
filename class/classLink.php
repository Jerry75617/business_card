<?php
class classLink{
   
	var $db_in_ip;
	var $db_in_name;
	var $web_name;
	var $login_file;
	var $link;
    var $sysSessionAddName="nameCard";
    var $iebugStr="瀏覽器登入時間逾時\n請關閉瀏覽器後重新開啟瀏覽器再登入系統\n建議使用 Chrome 瀏覽器 ...";//IE9,IE10 有時 session 會不見
    var $data_showmore_number=25;//show more 一頁的筆數
    var $path;
    var $exportDir;
    
	function classLink(){
	    $this->connect();
	}
	function connect(){
	    $dir="";  $path="";
	    
	    //檔案路徑
	    $path="";
	    $dirName=explode("/",$_SERVER["SCRIPT_FILENAME"]);
	    for($i=0;$i<(count($dirName)-2);$i++){
	        $path .= $dirName[$i]."/";
	    }
	    $this->path=$path;
		$dbArr=array();
		$FileName=$_SERVER["SCRIPT_FILENAME"];
		$dirName=explode("/",$FileName);
		for($i=0;$i<(count($dirName)-1);$i++){
			$dir = $dir.$dirName[$i]."/";
		}		
		$iniFile=$dir."DB/setup.ini";

		if(parse_ini_file($iniFile)){
			$dbArr=parse_ini_file($iniFile);
			$this->db_in_ip=$dbArr["db_in_ip"];
			$this->db_in_name=$dbArr["db_in_name"];
			$this->web_name=$dbArr["web_name"];
			$this->login_file=$dbArr["login_file"];
			$this->exportDir=$dbArr["exportDir"];
		}
		//連接資料庫
		$this->link=mysqli_connect('localhost','root','root0815')or die ("無法連接".mysql_error());
		mysqli_select_db($this->link,$this->db_in_name) or die ("無法選擇資料庫".mysql_error());
		mysqli_set_charset($this->link,"utf8");
		//找後端程式,存session	
		$mp_page=basename($_SERVER["PHP_SELF"]); 	 
		$len=strlen($mp_page);
		$loginFileStr=strstr(strtoupper($mp_page),"LOGINSIM.PHP");
		if($len>7 && $loginFileStr==""  ){
			if(substr($mp_page,($len-7),7)=="SIM.php"){   		 
				 if(empty($_SESSION["session_login_kind".$this->sysSessionAddName])) {
					$checkFlag="error";
					if ($checkFlag=="error"){
						$this->reponse_errorMsgSIM($this->iebugStr);//IE9,IE10 有時 session 會不見
						exit;
					}
				}
			}
		}//目前檔名長度 >7   
  
		
	}
	function reponse_errorMsgSIM($errStr){
	    echo "[!@#]error_msgbox<" . $errStr;
	}
	//找table的所有欄位
	function getTableField($tableName,$dbName='*')
	{
	    $mystr="desc ".$tableName;
	    $field_result=mysqli_query($this->link,$mystr);
	    $field_num=mysqli_num_rows($field_result);
	    $tableFieldArr=array();
	    for($f=0;$f<$field_num;$f++){
	        $field_arr=mysqli_fetch_array($field_result,1);
	        $tableFieldArr[$f]=$field_arr["Field"];
	    }//for f
	    return $tableFieldArr;
	}
	//新增到到DB中
	function insertDB($mypost,$tableName,$noInsertArr='*'){
	    $primaryKeyName="";
	    $tableFieldArr=$this->getTableField($tableName);
	    $mystr="select * from ".$tableName;
	    
	    $field_result=mysqli_query($this->link,$mystr);
	    $num=mysqli_num_fields($field_result);
	    for($ii=0;$ii<$num;$ii++){
	        $fname=mysqli_fetch_field($field_result);
	        $flag_str=$fname->flags;
	        if ($fname->flags & MYSQLI_PRI_KEY_FLAG && strstr($flag_str,'49667')!="") {
	            $primaryKeyName = $fname->name;
	            break;
	        }
	    }//for i
	    
        $insertStr="";$string="";
            foreach ($mypost as $fkey => $fvalue){ 
                $checkF="";
                switch($fkey){
                    case $primaryKeyName: break;//insert int 主索引不寫入
                    default:
                        for($fd=0;$fd<count($tableFieldArr);$fd++){
                            if($fkey==$tableFieldArr[$fd]){
                                
                                $checkF="yes";    break;
                            }

                        }//for $fd
                }//switch $fkey
                if($checkF=="yes"){
                    $insertStr.=$fkey."='".mysqli_real_escape_string($this->link,$fvalue)."',";
                }
            }
            if($insertStr <> ""){
                $insertStr=substr($insertStr,0,-1);
            }
            $mystr="insert into ".$tableName." set ".$insertStr;
            mysqli_query($this->link,$mystr);
            $myInsertId=mysqli_insert_id($this->link);
            return $myInsertId;
	}
	//更新到到DB中
	function updateDB($mypost,$mypk,$mypkValue,$tableName,$noInsertArr='*'){
	    
	    $updateStr="";$string="";$a="";
	    foreach ($mypost as $fkey => $fvalue){
	        $checkF="";
	        $tableFieldArr=$this->getTableField($tableName);
	        if(in_array($fkey,$tableFieldArr)){
	            $updateStr.=$fkey."='".mysqli_real_escape_string($this->link,$fvalue)."',";
	        }
	    }
	    if($updateStr <> ""){
	        $updateStr=substr($updateStr,0,-1);
	    }
	    $mystr="update ".$tableName." set ".$updateStr." where ".$mypk."='".$mypkValue."'";
	    mysqli_query($this->link,$mystr);
	}
	function deleteData_table($tableName,$primaryName,$primaryValue,$dbName='')
	{
	    
	    $mystr="select * from ".$tableName." where ".$primaryName."='".$primaryValue."'";
	    
	    $old_result=mysqli_query($this->link,$mystr);
	    $old_num=mysqli_num_rows($old_result);
	    if($old_num>0){
	        $myUpdateStr="delete from ".$tableName." where ".$primaryName."='".$primaryValue."'";
	        mysqli_query($this->link,$myUpdateStr);
	    }
	    
	}//deleteData_table
}
?>