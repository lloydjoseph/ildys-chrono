/*-----------------------------------------------------------------*/
/* Imports */
import './styles/app.css';
import './styles/global.css';

/*-----------------------------------------------------------------*/
/* Autosize */

const autosize = require('./autosize.min.js');

autosize(document.querySelectorAll('textarea'));

/*-----------------------------------------------------------------*/
/* Loaded message */

console.log('Script app.js loaded successfully !');

/*-----------------------------------------------------------------*/
/* Internet Explorer warning message for incompatibility */

if (/*@cc_on!@*/!!document.documentMode) alert('L\'utilisation du navigateur Google Chrome est recommandé pour l\'utilisation de cet outil.')

/*-----------------------------------------------------------------*/
/* Replace checkboxes */

let checkboxes = Array.prototype.slice.call(document.getElementsByClassName('checkbox'));

checkboxes.forEach(element => {
    element.style.display = 'none';

    let custCheckbox = document.createElement('img');

    let attr = document.createAttribute('src');
    attr.value = 'build/images/circle-24px.svg';

    let attr2 = document.createAttribute('class');
    attr2.value = 'cust-checkbox';

    custCheckbox.setAttributeNode(attr);
    custCheckbox.setAttributeNode(attr2);

    element.addEventListener('change', () => {
        if(element.checked) {
            custCheckbox.src = 'build/images/check_circle-24px.svg';
        } else {
            custCheckbox.src = 'build/images/circle-24px.svg';
        }
    });

    element.parentElement.insertBefore(custCheckbox, element.nextSibling);
});

let checkboxContainers = Array.prototype.slice.call(document.getElementsByClassName('checkbox-container'));

checkboxContainers.forEach(element => {
    element.addEventListener('keyup', (event) => {
        if(event.keyCode === 13) {
            console.log(element.firstChild.nextSibling.click());
        }
    });
})

/*-----------------------------------------------------------------*/
/* See password button */

let passwordVisible = document.getElementById('password-visible');
let passwordField = document.getElementById('password');

if(document.getElementById('password-visible')) {
    passwordVisible.addEventListener('change', () => {
        if(passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    })
}

/*-----------------------------------------------------------------*/
/* Display loading page when page is left */

document.querySelector('#loading').style.display = 'none';

window.onbeforeunload = () => {
    document.querySelector('#loading').style.display = 'flex';
    backgroundBlur();
};

/*-----------------------------------------------------------------*/
/* Add 'active' class to menu item */



let menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach((element) => {
    let re = new RegExp(element.href + '.*', 'g');

    if(window.location.href.match(re)) {
        element.classList.add('active');
    }
})

/*-----------------------------------------------------------------*/
/* Show page to add info */

let btnAdd = document.querySelector('#btn-add');
let add = document.querySelector('#add');

btnAdd.addEventListener('click', () => {
    add.style.display = 'flex';
    backgroundBlur();
})

/*-----------------------------------------------------------------*/
/* Blur background of add page and loading page */

function backgroundBlur() {
    let allElements = document.querySelectorAll('body > *:not(#add):not(#loading)');
    allElements.forEach((element) => {
        element.style.filter = 'blur(5px)';
    })
}

function backgroundUnBlur() {
    let allElements = document.querySelectorAll('body > *:not(#add):not(#loading)');
    allElements.forEach((element) => {
        element.style.filter = 'blur(0px)';
    })
}

/*-----------------------------------------------------------------*/
/* Cancel button in add page */

let cancel = document.querySelector('#cancel');

cancel.addEventListener('click', () => {
    location.reload();
})

/*-----------------------------------------------------------------*/
/* Close info box */

let closeInfo = document.querySelector('#closeInfo');
let info = document.querySelector('#info');

closeInfo.addEventListener('click', () => {
    info.style.display = 'none';
})


function cancelAdd() {
    document.getElementById('add').style.display = 'none';
    document.getElementById('add-form').reset();
    for (let index = 0; index < document.querySelectorAll('#add-form textarea').length; index++) {
        document.querySelectorAll('#add-form textarea')[index].style.height = 'auto';
    }
}

function showInfo(text) {
    document.getElementById('info').style.display = 'flex';
    document.getElementById('info-text').textContent = text;
}

function hideInfo() {
    document.getElementById('info').style.display = 'none';
}