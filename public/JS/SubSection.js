
let Arrows = document.querySelectorAll('section.fuel-test .fuel-test-left-nav ul span img');

Arrows.forEach(Arrow => {
    Arrow.addEventListener('click', () => {
        Arrow.classList.toggle('rotate-arrow');
        Arrow.parentElement.nextElementSibling.classList.toggle('show'); 
    });
});