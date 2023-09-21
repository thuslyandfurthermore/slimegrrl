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

function getStyle() {
  
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}