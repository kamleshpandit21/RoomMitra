 // Navbar scroll effect
 window.addEventListener("scroll", function() {
    if (window.scrollY > 50) {
        document.getElementById("mainNav").classList.add("nav-scroll");
    } else {
        document.getElementById("mainNav").classList.remove("nav-scroll");
    }
});

