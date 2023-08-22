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