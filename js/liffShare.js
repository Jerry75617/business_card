<script>
var url="https://103.148.202.39/business_card/liff_share.php?mypk=" +document.frmmain.mypk.value;
async function liffInit() {
	  await liff.init({ liffId: "1657623497-DZyKpqOL" });
	  if (!liff.isLoggedIn()) {
	    liff.login({ redirectUri: url });
	  }
	}

	function createButton(profile) {
	  const urlParams = new URLSearchParams(window.location.search);
	  const userImage = profile.pictureUrl;
	  const userReply = [urlParams.get('name'), urlParams.get('phone'), urlParams.get('email'), userImage];
	  const flexContent = flexCard(userReply);
	  console.log(flexContent);
	  const handleClick = async () => {
	    if (liff.isApiAvailable("shareTargetPicker")) {
	      try {
	        const result = await liff.shareTargetPicker([
	          flexContent
	        ])

	        if (result) {
	          alert('Flex Message success');
	        }

	      } catch (error) {
	        alert("Flex Message got some error");
	      }
	    }
	  }
	  var aaobj=document.getElementById("showLineBtn");
	  aaobj.onclick = handleClick;
	}

	async function main() {
	  await liffInit()
	  const profile = await liff.getProfile();
	  createButton(profile);
	}

	main()
const colorDefault = "#666666";
const colorNetlify = "#00ad9f";
const flexCard = (userReply) => {
//  console.log(userReply);
  const [_, name, phone, email] = userReply;
  
  //文字
//  dataArr["type"]="text";
//  dataArr["text"]="hello";
  
//  return{
//	  "type": "image",
//	  "originalContentUrl": "https://103.148.202.39/businessCard_img/20221113121036.jpg",
//	  "previewImageUrl": "https://103.148.202.39/businessCard_img/20221113121036.jpg"
//	}
  
  //flex
  var path="https://103.148.202.39/businessCard_img/";
  var myData=document.frmmain.myDataStr.value;
  
  
  console.log(myData);
  
  var dataArr=[];
  var myDataArr=myData.split(";");
//  console.log(myDataArr);
  for(var i=0; i<myDataArr.length; i++){
	  var myValueArr=myDataArr[i].split(",");
	  var arrLength=(myValueArr.length-2)/2;
	  var buttonArr=[]; var itemQty=2;
	  if(arrLength > 0){
		  for(var j=0; j<arrLength; j++){
			  buttonArr[j]={
					  "type": "button",
			            "style": "primary",
			            "action": {
			              "type": "uri",
			              "label": myValueArr[itemQty],
			              "uri": myValueArr[itemQty+1]
			            },
			            "height": "sm"
			  }
			  itemQty+=2;
		  }
		  dataArr[i]={
				  "type": "bubble",
			      "hero": {
				        "type": "image",
				        "size": "full",
				        "aspectRatio": myValueArr[0],
				        "url": path+myValueArr[1],
				        "aspectMode": "cover"
				       },
				 "footer": {
				   	    "type": "box",
				   	    "layout": "vertical",
				   	    "spacing": "sm",
				   	    "contents": buttonArr
				   	  } 
		  }
	  }
  }
 
//轉換
//  dataArr=Object.fromEntries(Object.entries(dataArr))
//  console.log(dataArr);
  
  return {
      "type": "flex",
      "altText": '電子名片',
      "contents":   {
    	  "type": "carousel",
		  "contents": dataArr
      }
    }
  
  
  return dataArr;
 
  for(var i=0;i<2;i++){
////	 ['key' + i,i]
////	  dataArr['key']=i;
////	  dataArr['key2']=i;
////	  dataArr['key3']='value'+i;
////	  dataArr[i]=['key',i];
//	 
	  dataArr.push(['type',"carousel"]);
//	  
//	  dataArr["key"] = i;
//	  dataArr["type"]="carousel";
//	  dataArr["contents"]=[];
//	  dataArr["contents"]["type"+i]=i;
  }
//  var dataArr=[ [ 'key1', 'value1' ], [ 'key2', 2 ], [ 'key3', 'value3' ] ] ;
//  
  
//  dataArr=[["type","carousel"],["contents", ["type","bubble"]]];
  
//  dataArr.push(["type","carousel"]);
  console.log(dataArr);
  console.log(Object.fromEntries(dataArr));
  return;
//  var dataArr= {
//		  "type": "carousel",
//		  "contents": [
//		    {
//		      "type": "bubble",
//		      "hero": {
//		        "type": "image",
//		        "size": "full",
//		        "aspectRatio": "20:13",
//		        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
//		        "aspectMode": "cover"
//		      }
//		    },
//		    {
//			      "type": "bubble",
//			      "hero": {
//			        "type": "image",
//			        "size": "full",
//			        "aspectRatio": "20:13",
//			        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
//			        "aspectMode": "cover"
//			      }
//			    }
//		    ]
//  	}
  
  return dataArr;
//  return {
//	  "type": "carousel",
//	  "contents": [
//	    {
//	      "type": "bubble",
//	      "hero": {
//	        "type": "image",
//	        "size": "full",
//	        "aspectRatio": "20:13",
//	        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
//	        "aspectMode": "cover"
//	      },
//	      "footer": {
//	        "type": "box",
//	        "layout": "vertical",
//	        "spacing": "sm",
//	        "contents": [
//	          {
//	            "type": "button",
//	            "style": "primary",
//	            "action": {
//	              "type": "uri",
//	              "label": "Add to Cart",
//	              "uri": "https://linecorp.com"
//	            },
//	            "height": "sm"
//	          },
//	          {
//	            "type": "button",
//	            "action": {
//	              "type": "uri",
//	              "label": "Add to wishlist",
//	              "uri": "https://linecorp.com"
//	            },
//	            "style": "primary",
//	            "height": "sm"
//	          }
//	        ]
//	      }
	    //}//,
//	    {
//	      "type": "bubble",
//	      "hero": {
//	        "type": "image",
//	        "size": "full",
//	        "aspectRatio": "20:13",
//	        "aspectMode": "cover",
//	        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_6_carousel.png"
//	      },
//	      "footer": {
//	        "type": "box",
//	        "layout": "vertical",
//	        "spacing": "sm",
//	        "contents": [
//	          {
//	            "type": "button",
//	            "flex": 2,
//	            "style": "primary",
//	            "color": "#aaaaaa",
//	            "action": {
//	              "type": "uri",
//	              "label": "Add to Cart",
//	              "uri": "https://linecorp.com"
//	            }
//	          },
//	          {
//	            "type": "button",
//	            "action": {
//	              "type": "uri",
//	              "label": "Add to wish list",
//	              "uri": "https://linecorp.com"
//	            }
//	          }
//	        ]
//	      }
//	    },
//	    {
//	      "type": "bubble",
//	      "body": {
//	        "type": "box",
//	        "layout": "vertical",
//	        "spacing": "sm",
//	        "contents": [
//	          {
//	            "type": "button",
//	            "flex": 1,
//	            "gravity": "center",
//	            "action": {
//	              "type": "uri",
//	              "label": "See more",
//	              "uri": "https://linecorp.com"
//	            }
//	          }
//	        ]
//	      }
//	    }
//	  ]
//	}
}
</script>