const input = document.querySelector('#wrapper input');
const button = document.querySelector('#wrapper button');

button.addEventListener('click', () => {
    input.select();
    document.execCommand('copy');
    button.innerText = "Copié !";
});

input.addEventListener('click', () => {
    input.select();
});