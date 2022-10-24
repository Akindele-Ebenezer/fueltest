let ToolTips = document.querySelectorAll('.tooltip');   

ToolTips.forEach(ToolTip => {
    ToolTip.parentElement.addEventListener('mouseenter', () => {
        ToolTip.classList.add('show');
    });

    ToolTip.parentElement.addEventListener('mouseleave', () => {
        ToolTip.classList.remove('show');
    }); 
}); 
    