const button_toggle = document.getElementById("menu-label");
const sidebar = document.querySelector(".sidebar");

button_toggle.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});
