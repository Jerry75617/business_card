async function liffInit() {
  await liff.init({ liffId: "1657623497-DZyKpqOL" });
  if (!liff.isLoggedIn()) {
    liff.login({ redirectUri: window.location.href });
  }
}

async function liffProfile() {
  const profile = await liff.getProfile();
  const displayName = profile.displayName;
  const h1 = document.createElement("h1");
  const textNode = document.createTextNode(`Hello ${displayName}`);
  h1.appendChild(textNode);

  const body = document.querySelector('body');
  body.appendChild(h1);
}

function createButton(profile, body) {
  const urlParams = new URLSearchParams(window.location.search);
  const userImage = profile.pictureUrl;
  const userReply = [urlParams.get('name'), urlParams.get('phone'), urlParams.get('email'), userImage];
  const flexContent = flexCard(userReply);
  const handleClick = async () => {
    if (liff.isApiAvailable("shareTargetPicker")) {
      try {
        const result = await liff.shareTargetPicker([
        	//文字
//		{
//		    "type": "text",
//		    "text": "Hello, world"
//		}
        	//flex
        {
            "type": "flex",
            "altText": `${urlParams.get('name')} present name card from Netlify`,
            "contents": flexContent
          }
        ])

        if (result) {
          alert('Flex Message success');
        }

      } catch (error) {
        alert("Flex Message got some error");
      }
    }
  }

  const button = document.createElement("button");
  button.innerHTML = "Share Your Name Card";
  button.onclick = handleClick;

  body.appendChild(button);
}

async function main() {
  await liffInit()
  const profile = await liff.getProfile();
  const body = document.querySelector('body');
  createButton(profile, body);
}

main()

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
	      {
	        "type": "box",
	        "layout": "baseline",
	        "margin": "md",
	        "contents": [
	          {
	            "type": "icon",
	            "size": "sm",
	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
	          },
	          {
	            "type": "icon",
	            "size": "sm",
	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
	          },
	          {
	            "type": "icon",
	            "size": "sm",
	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
	          },
	          {
	            "type": "icon",
	            "size": "sm",
	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png"
	          },
	          {
	            "type": "icon",
	            "size": "sm",
	            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gray_star_28.png"
	          },
	          {
	            "type": "text",
	            "text": "4.0",
	            "size": "sm",
	            "color": "#999999",
	            "margin": "md",
	            "flex": 0
	          }
	        ]
	      },
	      {
	        "type": "box",
	        "layout": "vertical",
	        "margin": "lg",
	        "spacing": "sm",
	        "contents": [
	          {
	            "type": "box",
	            "layout": "baseline",
	            "spacing": "sm",
	            "contents": [
	              {
	                "type": "text",
	                "text": "Place",
	                "color": "#aaaaaa",
	                "size": "sm",
	                "flex": 1
	              },
	              {
	                "type": "text",
	                "text": "Miraina Tower, 4-1-6 Shinjuku, Tokyo",
	                "wrap": true,
	                "color": "#666666",
	                "size": "sm",
	                "flex": 5
	              }
	            ]
	          },
	          {
	            "type": "box",
	            "layout": "baseline",
	            "spacing": "sm",
	            "contents": [
	              {
	                "type": "text",
	                "text": "Time",
	                "color": "#aaaaaa",
	                "size": "sm",
	                "flex": 1
	              },
	              {
	                "type": "text",
	                "text": "10:00 - 23:00",
	                "wrap": true,
	                "color": "#666666",
	                "size": "sm",
	                "flex": 5
	              }
	            ]
	          }
	        ]
	      }
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

const flexButton = (name, phone, email) => {
  return {
    "type": "box",
    "layout": "vertical",
    "contents": [
      {
        "type": "button",
        "action": {
          "type": "uri",
          "label": "Share",
          // 將按鈕引導的 URI 設定成我們的 LIFF URI，並加上必要的查詢字串
          // 我們可以把 LIFF ID 藏在 Netlify 的環境變數當中
          "uri": `https://liff.line.me/${"1657623497-DZyKpqOL"}?name=${name}&phone=${phone}&email=${email}`
        },
        "style": "primary",
        "color": colorNetlify
      }
    ],
    "paddingAll": "20px"
  }
}


const flexNameContent = (name, userImage) => {
  return {
    "type": "box",
    "layout": "horizontal",
    "contents": [
      flexImage(userImage),
      {
        "type": "box",
        "layout": "vertical",
        "contents": [
          flexFiller(),
          flexText("迷途小書僮", colorNetlify, "xs", "bold"),
          flexText(name, colorDefault, "xl", "bold"),
          flexBar(colorNetlify)
        ]
      }
    ],
    "spacing": "xl",
    "paddingTop": "20px",
    "paddingStart": "20px",
    "paddingEnd": "20px"
  }
}

const flexDetailContent = (phone, email) => {
  return {
    "type": "box",
    "layout": "vertical",
    "contents": [
      {
        "type": "box",
        "layout": "horizontal",
        "contents": [
          flexText("Phone", colorNetlify, "md", "bold"),
          flexText(phone, colorDefault, "md", "regular", 2),
        ]
      },
      {
        "type": "box",
        "layout": "horizontal",
        "contents": [
          flexText("Email", colorNetlify, "md", "bold"),
          flexText(email, colorDefault, "md", "regular", 2)
        ]
      }
    ],
    "paddingBottom": "20px",
    "paddingStart": "20px",
    "paddingEnd": "20px"
  }
}

const flexImage = (userImage) => ({
  "type": "box",
  "layout": "vertical",
  "contents": [
    {
      "type": "image",
      "url": userImage,
      "aspectMode": "cover",
      "size": "full"
    }
  ],
  "cornerRadius": "100px",
  "width": "72px",
  "height": "72px"
})

const flexText = (text, color, size, weight, flex = 1) => ({
  "type": "text",
  "text": text,
  "color": color,
  "size": size,
  "weight": weight,
  "flex": flex
});

const flexFiller = () => ({ "type": "filler" });

const flexBar = (color) => ({
  "type": "box",
  "layout": "vertical",
  "contents": [],
  "height": "3px",
  "backgroundColor": color
})

//export default flexCard;




