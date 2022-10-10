<script>
var XHreport = false;
if (window.XMLHttpRequest){
  XHreport = new XMLHttpRequest();
}else if (window.ActiveXObject){
  XHreport = new ActiveXObject("Microsoft.XMLHTTP");
}


function doubleKeyup(obj,e){
    switch (e.keyCode){
      case 9:
          return;
        break;
      case 8 :
          return;
        break;
      case 16 :
          return;
        break;
      case 36:
          return;
      case 37:
          return;
      case 39:
          return;
      case 46:
          return;
        break;
    }
    obj.value=obj.value.replace(/[^\d\.]/g,"");
}



function chk_FROM(myform_name)
{
	
   for (i=0;i<document.forms.length;i++){
      if (document.forms[i].name==myform_name){
        var formElement=document.forms[i];
        break;
      }
   }
   if (!formElement){
    alert("script_checkTrimText 查無 form name=" + myform_name);
    return;
   }
   for (s=0;s<formElement.elements.length;s++){

     //text textarea 才需要剪空白 和判斷空白
     if (formElement.elements[s].type=="text" || formElement.elements[s].type=="textarea" || formElement.elements[s].type=="password" || formElement.elements[s].type=="select-one"){
        if (formElement.elements[s].disabled != true){
            //純數字的輸入
            if (formElement.elements[s].type=="text" && formElement.elements[s].value.length > 0 )
            {
               var upstr=new String(formElement.elements[s].onkeyup);
               if (upstr != null){
                  var upreturn=upstr.search(/numberKeyup/i);
                  //IE 6-7 找到23 ... IE8 找到21
                  if (upreturn > 20){ //有比對到 numberKeyup 的事件
                      if (formElement.elements[s].value.match(/[^\d]/g)){
                          for (kk=0;kk<formElement.elements[s].attributes.length;kk++){
                            if (formElement.elements[s].attributes[kk].name.toUpperCase()=="CH_NAME"){
                                showCH=formElement.elements[s].attributes[kk].value.toUpperCase();
                            }
                          } // end k
                          alert(showCH + "只可輸入正整數...");
                          formElement.elements[s].focus();
                          return false;
                      }
                  }// end numberKeyup 的事件
                  //--------
                  var upreturn=upstr.search(/doubleKeyup/i);
                  if (upreturn > 20){ //有比對到 numberKeyup 的事件
                      if (formElement.elements[s].value.match(/[^\d\.]/g)){
                          for (kk=0;kk<formElement.elements[s].attributes.length;kk++){
                            if (formElement.elements[s].attributes[kk].name.toUpperCase()=="CH_NAME"){
                                showCH=formElement.elements[s].attributes[kk].value.toUpperCase();
                            }
                          } // end k
                          alert(showCH + "只可輸入數字...");
                          formElement.elements[s].focus();
                          return false;
                      }
                  }// end numberKeyup 的事件
              }// end onKeyup
            }
            ss=formElement.elements[s].value;
            if (formElement.elements[s].type !="select-one"){
                ss=ss.trim();
                formElement.elements[s].value=ss;
            }
            if(ss.length==0){
                //符合 IE and Firefor 瀏覽器的用法---
                var showCH;
                var emptyFlag;
                for (kk=0;kk<formElement.elements[s].attributes.length;kk++){
			if (formElement.elements[s].attributes[kk].name.toUpperCase()=="CK_EMPTY"){
                        emptyFlag=formElement.elements[s].attributes[kk].value.toUpperCase();
                    }
                    if (formElement.elements[s].attributes[kk].name.toUpperCase()=="CH_NAME"){
                        showCH=formElement.elements[s].attributes[kk].value.toUpperCase();
                    }
                } // end k
                if (emptyFlag=="YES"){
                    alert(showCH + "不可空白...");
                    formElement.elements[s].focus();
                    return false;
                }
          }  //end length=0
        } // disabled
     } // end text textarea 才需要剪空白 和判斷 沒輸入
   }// end for 迴圈

    //不可輸入特殊符號
    flag=script_stringNotKey(formElement);
    if (flag==false){ return false; }

  return true;
}

