function updateActiveNavLink() {
    const currentHash = window.location.hash;
    const navLinks = document.querySelectorAll(".navbar .nav-link");
  
    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href").includes(currentHash)) {
        link.classList.add("active");
      }
    });
  }
  
  // Beim ersten Laden
  document.addEventListener("DOMContentLoaded", updateActiveNavLink);
  
  // Wenn sich der Hash durch Klick ändert
  window.addEventListener("hashchange", updateActiveNavLink);