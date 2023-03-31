const subnav = document.getElementById("wrapper");
const toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = () => {
    subnav.classList.toggle("toggled");
}

// Delay for 5 seconds (5000 milliseconds) before fading out and hiding the element
setTimeout(function() {
    $(".fade-out").addClass("d-none");
  }, 5000);