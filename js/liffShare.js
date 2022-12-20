<script>
var url="https://rubydesign.net/business_card/liff_share.php?mypk=" +document.frmmain.mypk.value;

async function liffInit() {
	  await liff.init({ liffId: "1657623497-DZyKpqOL" });
	  if (!liff.isLoggedIn()) {
	    liff.login({ redirectUri: url });
	  }
	}
	//載入頁面就執行
async function createButton(profile){
		  const urlParams = new URLSearchParams(window.location.search);
		  const userImage = profile.pictureUrl;
		  const userReply = [urlParams.get('name'), urlParams.get('phone'), urlParams.get('email'), userImage];
		  const flexContent = flexCard(userReply);
		  
		  if (liff.isApiAvailable("shareTargetPicker")) {
		      try {
		        const result = await liff.shareTargetPicker([
		          flexContent
		        ])

		        if (result) {
		          alert('傳送成功');
		        }

		      } catch (error) {
		        alert("傳送失敗 error:" + error);
		      }
		    }
	}
	//按下按鈕才會執行
	function createButton_web(profile) {
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
	          alert('傳送成功');
	        }

	      } catch (error) {
	        alert("傳送失敗 error:" + error);
	      }
	    }
	  }
	  
	  var aaobj=document.getElementById("showLineBtn");
	  aaobj.onclick = handleClick;
	}

	async function main() {
		
		await liffInit()
		const profile = await liff.getProfile();
		
	  if(liff.getOS() == "web"){
		  await createButton(profile);
	  }else{
		  await createButton(profile);
	  }
	  
	}

	main()
const colorDefault = "#666666";
const colorNetlify = "#00ad9f";
const flexCard = (userReply) => {
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
  var path="https://rubydesign.net/businessCard_img/";
  var myData=document.frmmain.myDataStr.value;
  
  
  //console.log(myData);
  
  var dataArr=[];
  var myDataArr=myData.split(";");
  for(var i=0; i<myDataArr.length; i++){
	  var myValueArr=myDataArr[i].split(",");
	  var arrLength=(myValueArr.length-3)/3;
	  var buttonArr=[]; var itemQty=3;
	  if(arrLength > 0){
		  for(var j=0; j<arrLength; j++){
			  if(myValueArr[itemQty]){
				  buttonArr[j]={
						  "type": "button",
				            "style": myValueArr[itemQty+3],
				            "color":myValueArr[itemQty+2],
				            "action": {
				              "type": "uri",
				              "label": myValueArr[itemQty],
				              "uri": myValueArr[itemQty+1]
				            },
				            "height": "sm"
				  }
				  itemQty+=4;
			  }
		  }
		  dataArr[i]={
				  "type": "bubble",
			      "hero": {
				        "type": "image",
				        "size": "full",
				        "aspectRatio": myValueArr[0],
				        "url": path+myValueArr[1],
				        "aspectMode": "cover",
				        "animated": true
				       },
				 "footer": {
				   	    "type": "box",
				   	    "layout": "vertical",
				   	    "spacing": "sm",
				   	    "backgroundColor": myValueArr[2],
				   	    "contents": buttonArr
				   	  } 
		  }
	  }
  }
 
  return {
      "type": "flex",
      "altText": '電子名片',
      "contents":   {
    	  "type": "carousel",
		  "contents": dataArr
      }
    }
}
</script>