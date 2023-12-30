var user = "";
var nextTimeLine = "";

function searchUser(data) {
  nextTimeLine = "";
  document.getElementById("user_details").style.display = "none";
  username = data.value;
  user = username;
  getData(username, false);
}

function getData(username, more) {
  if (username != "") {
    const apiUrl =
      "./cors/data/?user=" + username + "&timeLine=" + nextTimeLine;
    const xhttpr = new XMLHttpRequest();
    xhttpr.open("GET", apiUrl, true);
    xhttpr.send();
    xhttpr.onload = () => {
      if (xhttpr.status === 200) {
        const response = JSON.parse(xhttpr.response);
        if (response["status"] == "success") {
          parsePosts(response, more);
        } else {
          console.log("Error");
        }
      } else {
        console.log("Error");
      }
    };
  }
}

function parsePosts(data, more) {
  if (!more) {
    document.getElementById("user_posts").innerHTML = "";
  }
  document.getElementById("profile_img").src =
    "./cors/?imgurl=" + btoa(data["imageChange"]);
  nextTime = data["nextTimeline"];
  if (nextTime != "nullTake") {
    nextTimeLine = nextTime;
  }
  innerData = data["add"];
  const addChildrenNames = Object.keys(innerData);
  addChildrenNames.forEach(function (post_id) {
    console.log(post_id);
    let outerDiv = document.createElement("div");
    outerDiv.className = "col-lg-4 col-md-12";
    let contentDiv = document.createElement("div");
    contentDiv.className = "card mx-auto mt-4";
    contentDiv.style.width = "18rem";
    let imgElement = document.createElement("img");
    imgElement.className = "card-img-top";
    imgElement.src = "./cors/?imgurl=" + btoa(innerData[post_id]["code"]);
    let btnDiv = document.createElement("div");
    btnDiv.className = "card-body mx-auto";
    let link = document.createElement("a");
    link.className = "btn btn-primary";
    link.href = "#";
    link.text = "Select";

    outerDiv.appendChild(contentDiv);
    contentDiv.appendChild(imgElement);
    contentDiv.appendChild(btnDiv);
    btnDiv.appendChild(link);
    document.getElementById("user_posts").appendChild(outerDiv);
  });
  document.getElementById("user_details").style.display = "block";
}

function morePosts() {
  if (nextTimeLine != "") {
    getData(user, true);
  }
}
