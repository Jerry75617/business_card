<script>
//var url="https://103.148.202.39/business_card/liff_share.php";
async function liffInit() {
	  await liff.init({ liffId: "1657623497-DZyKpqOL" });
	  if (!liff.isLoggedIn()) {
	    liff.login({ redirectUri: window.location.href });
	  }
	}

	function createButton(profile) {
	  const urlParams = new URLSearchParams(window.location.search);
	  const userImage = profile.pictureUrl;
	  const userReply = [urlParams.get('name'), urlParams.get('phone'), urlParams.get('email'), userImage];
	  const flexContent = flexCard(userReply);
	  const handleClick = async () => {
	    if (liff.isApiAvailable("shareTargetPicker")) {
	      try {
	        const result = await liff.shareTargetPicker([
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
  console.log(userReply);
  const [_, name, phone, email] = userReply;

  return {
	  "type": "carousel",
	  "contents": [
	    {
	      "type": "bubble",
	      "hero": {
	        "type": "image",
	        "size": "full",
	        "aspectRatio": "20:13",
	        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png",
	        "aspectMode": "cover"
	      },
	      "footer": {
	        "type": "box",
	        "layout": "vertical",
	        "spacing": "sm",
	        "contents": [
	          {
	            "type": "button",
	            "style": "primary",
	            "action": {
	              "type": "uri",
	              "label": "Add to Cart",
	              "uri": "https://linecorp.com"
	            },
	            "height": "sm"
	          },
	          {
	            "type": "button",
	            "action": {
	              "type": "uri",
	              "label": "Add to wishlist",
	              "uri": "https://linecorp.com"
	            },
	            "style": "primary",
	            "height": "sm"
	          }
	        ]
	      }
	    },
	    {
	      "type": "bubble",
	      "hero": {
	        "type": "image",
	        "size": "full",
	        "aspectRatio": "20:13",
	        "aspectMode": "cover",
	        "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_6_carousel.png"
	      },
	      "footer": {
	        "type": "box",
	        "layout": "vertical",
	        "spacing": "sm",
	        "contents": [
	          {
	            "type": "button",
	            "flex": 2,
	            "style": "primary",
	            "color": "#aaaaaa",
	            "action": {
	              "type": "uri",
	              "label": "Add to Cart",
	              "uri": "https://linecorp.com"
	            }
	          },
	          {
	            "type": "button",
	            "action": {
	              "type": "uri",
	              "label": "Add to wish list",
	              "uri": "https://linecorp.com"
	            }
	          }
	        ]
	      }
	    },
	    {
	      "type": "bubble",
	      "body": {
	        "type": "box",
	        "layout": "vertical",
	        "spacing": "sm",
	        "contents": [
	          {
	            "type": "button",
	            "flex": 1,
	            "gravity": "center",
	            "action": {
	              "type": "uri",
	              "label": "See more",
	              "uri": "https://linecorp.com"
	            }
	          }
	        ]
	      }
	    }
	  ]
	}
}
</script>