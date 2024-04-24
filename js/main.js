// membuat 3 variabe dengan type const
const toggleMenu = document.getElementById("menu")
const navbar = document.getElementById("navbar-nav")

// memanggil navbar
toggleMenu.addEventListener("click", () => {
    // show di dapet dari id yg di buaut di css line 128
    navbar.classList.toggle("show")
})