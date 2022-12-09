let Button = document.querySelectorAll('button');
let Loader = document.querySelector('.loader');
let Links = document.querySelectorAll('a');
let LoaderElement = document.querySelectorAll('.LoaderElement');
 
let LoaderElements = [
    Button, 
    Links,
    LoaderElement,
];

LoaderElements.forEach(LoaderElement => {
    LoaderElement.forEach((Elements) => {
        Elements.addEventListener('click', () => {
            Loader.style.visibility = 'visible';
        })
    });
});

window.onload = () => {
    Loader.style.visibility = 'hidden';
}