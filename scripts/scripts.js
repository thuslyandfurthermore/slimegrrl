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
  console.log(cookieValue)
  styleElement.setAttribute('href', cookieValue);
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
