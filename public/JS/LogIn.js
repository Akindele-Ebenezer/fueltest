let LogInButtons = document.querySelectorAll('.log-in-button');

LogInButtons.forEach(LogInButton => {
    LogInButton.addEventListener('click', () => {
        LogInButton.textContent = 'LOADING..';
        LogInButton.style.backgroundColor = '#664949';
        LogInButton.style.color = '#fff';
    }) 
});