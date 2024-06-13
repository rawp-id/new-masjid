function getContainerMargin() { 
  var p = document.querySelector(".main-content > .container");
  if (p) { // Memeriksa apakah elemen ditemukan
    var style = p.currentStyle || window.getComputedStyle(p);
    document.querySelector('.sidenav').style.right = style.marginRight;
    document.querySelector('.sidenav').style.display = 'block';
  } else {
    // console.error('Element .main-content > .container not found.');
  }
}

window.addEventListener('load', getContainerMargin, false);
window.addEventListener("resize", getContainerMargin);
