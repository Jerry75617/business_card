<script>
//var url="https://103.148.202.39/business_card/liff_share.php";
async function liffInit() {
  await liff.init({ liffId: "1657623497-DZyKpqOL" });
//  alert(window.location.href);
  if (!liff.isLoggedIn()) {
	liff.login({ redirectUri:  window.location.href });
//    liff.login({ redirectUri:  url });//window.location.href
  }
}

async function liffProfile() {
  const profile = await liff.getProfile();
  const displayName = profile.displayName;
//  const h1 = document.createElement("h1");
//  const textNode = document.createTextNode(`Hello ${displayName}`);
//  h1.appendChild(textNode);
//
//  const body = document.querySelector('body');
//  body.appendChild(h1);
}

function createButton(profile) {
  const urlParams = new URLSearchParams(window.location.search);
  const userImage = profile.pictureUrl;
  const userReply = [urlParams.get('name'), urlParams.get('phone'), urlParams.get('email'), userImage];
  const flexContent = flexCard(userReply);
  var shareContent = messageContent('flex');
  const handleClick = async () => {
    if (liff.isApiAvailable("shareTargetPicker")) {
      try {
        const result = await liff.shareTargetPicker([
        
        	
            
        ])

        if (result) {
          alert('Flex Message success');
        }

      } catch (error) {
        alert("Flex Message got some error");
      }
    }
  }
//  const button = document.createElement("button");
//  button.innerHTML = "Share Your Name Card";
//  button.onclick = handleClick;
//
//  body.appendChild(button);
}
function messageContent(kind){
	switch(kind){
		case "text"://文字
			return {
			    "type": "text",
			    "text": "Hello, world"
			}	
			break;
		case "flex"://flex
			return {
				"type": "flex",
	            "altText": `${urlParams.get('name')} present name card from Netlify`,
	            "contents": flexContent
	        }
			break;
	}
}


const colorDefault = "#666666"
const colorNetlify = "#00ad9f"
const flexCard = (userReply) => {
  console.log(userReply);
  const [_, name, phone, email] = userReply;

  return {
	  "type": "bubble",
	  "hero": {
	    "type": "image",
	    "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png",
	    "size": "full",
	    "aspectRatio": "20:13",
	    "aspectMode": "cover",
	    "action": {
	      "type": "uri",
	      "uri": "http://linecorp.com/"
	    }
	  },
	  "body": {
	    "type": "box",
	    "layout": "vertical",
	    "contents": [
	      {
	        "type": "text",
	        "text": "Brown Cafe",
	        "weight": "bold",
	        "size": "xl"
	      },
//	      {
//	        "type": "box",
//	        "layout": "baseline",
//	        "margin": "md",
//	        "contents": [
//	          {
//	            "type": "icon",
//	            "size": "sm",
//	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
//	          },
//	          {
//	            "type": "icon",
//	            "size": "sm",
//	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
//	          },
//	          {
//	            "type": "icon",
//	            "size": "sm",
//	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
//	          },
//	          {
//	            "type": "icon",
//	            "size": "sm",
//	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
//	          },
//	          {
//	            "type": "icon",
//	            "size": "sm",
//	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gray_star_28.png"
//	          },
//	          {
//	            "type": "text",
//	            "text": "4.0",
//	            "size": "sm",
//	            "color": "#999999",
//	            "margin": "md",
//	            "flex": 0
//	          }
//	        ]
//	      },
//	      {
//	        "type": "box",
//	        "layout": "vertical",
//	        "margin": "lg",
//	        "spacing": "sm",
//	        "contents": [
//	          {
//	            "type": "box",
//	            "layout": "baseline",
//	            "spacing": "sm",
//	            "contents": [
//	              {
//	                "type": "text",
//	                "text": "Place",
//	                "color": "#aaaaaa",
//	                "size": "sm",
//	                "flex": 1
//	              },
//	              {
//	                "type": "text",
//	                "text": "Miraina Tower, 4-1-6 Shinjuku, Tokyo",
//	                "wrap": true,
//	                "color": "#666666",
//	                "size": "sm",
//	                "flex": 5
//	              }
//	            ]
//	          },
//	          {
//	            "type": "box",
//	            "layout": "baseline",
//	            "spacing": "sm",
//	            "contents": [
//	              {
//	                "type": "text",
//	                "text": "Time",
//	                "color": "#aaaaaa",
//	                "size": "sm",
//	                "flex": 1
//	              },
//	              {
//	                "type": "text",
//	                "text": "10:00 - 23:00",
//	                "wrap": true,
//	                "color": "#666666",
//	                "size": "sm",
//	                "flex": 5
//	              }
//	            ]
//	          }
//	        ]
//	      }
	    ]
	  },
	  "footer": {
	    "type": "box",
	    "layout": "vertical",
	    "spacing": "sm",
	    "contents": [
	      {
	        "type": "button",
	        "style": "link",
	        "height": "sm",
	        "action": {
	          "type": "uri",
	          "label": "CALL",
	          "uri": "https://linecorp.com"
	        }
	      },
	      {
	        "type": "button",
	        "style": "link",
	        "height": "sm",
	        "action": {
	          "type": "uri",
	          "label": "WEBSITE",
	          "uri": "https://linecorp.com"
	        }
	      },
	      {
	        "type": "box",
	        "layout": "vertical",
	        "contents": [],
	        "margin": "sm"
	      }
	    ],
	    "flex": 0
	  }
	}
}
</script>