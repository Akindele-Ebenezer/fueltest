let Columns = document.querySelectorAll('.resizable');  

Columns.forEach(Column => {
    let Resize = Element => {
        let ColumnWidth = Element.offsetX + 20;
        Column.style.width = ColumnWidth + 'px'; 
    }  
    
    Column.addEventListener('mousedown', () => {
        Column.addEventListener('mousemove', Resize);
    });

    Column.addEventListener('mouseup', () => { 
        Column.removeEventListener('mousemove', Resize) ; 
    });

    Column.addEventListener('mouseenter', () => { 
        Column.style.cursor = 'col-resize' ; 
        Column.removeEventListener('mousemove', Resize) ; 
    }); 
});