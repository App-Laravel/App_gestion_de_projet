
if (document.querySelector('.dropbtn')) {
    const dropdownContent = document.querySelector('.dropdown-content');
    const dropbtn = document.querySelector('.dropbtn');
    
    dropbtn.onclick = (e) => {
        e.target.classList.add('dropbtn-onclick');
        dropdownContent.classList.add('dropdown-show');
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && 
            !event.target.matches('.dropdown-item') &&
            !event.target.matches('.item-checkbox') &&
            !event.target.matches('.item-label')
        ) {
            if (dropdownContent.classList.contains('dropdown-show')) {
                dropdownContent.classList.remove('dropdown-show');
            }
            if (dropbtn.classList.contains('dropbtn-onclick')) {
                dropbtn.classList.remove('dropbtn-onclick');
            }
        }
    }
}