function script_stringNotKey(obj)
{
  for (i=0;i<obj.elements.length;i++)
  {
    if ((obj.elements[i].type=='text' || obj.elements[i].type=='textarea') && obj.elements[i].value !="")
    {
        /*  if (obj.elements[i].value.match(/&/))
                  {
                     alert('輸入值不可有 & 符號');
                     obj.elements[i].select();
                     return false;
                   }

                   if (obj.elements[i].value.match(/[\"]/))
                   {
                     alert("輸入值不可有 \" 符號");
                     obj.elements[i].select();
                     return false;
                   }
                   if (obj.elements[i].value.match(/[\']/))
                   {
                     alert("輸入值不可有 \' 符號");
                     obj.elements[i].select();
                     return false;
                   }
                   if (obj.elements[i].value.match(/[+]/))
                   {
                     alert("輸入值不可有 + 符號");
                     obj.elements[i].select();
                     return false;
                   } */

                   if (obj.elements[i].value.match(/[?]/))
                   {
                     //alert("輸入值不可有 ? 符號");
                     //obj.elements[i].select();
                     //return false;
                   }
                   if (obj.elements[i].value.match(/[~]/))
                   {
                     //alert("輸入值不可有 ~ 符號");
                     //obj.elements[i].select();
                     //return false;
                   }
                   /*
                   if (obj.elements[i].value.match(/[/]/))
                   {
                     alert("輸入值不可有 / 符號");
                     obj.elements[i].select();
                     return false;
                   }
                   */

                   if (obj.elements[i].value.match(/[\\]/))
                   {
                     alert("輸入值不可有 \\ 符號");
                     obj.elements[i].select();
                     return false;
                   }
     } //end text textarea
    } //end i
    return true;
}

function X_FORM1(formName){ 
	var filename="";

	var forms=document.forms[formName];
	var filed=forms.elements[0];
	
	for(var i=0; i<forms.elements.length; i++){
		var filetype=forms.elements[i].type;
		switch(filetype){
			case "text":
//			case "radio":
//			case "checkbox":
			case "password":
			case "file":
			case "textarea":
			case "hidden":
			case "select-one":
			case "date":
				filename +="&"+forms.elements[i].name+"="+forms.elements[i].value;
				break;//encodeURIComponent()
			case "radio" :
		         if (forms.elements[i].checked==true)
		         {filename+="&" + forms.elements[i].name + "=" + forms.elements[i].value;}
		         break;
		      case "checkbox" :
		         if (forms.elements[i].checked==true)
		         {filename+="&" + forms.elements[i].name + "=" + forms.elements[i].value;}
		         break;
		      default:
		    	  returnStr +="&"+forms.elements[i].name+"="+forms.elements[i].value;
		         break;
		}
		
		
	}
	
	return filename;
}

