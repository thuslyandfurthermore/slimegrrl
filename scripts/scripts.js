function addCurrentTab() {

  z = document.getElementsByTagName("*");
  console.log(z.length);

  for (i = 0; i < z.length; i++) {

    elmnt = z[i];;
    path = elmnt.getAttribute("href");

    if (path == window.location.pathname) {

      elmnt.setAttribute("class", "currenttab");
    }
  }
}

function setStyle() {
  currentStyle = menu.value;
  setCookie('currentStyle', currentStyle, 1);
  getStyle();
}

function getStyle() {
  styleElement = document.querySelector('link')
  const cookieValue = document.cookie
    .split("; ")
    .find((row) => row.startsWith("currentStyle="))
    ?.split("=")[1];
  if (cookieValue) {
    styleElement.setAttribute('href', cookieValue);
  }
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function closePlayer() {
  player = document.getElementById("player");
  player.innerHTML = "";
  player.remove();
  console.log("called");
}

function createAudioDialog(source) {
  document.body.insertAdjacentHTML("beforeend",
  "<dialog open id = 'player'> <audio controls src = '" + source + "'> <a href = '" + source + "'>download audio</a> </audio> <br> <form method = 'dialog'> <button onclick = 'closePlayer()' style='width: 100%; height: 4em'>close</button> </form> </dialog>"
  );
  
  
}