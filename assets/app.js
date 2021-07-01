/*-----------------------------------------------------------------*/
/* Imports */
import './styles/app.css';
import './styles/global.css';

/*-----------------------------------------------------------------*/
/* Loaded message */

console.log('Script app.js loaded successfully !');

/*-----------------------------------------------------------------*/
/* Internet Explorer warning message for incompatibility */

if (/*@cc_on!@*/!!document.documentMode && window.location.pathname === "/connexion") alert('L\'utilisation du navigateur Internet Explorer est fortement déconseillé pour l\'utilisation de cet outil.\r\n Vous pouvez utiliser Microsoft Edge, Google Chrome ou encore Mozilla Firefox à la place.')


/*-----------------------------------------------------------------*/
/* Display loading page when page is left */

document.querySelector('#loading').style.display = 'none';

window.onbeforeunload = () => {
    document.querySelector('#loading').style.display = 'flex';
    backgroundBlur();
};

/*-----------------------------------------------------------------*/
/* Add 'user-active' class to admin user menu item */

let userMenuItems = document.querySelectorAll('.user-menu-item');

userMenuItems.forEach((element) => {
    if(location.pathname === element.pathname) {
        element.classList.add('user-active');
    }
})

/*-----------------------------------------------------------------*/
/* Toggle menu responsive */

let toggleMenu = document.querySelector('#toggleMenu');
let menu = document.querySelector('#menu');

toggleMenu && toggleMenu.addEventListener('click', () => {
    if(menu.style.display === 'none') {
        menu.style.display = 'block';
        btnAdd.style.display = 'block';
    } else {
        menu.style.display = 'none';
        btnAdd.style.display = 'none';
    }
})

/*-----------------------------------------------------------------*/
/* Blur background of add page and loading page */

function backgroundBlur() {
    let allElements = document.querySelectorAll('body > *:not(#add):not(#loading)');
    allElements.forEach((element) => {
        element.style.filter = 'blur(5px)';
    })
}

/*-----------------------------------------------------------------*/
/* Cancel button in add page */

let cancel = document.querySelector('#cancel');

cancel && cancel.addEventListener('click', () => {
    location.reload();
})

/*-----------------------------------------------------------------*/
/* Close info box */

let closeInfo = document.querySelector('#closeInfo');
let info = document.querySelector('#info');

closeInfo && closeInfo.addEventListener('click', () => {
    info.style.display = 'none';
})

/*-----------------------------------------------------------------*/
/* Focus on next date input after it has been filled */
let day = document.querySelector('#day');
let month = document.querySelector('#month');
let year = document.querySelector('#year');

day.addEventListener('keyup', () => {
    if(day.value.length === 2) {
        month.focus();
    }
})

month.addEventListener('keyup', () => {
    if(month.value.length === 2) {
        year.focus();
    }
})
