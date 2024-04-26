// membuat 3 variabe dengan type const
const toggleMenu = document.getElementById("menu");
const navbar = document.getElementById("navbar-nav");
let video = document.getElementById("video-banner");

window.addEventListener("resize", function() {
  resizeVideo();
});

function resizeVideo() {
  let videoRatio = video.videoWidth / video.videoHeight;
  let windowRatio = window.innerWidth / window.innerHeight;

  if (windowRatio < videoRatio) {
    // window is narrower
    video.style.width = "100%";
    video.style.height = "auto";
  } else {
    // video is narrower
    video.style.width = "auto";
    video.style.height = "100%";
  }
}

resizeVideo(); // call the function once on page load


// memanggil navbar
toggleMenu.addEventListener("click", () => {
    // show di dapet dari id yg di buaut di css line 128
    navbar.classList.toggle("show")
})