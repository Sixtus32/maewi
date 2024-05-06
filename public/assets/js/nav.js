// Obtén todos los elementos con la clase "nav_link"
const links = document.querySelectorAll('.nav_link');

// Agrega un event listener a cada enlace
links.forEach(link => {
  link.addEventListener('click', function() {
    // Elimina la clase "active-link" de todos los enlaces
    links.forEach(l => {
      l.classList.remove('active-link');
      const icon = l.querySelector('i');
      if (icon) {
        icon.className = icon.className.replace('-fill', '-line');
      }
    });

    // Agrega la clase "active-link" al enlace actual
    this.classList.add('active-link');

    // Cambia "-line" por "-fill" en el contenido del icono
    const icon = this.querySelector('i');
    if (icon) {
      icon.className = icon.className.replace('-line', '-fill');
    }
  });
});
