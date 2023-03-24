const subnav = document.getElementById("wrapper");
const toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = () => {
    subnav.classList.toggle("toggled");
}
