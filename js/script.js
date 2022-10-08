<script language="javascript">
var nurse_XHreport = false;
if (window.XMLHttpRequest){
	nurse_XHreport = new XMLHttpRequest();
}else if (window.ActiveXObject){
	nurse_XHreport = new ActiveXObject("Microsoft.XMLHTTP");
}

function nurse_X_FORM_Str(send_str,actionPage,action)
{ 
	var url =actionPage + "?mytimestamp="+new Date().getTime();
	  if(XHreport){
		  nurse_XHreport.open("POST", url);
		  nurse_XHreport.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    //server 傳回值    
		  nurse_XHreport.onreadystatechange = function(){
	      if (nurse_XHreport.readyState == 4){
	        if (nurse_XHreport.status == 200){
	          if (nurse_XHreport.responseText != "")
	          {
//	             alert(XHreport.responseText);
	             myarr=nurse_XHreport.responseText.split("[!@#]");
	                for(kk=0;kk<myarr.length;kk++){
	                   //<table> 前面帶 要存取的名稱
	                   //alert(myarr[kk]);
	                   myint=myarr[kk].indexOf("<",0);
	                   
	                   if (myint > 0 ){//HTML格式
	                      var DivName=myarr[kk].substr(0,myint);
	                      activeObj=document.getElementById(DivName);
	                      var innstr=myarr[kk];
	                      if(activeObj){ 
	                    	//alert(innstr.substring(myint,innstr.length));
	                        activeObj.innerHTML=innstr.substring(myint,innstr.length);
	                        //alert(activeObj.innerHTML);
	                      }else{
	                          if(DivName=='error_msgbox'){ 
	                            errorStr=innstr.substring(myint+1,innstr.length);
	                            alert(errorStr); 
	                            window.focus();                            
	                          }//error_msgbox
	                          if(DivName=='header'){
	                        	  var url=innstr.substring(myint+1,innstr.length);
	                        	  document.location.href=url;
	                          }
	                      }                      
	                  }else{// end html
	                       //後端錯誤訊息
	                       if (myarr[kk].length > 0 && myarr[kk].length!=2){
	                         alert("error: " + myarr[kk] + ",strlen=" + myarr[kk].length);
	                       }
	                    }
	                }//end kk
	          }
	          if (action!= ""){ //最後要執行的 function 名稱
	            var actionStr=action + "()";
	            setTimeout(actionStr,10);
	          }
	        }else{
	          alert("伺服端錯誤訊息:" + nurse_XHreport.status );
//	        	var MEDIAERRORDIVOBJ=document.getElementById("MEDIAPLAYERMSGDIV");							
//						if (MEDIAERRORDIVOBJ){
//								MEDIAERRORDIVOBJ.style.display="block";				
//								setTimeout("ajaxStart();",500);
//						}
	        }       
	       
	      } //end 傳回狀態
	    }// end server 傳回值       
//	    alert(send_str);
		  nurse_XHreport.send(send_str);  
	     
	  }//XMLobj=true  
}
function check_timeoutAjax(){
	var aaobj=document.getElementById("outSec");
	var bbobj=document.getElementById("outSecStr");
	if(aaobj){
		if(aaobj.value == 0){
			logoutClick();
		}else{
			var nowSec=aaobj.value-1;
			bbobj.innerHTML=nowSec;
			aaobj.value=nowSec;
			check_timeoutAjaxReturn();
		}
	}
}
document.onmousemove=function() {
	var aaobj=document.getElementById("outSec");
	var ccobj=document.getElementById("outSecStr");
	if(opener){
		var bbobj=opener.document.getElementById("outSec");
		var ddobj=opener.document.getElementById("outSecStr");
		
		if(ddobj){
			ddobj.innerHTML=300;
		}
		if(bbobj){
			bbobj.value=300;
		}
	}
	if(aaobj){
		aaobj.value=300;
	}
	if(ccobj){
		ccobj.innerHTML=300;
	}
	
	
}
//	var send_str="&dataFlag=write_time&timestamp=" + new Date().getTime();
//	nurse_X_FORM_Str(send_str,"mainSIM.php","");
//}
//function check_timeoutAjax(){
//	var aaobj=document.getElementById("logoutCheck");
//	if(aaobj){
//		if(aaobj.value == "yes"){
//			logoutClick();
//		}else{
//			var send_str="&dataFlag=check_timeout&timestamp=" + new Date().getTime();
//			nurse_X_FORM_Str(send_str,"mainSIM.php","check_timeoutAjaxReturn");
//		}
//	}else{
//		
//	}
//}
function check_timeoutAjaxReturn(){
	setTimeout("check_timeoutAjax()",1000);
}
function checkOpen_timeoutAjax(){
	var aaobj=opener.document.getElementById("outSec");
	var bbobj=opener.document.getElementById("outSecStr");
	if(aaobj){
		if(aaobj.value == 0){
			logoutClick();
			window.close();	
		}else{
			var nowSec=aaobj.value-1;
			bbobj.innerHTML=nowSec;
			aaobj.value=nowSec;
			checkOpen_timeoutAjaxReturn();
		}
	}
	
//	var aaobj=document.getElementById("logoutCheck");
//	if(aaobj){
//		if(aaobj.value == "yes"){
//			window.close();
//		}else{
//			var send_str="&dataFlag=check_timeout&timestamp=" + new Date().getTime();
//			nurse_X_FORM_Str(send_str,"mainSIM.php","checkOpen_timeoutAjaxReturn");
//		}
//	}else{
//		window.close();
//	}
}
function checkOpen_timeoutAjaxReturn(){
	setTimeout("checkOpen_timeoutAjax()",1000);
}
</script>