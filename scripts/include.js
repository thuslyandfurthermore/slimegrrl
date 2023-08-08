function includeHTML() {
  var z, y, i, elmnt, file, xhttp;
  /* Loop through a collection of all HTML elements: */
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("include-html");
    if (file) {
      /* Make an HTTP request using the attribute value as the file name: */
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {
            
            debug = document.getElementById("debug");
            z = this.response;
            elmnt.insertAdjacentHTML("afterbegin", z);
            addCurrentTab();
          }
          
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          
          /* Remove the attribute, and call this function once more: */
          elmnt.removeAttribute("include-html");
          includeHTML();
        }
      }
      xhttp.open("GET", file, true);
      xhttp.send();
      /* Exit the function: */
      return;
    }
  }
}

function addCurrentTab() {
  
//  window.addEventListener("load", (event) => {
    
    z = document.getElementsByTagName("*");
    console.log(z.length);
    
    for (i = 0; i < z.length; i++) {
     
      elmnt = z[i];;
      path = elmnt.getAttribute("href");
      console.log(elmnt.tagName);
      console.log(path);
      
      if (path == window.location.pathname) {
        
      //  debug.innerHTML = path;
        elmnt.setAttribute("id", "currenttab");
        
    }
    }
    console.log(window.location.pathname);
//  });
}

/*window.addEventListener("load", (event => {
  
  z = document.getElementsByTagName("*");
  console.log(z.length);
  
  for (i = 0; i < z.length; i++) {
  
    elmnt = z[i];;
    path = elmnt.getAttribute("href");
    console.log(elmnt.tagName);
  
    if (path == window.location.pathname) {
  
      debug.innerHTML = path;
      elmnt.setAttribute("id", "currenttab");
  
    }
  }
}));
*/
