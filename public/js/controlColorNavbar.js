// controlColorNavbar.js
window.addEventListener('DOMContentLoaded', function() {
  const navbar = document.querySelector('.navbar');
  const buttons = document.querySelectorAll('.btn-menu');

  // Leer el color guardado (opcional)
  const savedColor = localStorage.getItem('navbarColor');
  if (savedColor) {
    navbar.style.backgroundColor = savedColor;
  }

  buttons.forEach(button => {
    button.addEventListener('click', function() {
      const color = this.dataset.color;
      navbar.style.backgroundColor = color;
      localStorage.setItem('navbarColor', color); // Guardar el color seleccionado
    });
  });
});