function X_FORM(myformObj)
{
	
  var returnStr="";
  var forms=document.forms[myformObj];
  for(var i=0; i<forms.elements.length; i++){
	  
    switch(forms.elements[i].type){
      case "text" :
      case "password" :
      case "textarea" :
      case "hidden" :
      case "select-one" :
    	  returnStr +="&"+forms.elements[i].name+"="+forms.elements[i].value;
//         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;
         break;
      case "radio" :
         if (forms.elements[i].checked==true)
         {returnStr+="&"+forms.elements[i].name + "=" + encodeURIComponent(forms.elements[i].value)  + "&" ;}
         break;
      case "checkbox" :
    	  
         if (forms.elements[i].checked==true)
         {returnStr+="&"+forms.elements[i].name + "=" + encodeURIComponent(forms.elements[i].value)  + "&" ;}
         break;
      default:
    	  returnStr +="&"+forms.elements[i].name+"="+forms.elements[i].value;
         break;
    } 
  }// end for
  
  return returnStr;
}
function parenter_X_FORM_Str(send_str,actionPage,action){ 
	  var url =actionPage + "?mytimestamp="+new Date().getTime();
	  if(XHreport){
	    XHreport.open("POST", url);
	    XHreport.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    //server 傳回值    
	    XHreport.onreadystatechange = function(){
	      if (XHreport.readyState == 4){
	        if (XHreport.status == 200){
	          if (XHreport.responseText != "")
	          {
//	             alert(XHreport.responseText);
	             myarr=XHreport.responseText.split("[!@#]");
	             var pWindow=window.opener;
	                for(kk=0;kk<myarr.length;kk++){
	                   //<table> 前面帶 要存取的名稱
	                   //alert(myarr[kk]);
	                   myint=myarr[kk].indexOf("<",0);
	                   
	                   if (myint > 0 ){//HTML格式
	                      var DivName=myarr[kk].substr(0,myint);
	                      activeObj=pWindow.document.getElementById(DivName);
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
	          alert("伺服端錯誤訊息:" + XHreport.status );
	        }       
	       
	      } //end 傳回狀態
	    }// end server 傳回值       
	    //送回伺服端的資料
	    XHreport.send(send_str);  
	     
	  }//XMLobj=true  
}
function X_FORM_Str(send_str,actionPage,action){ 
	  var url =actionPage + "?mytimestamp="+new Date().getTime();
	  if(XHreport){
	    XHreport.open("POST", url);
	    XHreport.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    //server 傳回值    
	    XHreport.onreadystatechange = function(){
	      if (XHreport.readyState == 4){
	        if (XHreport.status == 200){
	          if (XHreport.responseText != "")
	          {
//	             alert(XHreport.responseText);
	             myarr=XHreport.responseText.split("[!@#]");
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
	          alert("伺服端錯誤訊息:" + XHreport.status );
//	        	var MEDIAERRORDIVOBJ=document.getElementById("MEDIAPLAYERMSGDIV");							
//						if (MEDIAERRORDIVOBJ){
//								MEDIAERRORDIVOBJ.style.display="block";				
//								setTimeout("ajaxStart();",500);
//						}
	        }       
	       
	      } //end 傳回狀態
	    }// end server 傳回值       
//	    alert(send_str);
	    //送回伺服端的資料
	    XHreport.send(send_str);  
	     
	  }//XMLobj=true  
}
function pagenow(pageName){

	var send_str="&dataFlag=change_page&pageName="+pageName+"&datetime="+new Date().getTime();
	X_FORM_Str(send_str,"mainSIM.php","");
}
function queryFromPage(formName){

	var formObj=document.forms[formName];
	var pageObj=document.forms["form_page"];
	if(formObj == null || pageObj == null){
		alert("缺少"+formName+"/form_page");
		return;
	}
	for(var i=0; i<formObj.elements.length; i++){
		var elementType=formObj.elements[i].type;
		var elementName;
		var elementValue;
		
		switch(elementType){
		
		case "radio" :
	        eeName="h_" + formObj.elements[i].name;       
	         if (formObj.elements[i].checked==true){            
	            for(kk=0;kk<pageObj.elements.length;kk++){          
	              if(eeName==pageObj.elements[kk].name){
	                pageObj.elements[kk].value=formObj.elements[i].value;
	                break;
	              }
	            }//for kk         
	           }       
	         break;
	      case "checkbox" :
	         //if (queryObj.elements[ff].checked==true){
	            eeName="h_" + formObj.elements[i].name;
	            for(kk=0;kk<pageObj.elements.length;kk++){          
	              if(eeName==pageObj.elements[kk].name){
	            	if (formObj.elements[i].checked==true){
	            		pageObj.elements[kk].value=formObj.elements[i].value;
	            	}else{
	            		pageObj.elements[kk].value="";
	            	}
	                break;
	              }
	            }//for kk
	          //}
	         
	         break;
	         
//			case "checkbox":
//			case "radio":
//				elementName="h_"+formObj.elements[i].name;
//				if(formObj.elements[i].checked == true){
//					elementValue=formObj.elements[i].value;
//					pageObj.elements[elementName].value=elementValue;
//				}else{
//					pageObj.elements[elementName].value="";
//				}
//				
//				break;
		         
//			case "radio":
//
//				if(formObj.elements[i].checked == true){
//					elementName="h_"+formObj.elements[i].name;
//					elementValue=formObj.elements[i].value;
//					pageObj.elements[elementName].value=elementValue;
//
//				}
//				break;
			case "select":

				break;
			case "button":
				break;			
			default:
				
				elementName="h_"+formObj.elements[i].name;
				elementValue=formObj.elements[i].value;
				pageObj.elements[elementName].value=elementValue;
				break;
		}
	}
	
}
//只可輸入數字
function numberKeyup(obj,e){
	//alert(e.keyCode);
    switch (e.keyCode){
      case 9:
          return;
        break;
      case 8 :
          return;
        break;
      case 16 :
          return;
        break;
      case 36:
          return;
      case 37:
          return;
      case 39:
          return;
      case 46:
          return;
        break;
      case 110:
    	  return;
    	  break;
    }
    obj.value=obj.value.replace(/[^-\d]/g,"");
}
function telKeyup(obj,e){
//	alert(e.keyCode);
    switch (e.keyCode){
      case 9:
          return;
        break;
      case 8 :
          return;
        break;
      case 16 :
          return;
        break;
      case 36:
          return;
      case 37:
          return;
      case 39:
          return;
      case 46:
          return;
        break;
//      case 110://數字鍵盤.
//      case 190:
//    	  return;
//    	  break;
      case 57:
    	  return;
    	  break;
      case 48:
    	  return;
    	  break;
      case 109:
      case 189:
    	  return;
    	  break;
    }
    obj.value=obj.value.replace(/[^-()\d]/g,"");
}
//只可輸入數字和減號
function numberKey_minus(obj,e){
//	alert(e.keyCode);
    switch (e.keyCode){
      case 9:
          return;
        break;
      case 8 :
          return;
        break;
      case 16 :
          return;
        break;
      case 36:
          return;
      case 37:
          return;
      case 39:
          return;
      case 46:
          return;
        break;
      case 109://數字盤的減 -
          return;
        break;
      case 189://字母上方的減-
          return;
        break;
      case 111://斜線
    	  return;
    	 break;
    }
    obj.value=obj.value.replace(/[^-\d]/g,"");
}
function logoutClick(){
	var send_str="dataFlag=logout&timestamp="+ new Date().getTime();
	X_FORM_Str(send_str,"loginSIM.php","");
}
//換頁
function changePageClick($url,showKind){
	document.location.href=$url+"?showKind=" + showKind;
}
function changePassword(){
	var aaobj=document.getElementById("changePwdDiv");
	if(aaobj){
		aaobj.style.display="block";
		var send_str="dataFlag=change_pwd&timestamp="+ new Date().getTime();
		X_FORM_Str(send_str,"mainSIM.php","");
	}
}
function closePwdDiv(){
	var aaobj=document.getElementById("changePwdDiv");
	if(aaobj){
		aaobj.style.display="none";
		aaobj.innerHTML="";
	}
}
function savePwdClick(){
	var send_str="dataFlag=update_pwd&" + X_FORM("frm_pwd");
	X_FORM_Str(send_str,"mainSIM.php","savePwdClickReturn");	
}
function savePwdClickReturn(){
	if(document.getElementById("checkFlag") && document.getElementById("checkFlag").value == "Y"){
		closePwdDiv();
	}
}
</script>